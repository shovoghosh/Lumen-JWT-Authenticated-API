<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use  App\User;

class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        
        try {
            $user = User::findOrFail($id);
            return response()->json(['message' => 'user is found!','users' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
            
        }

    }

     /**
     * Update one user.
     *
     * @return Response
     */
    public function updateUser($id)
    {
        
        try {
            $user = User::findOrFail($id);

            return response()->json(['users' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
            
        }

    }

    /**
     * Delete one user.
     *
     * @return Response
     */
    public function deleteUser($id)
    {
        
        try {
            $user = User::findOrFail($id);
            $user->delete($user);

            return response()->json(['users' => $user, 'message' => 'User is Deleted!'], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'User not Deleted!'], 404);
            
        }

    }







}
