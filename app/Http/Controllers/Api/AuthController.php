<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function index()
    {
        $users = User::get();

        return UserResource::collection($users);
    }

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:7']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED); // 401
        }


        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return UserResource
     */
    public function me()
    {
        return new UserResource( auth()->user());
//        return response()->json(auth()->check());

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
            //    'user' => new UserResource(auth()->user())
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required','unique',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }


        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = password_hash($request->get('password'),PASSWORD_DEFAULT);

        if($request->has('point'))
        $user->point = $request->get('point');

        if ($user->save()) {
            return response()->json([
                'success' => true,
                'message' => 'User saved successfully with id ' . $user->id,
                'user_id' => $user->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'User saved failed'
        ],
            Response::HTTP_BAD_REQUEST);
    }

    public function search(Request $request) {
        $q = $request->query('q');
        $users = Reward::where('email', 'LIKE', "%{$q}%")
            ->get();
        return $users;
    }

    public function update(Request $request, User $user){
        if ($request->has('name')) $user->name = $request->get('name');
        if ($request->has('email')) $user->email = $request->get('email');
        if ($request->has('point')) $user->point = $request->get('point');
        if ($user->save()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully with id ' . $user->id,
                'reward_id' => $user->id
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => 'User saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }
}
