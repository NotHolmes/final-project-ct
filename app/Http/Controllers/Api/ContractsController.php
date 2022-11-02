<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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

    public function index($email)
    {
        $message = Message::where('from',$email)->orWhere('to',$email)->get();
        $contacts = $message->map(function($message , $id) use ($email) {
            if($message->from == $email) {
                return User::where('email',$message->to)->first();

            }
            if($message->to == $email) {
                return User::where('email',$message->from)->first();
            }
        });

        $filtered_contacts = $contacts->filter(function ($contact) use ($email){
            if($contact->email != $email){
                return $contact;
            }
        })->values();

        $filtered_contacts = $filtered_contacts->unique();

        $unreadIds = DB::table('messages')->select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', $email)
            ->where('read', false)
            ->groupBy('from')
            ->get();

        $filtered_contacts = $filtered_contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id',$contact->email)->first();
            if ($contactUnread != null)
                $contact->unread = $contactUnread->messages_count;
            else
                $contact->unread =  0 ;

            return $contact;
        });

        return response()->json($filtered_contacts);
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
                $message = Message::factory()->create([
                   'from' => auth()->user()->email,
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

    public function getContact($email){
        $user = User::where('email',$email)->first();
        if ($user != null )
            return response()->json($user);
        return null ;
    }
}
