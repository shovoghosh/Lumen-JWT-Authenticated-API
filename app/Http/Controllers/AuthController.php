<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\User;

class AuthController extends Controller
{


    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {
           
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }


        /**
     * Update a user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateUser(Request $request,$id)
    {
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {
            $user = User::findOrFail($id);
            // return response()->json(['message' => 'user is found!'], 200);

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();
           // $user->update($user);

            //return successful response
            return response()->json(['user' => $user, 'message' => 'User Updated'], 201);


        } catch (\Exception $e) {

            return response()->json(['message' => 'User Update Failed!'], 404);
            
        }
    }


    /**
     *Delete user JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     * 
     */

     /*
    public function deleteUser(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

        try {
            $user = User::findOrFail($id);
            // return response()->json(['message' => 'user is found!'], 200);

            $user->delete($user);

            //return successful response
            return response()->json(['user' => $user, 'message' => 'User Deleted'], 201);


        } catch (\Exception $e) {

            return response()->json(['message' => 'User Delete Failed!'], 404);
            
        }
        
    }
*/


      /**
    * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);


    }

    
}
