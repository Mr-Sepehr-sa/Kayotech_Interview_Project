<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ManageUsersController extends Controller
{
    /**
     * Get list of user's
     */
    public function getUsersList(){
        return User::all();
    }

    /**
     * Active or inactive a user by Admin role
     */
    public function changeUserStatus(Request $request){

        $data = $request->validate([
            'id' => ['required','integer'],
            'status' => ['required','integer',Rule::in([1,0])]
        ]);
        $user = User::findorfail($data['id']);

        $user->update([
            'status' => $data['status']
        ]);

        return $data;
    }

    /**
     * Check a user has a given role
     */
    public function userHasRole(Request $request){
        $data = $request->validate([
            'role' => ['required','string'],
        ]);
        $user = $request->user();
        return $user->hasRole($data['role']);
    }
}
