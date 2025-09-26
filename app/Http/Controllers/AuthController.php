<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Group;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);
        $sap_code = $request->input('sap_code',null);
        $email = $request->input('email',null);
        $password = $request->input('password',null);

        if(!empty($sap_code) && empty($email)) {
            $user = User :: where('sap_code', $sap_code)->first();
            if($user) {
                $credentials = [
                    'email' => $user->email,
                    'password' => $password,
                ];
            }
        }

        if(!empty($sap_code) && !empty($email)) {
            $user = User :: where(['sap_code'=> $sap_code,'email' => $email])->first();
            if($user) {
                $credentials = [
                    'email' => $user->email,
                    'password' => $password,
                ];
            }
        }

        if(!empty($email) && !empty($password)) {
            $credentials = [
                'email' => $email,
                'password' => $password,
            ];
        }

        // Check if "remember me" was ticked
        $remember = $request->has('remember');

        if (!empty($credentials) && Auth::attempt($credentials , $remember)) {
            $request->session()->regenerate();

            // Get the logged-in user
            $user = Auth::user();
          
            $group = $user->group ?? null;  

            session([
                'user' => $user,
                'group' => $group,
            ]);

            if(!empty($group->name)) {
                switch($group->name) {
                    case 'Admin' : 
                        return redirect()->route('dashboard');
                    break;
                    case 'Vendor' :
                        return redirect()->route('item-labels');
                    break;
                }
            }

            return redirect()->intended('dashboard'); // redirect after login
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function createUser() {
        exit;
        $user = User::create([
            'name' => "Vendor",
            'email' => "vendor@lumaxworld.in",
            'password' => Hash::make("123456"),
            'sap_code' => '0000122003',
            'mobile_no' => '8899445566',
        ]);

        $adminGroup = Group::create(['name' => 'Vendor']);
        $user->group()->associate($adminGroup);
        $user->save();

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }
}
