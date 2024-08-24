<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function register(){
        $price = mt_rand(100000,125000);
        return view('authentication.register', [
            'price' => $price
        ]);
    }
    public function login(){
        return view('authentication.login');
    }

    public function index(Request $request){
        $user = User::find(Auth::user()->id);
        
        if(count($user->likes) > 0){
            $excludedIds = $user->likes->pluck('receiver_id');
            $users = User::whereNot('id', Auth::user()->id)
            ->whereNotIn('id', $excludedIds)->where('is_visible', 1);
        } else{
            $users = User::whereNot('id', Auth::user()->id)->where('is_visible', 1);
        }

        if($request->keyword){
            $users->where('name', 'LIKE', '%'. $request->keyword.'%');
        }
        if($request->gender){
            if($request->gender == 'male'){
                $users->where('is_male', '1');
            } else if($request->gender == 'female'){
                $users->where('is_male', '0');
            }
        }
        return view('home', [
            'users' => $users->get(),
            'request' => $request
        ]);

        
    }

    public function index_new(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login'); 
        }

        if (count($user->likes) > 0) {
            $excludedIds = $user->likes->pluck('receiver_id');
            $users = User::where('is_visible', 1)
                ->whereNot('id', $user->id)
                ->whereNotIn('id', $excludedIds);
        } else {
            $users = User::where('is_visible', 1)
                ->whereNot('id', $user->id);
        }

        if ($request->keyword) {
            $users->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->gender) {
            if ($request->gender == 'male') {
                $users->where('is_male', 1);
            } else if ($request->gender == 'female') {
                $users->where('is_male', 0);
            }
        }

        return view('home', [
            'users' => $users,
            'request' => $request,
        ]);
    }

    public function like($id){
        Like::create([
            'user_id' => Auth::user()->id,
            'receiver_id' => $id
        ]);
        return redirect('/home');
    }

    public function dislike($id){
        $likes = Like::where('user_id', Auth::user()->id)->where('receiver_id', $id)->get();

        foreach($likes as $like){
            $like->delete();
        }
        return redirect('/liked');
    }


}
