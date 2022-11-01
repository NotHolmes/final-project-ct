<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Message;


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

        $message = Message::where('from','user01@api.example.com')->orWhere('to','user01@api.example.com')->get();
        $contacts = $message->map(function($message , $id){
                if($message->from == 'user01@api.example.com') {
                    return [
                        'id'=> '1',
                        'email' => $message->to,
                        'point'=> '0',
                        'image_path'=> null
                    ];
                }
                if($message->to == 'user01@api.example.com') {
                return [
                    'id'=> '1',
                    'email' => $message->from,
                    'point'=> '0',
                    'image_path'=> null
                    ];
                }
        });

        return response()->json($contacts->unique());
//                $contacts = User::all();
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
        //
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
