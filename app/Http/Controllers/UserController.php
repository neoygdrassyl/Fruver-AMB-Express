<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Audit;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return User::get();
    }
    
    public function show($id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol = $request->rol;
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        if ($user->save() == 1){
            $entry = new Audit();
            $entry->user = auth()->user()->name;
            $entry->table = "Usuarios";
            $entry->action = "Editar - ".$user->id;
            $entry->save();
            return true;
        }else{
            return false;
        }
    }

    public function destroy($id)
    {
        if (User::find($id)->delete()){    
            $entry = new Audit();
            $entry->user = auth()->user()->name;
            $entry->table = "Usuarios";
            $entry->action = "Eliminar - ".$id;
            $entry->save();
            return true;
        }else{
            return false;
        }
    }
}
