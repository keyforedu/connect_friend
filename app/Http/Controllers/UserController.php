<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:100',
            'password' => 'required|min:3',
            'image' => 'required|image|file|max:2048',
            'phone' => 'required|numeric|unique:users',
            'is_male' => 'required',
            'job' => 'required',
            'price' => 'required',
            'payment' => 'required'
        ]);

        if($validatedData['payment'] < $validatedData['price']){
            $underpaid = ($validatedData['payment']-$validatedData['price'])*-1;
            return redirect('/register')->with('error', "You are still underpaid
            $underpaid");
        }

        $validatedData['image'] = $request->file('image')->store('user-image');
        $validatedData['password'] = bcrypt($validatedData['password']);

        $coin = $validatedData['payment'] - $validatedData['price'];

        $user = User::create([
            'name' => $validatedData['name'],
            'password' => $validatedData['password'],
            'image' => $validatedData['image'],
            'phone' => $validatedData['phone'],
            'is_male' => $validatedData['is_male'],
            'coin' => $coin
        ]);
        
        Job::create([
            'user_id' => $user->id,
            'id' => $validatedData['job']
        ]);
        
        return redirect('/login')->with('message', 'Your account has been created!');
    }

    public function login(){
        return view('authentication.login');
    }

    public function check_credential(Request $request){
        $credential = $request->validate([
            'password' => 'required',
            'phone' => 'required',
        ]);

        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect('/home');
        } else{
            // Login gagal
            return redirect('/login')->with('error', "Invalid Credentials");
        }
    }

    public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    }

    public function liked(){
        $user = User::find(Auth::user()->id);
        $likedId = $user->likes->pluck('receiver_id');
        return view('liked', [
            'users' => User::whereIn('id', $likedId)->where('is_visible', 1)->get(),
        ]);
    }

    public function profile(){
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    public function addcoin(Request $request){
        $user = User::find(Auth::user()->id);
        $user->coin += 1000;
        $user->update();
        return redirect('/profile');
    }

    public function changeVisibility(Request $request){
        $visibility = $request->visibility;

        $user = User::find(Auth::user()->id);
        $user->is_visible = $visibility;

        if($visibility == '1'){
            $user->coin -= 5000;
        } else{
            $user->coin -= 10000;
        }
        $user->update();

        return redirect('/profile');
    }
    
}
