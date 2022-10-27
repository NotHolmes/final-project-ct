<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
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
        $post = new Post();
        $post->title = $request->get('title');
        $post->image = $request->get('image');
        $post->description = $request->get('description');
        $post->published_at = now();

        if($request->has('reward')) {
            $post->reward = $request->get('reward');
        }

        $post->is_lost = $request->get('is_lost');
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
        if($request->has('title')) $post->title = $request->get('title');
        if($request->has('image')) $post->image = $request->get('image');
        if($request->has('description')) $post->description = $request->get('description');
        if($request->has('published_at')) $post->published_at = $request->get('published_at');
        if($request->has('reward')) $post->reward = $request->get('reward');
        if($request->has('is_lost')) $post->is_lost = $request->get('is_lost');
        if($request->has('latitude')) $post->latitude = $request->get('latitude');
        if($request->has('longitude')) $post->longitude = $request->get('longitude');

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
}
