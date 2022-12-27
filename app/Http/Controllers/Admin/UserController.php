<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{


    public function getUsersList()
    {
       $users = User::paginate(10);
       return view('admin.users.index',['users'=>$users]);
    }

    public function editUsers($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit',['model'=>$user]);
    }

    public function updateUsers($id, Request $request)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        if( $request->has('verify') ){
            $data['verify'] = 1;
        }
        else{
            $data['verify'] = 0;
        }
        $user->update($data);
        return redirect(route("users-list.index"))->with('message', 'Record was successfully Update!!');
    }

}
