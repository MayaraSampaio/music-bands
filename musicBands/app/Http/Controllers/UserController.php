<?php

namespace App\Http\Controllers;
use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function addUser()
    {
        return view('user.add_user');
    }

    public function storeUser(Request $request){
        //dd($request->all());
        //validar se os dados recebidos estão em conformidade com a BAse de dados
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' =>'min:8|required'
        ]);

        //inserir user na base de dados
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 0,
        ]);

        return redirect()->route('login')->with('status', 'Conta criada. Faz login.');
    }
}


