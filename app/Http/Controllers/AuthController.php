<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function loginPost(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if(!$user){
            return redirect()->back()->with('error', "User not found!");
        }
        if(!Hash::check($password, $user->password)){
            return redirect()->back()->with('error', "Wrong password!");
        }
        Auth::login($user);
        $log = Log::create([
            'first_name' => Auth::user()->first_name,
            'last_name' => Auth::user()->last_name,
            'message' => 'Logged in.'
        ]);
        return redirect()->route('home');
    }

    public function logout(){
        $log = Log::create([
            'first_name' => Auth::user()->first_name,
            'last_name' => Auth::user()->last_name,
            'message' => 'Logged out.'
        ]);
        Auth::logout();
        return redirect()->back();
    }

    public function register(){
        return view('pages.auth.register');
    }

    public function registerPost(RegisterRequest $request){

        $data = $request->only('first_name', 'last_name', 'email');
        $encryptedPassword = Hash::make($request->password);
        try{
            DB::beginTransaction();
            $user = User::create($data + ['password' => $encryptedPassword]);
            DB::commit();
            Auth::login($user);
            $log = Log::create([
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'message' => 'Successfully registered.'
            ]);
            return redirect()->route('home');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
