<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Response;


class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {

//        $messages = Message::where('from',auth()->user()->email)->orWhere('to',auth()->user()->email)->get(); //หาข้อความทั้งหมดที่ส่งไป และส่งมา
//
//        foreach ($messages as $message){
//            $contracts = User::
//        }

        $message = Message::where('from',auth()->user()->email)->orWhere('to',auth()->user()->email)->get();
        $contacts = $message->map(function($message , $id){
                if($message->from == auth()->user()->email) {
                    return User::where('email',$message->to)->first();
//                    return [
//                        'id'=> $user_->get('id'),
//                        'email' => $user_->get('email'),
//                        'point'=> $user_->get('point'),
//                        'image_path'=> $user_->get('image_path')
//                    ];
                }
                if($message->to == auth()->user()->email) {
                    return User::where('email',$message->from)->first();
//                    return [
//                        'id'=> $user_->get('id'),
//                        'email' => $user_->get('email'),
//                        'point'=> $user_->get('point'),
//                        'image_path'=> $user_->get('image_path')
//                    ];
                }
        });

        return response()->json($contacts->unique());

//                $contacts = User::where('email','user02@api.example.com')->get();
//                return response()->json($contacts);
//        return UserResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getMessagesFor($email){
        $message = Message::where('from',$email)->orWhere('to',$email)->get();
        return MessageResource::collection($message);
    }
    public function send(Request $request){
        //        $user = User::where('email',$request->user_id)->get();
                $message = Message::factory()->create([
                   'from' => $request->email,
                    'to' => $request->contact_email,
                    'text' =>$request->text
        
                ]);
                return response()->json($message);
            }
    
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        if ($user->save()) {
            return response()->json([
                'success' => true,
                'message' => 'User saved successfully with id ' . $user->id,
                'reward_id' => $user->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Reward saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
