<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\SearchResource;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\Searchable\Search;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show', 'search']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $posts = Post::get();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $this->authorize('create', Post::class);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'max:10240',
            'color' => 'required',
            'brand' => 'required',
            'description' => 'required',
            'reward' => 'nullable|numeric',
            'is_lost' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $post = new Post();
        $post->title = $request->get('title');
        $post->user_id = $request->get('user_id');
        $post->category_id = $request->get('category_id');


        $image_path = $this->handleImageUploaded($request->file('image'));
        $post->image = $image_path;

        $post->color = $request->get('color');
        $post->brand = $request->get('brand');
        $post->description = $request->get('description');

        $date = $request->get('date');
        $time = $request->get('time');

        $datetime = $date . ' ' . $time;
        $datetime = Carbon::create($datetime)->toDateTime();

        $post->datetime = $datetime;

        $post->is_lost = $request->get('is_lost');

        if($request->has('reward') && $post->is_lost) {
            $post->reward = $request->get('reward');
        } else {
            $post->reward = 0;
        }

        $post->latitude = $request->get('latitude');
        $post->longitude = $request->get('longitude');

        if ($post->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Post saved successfully with id ' . $post->id,
                'post_id' => $post->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Post saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post)
    {

        $this->authorize('update', $post);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required',
            'category_id' => 'sometimes|required|integer',
            'image' => 'sometimes|required',
            'color' => 'sometimes|required',
            'brand' => 'sometimes|required',
            'description' => 'sometimes|required',
            'reward' => 'sometimes|required|numeric',
            'is_done' => 'sometimes|required|boolean',
            'hidden' => 'sometimes|required|boolean',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        if($request->has('title')) $post->title = $request->get('title');
        if($request->has('category_id')) $post->category_id = $request->get('category_id');
        if($request->has('image')){
            // if $request->get('image') is a link, then we don't need to handle it
            if (strpos($request->get('image'), 'http') === false) {
                $image_path = $this->handleImageUploaded($request->file('image'));
                $post->image = $image_path;
            } else {
                $post->image = $request->get('image');
            }
        }
        if($request->has('color')) $post->color = $request->get('color');
        if($request->has('brand')) $post->brand = $request->get('brand');
        if($request->has('description')) $post->description = $request->get('description');
        if($request->has('date') && $request->has('time')) {

            $date = $request->get('date');
            $time = $request->get('time');

            $datetime = $date . ' ' . $time;
            $datetime = Carbon::create($datetime)->toDateTime();

            $post->datetime = $datetime;
        }
        if($request->has('reward') && $post->is_lost) $post->reward = $request->get('reward');
        if($request->has('is_done')) $post->is_done = $request->get('is_done');
        if($request->has('latitude')) $post->latitude = $request->get('latitude');
        if($request->has('longitude')) $post->longitude = $request->get('longitude');
        if($request->has('hidden')) $post->hidden = $request->get('hidden');

        if ($post->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully with id ' . $post->id,
                'post_id' => $post->id
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => 'Post saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $title = $post->title;
        if ($post->delete()) {
            return response()->json([
                'success' => true,
                'message' => "Post {$title} deleted successfully"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => "Post {$title} deleted failed"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function search(Request $request){
        $results = (new Search())->registerModel(Post::class, ['title', 'description', 'color', 'brand', 'datetime', 'latitude', 'longitude'])
            ->search($request->get('query'));

//        return response()->json($results);
        return SearchResource::collection($results);
    }

    public function handleImageUploaded($image)
    {
        $image_name = time().$image->getClientOriginalName();
        $image_name = str_replace(' ', '', $image_name);
        $image_path = $image->storeAs('images', $image_name, 'public');
        $image_path = env('APP_URL').'/storage/'.$image_path;
        return $image_path;
    }

}
