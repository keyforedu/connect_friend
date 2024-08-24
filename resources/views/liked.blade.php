@extends('template.master')

@section('title', 'Your Friend')

@section('content')

<h1 class="text-3xl font-extrabold text-center my-10 text-gray-800">Your Friends</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 p-10">

    @foreach ($users as $user)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/'.$user->image) }}" alt="User Image" />
            <div class="p-5 flex flex-col items-center text-center">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">{{ $user->name }}</h2>
                
                @php
                    $id1 = Illuminate\Support\Facades\Auth::user()->id;
                    $id2 = $user->id;

                    $id1Likeid2 = count(\App\Models\Like::where('user_id', $id1)->where('receiver_id', $id2)->get()) > 0;
                    $id2Likeid1 = count(\App\Models\Like::where('user_id', $id2)->where('receiver_id', $id1)->get()) > 0;
                    $likeEachOther = $id1Likeid2 && $id2Likeid1;
                @endphp
                
                @if($likeEachOther)
                    <p class="mb-3 text-green-700">You like each other!</p>
                    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Chat now!</button>
                    <a href="/dislike/{{ $user->id }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Remove friend</a>
                @else
                    <p class="mb-3 text-red-700">Doesn't like you back!</p>
                    <a href="/dislike/{{ $user->id }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Remove friend</a>
                @endif
            </div>
        </div>
    @endforeach

</div>

@endsection
