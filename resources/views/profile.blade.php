@extends('template.master')

@section('title', 'Profile')

@section('content')

<div class="container mx-auto p-6">
    <div class="flex flex-col items-center bg-white shadow-lg rounded-lg p-6">
        <!-- User Profile Image -->
        <div class="mb-4">
            <img class="rounded-full w-32 h-32 object-cover border-4 border-gray-200" 
                 src="{{ $user->is_visible ? asset('storage/'.$user->image) : '/bear.png' }}" 
                 alt="{{ $user->name }}">
        </div>
        
        <h1 class="text-4xl font-bold text-gray-800">{{ $user->name }}</h1>
        <p class="text-lg text-gray-600 mt-2">Your Coins: <span class="font-semibold text-gray-900">{{ $user->coin }}</span></p>

        
        <!-- Visibility Change Form -->
        <form action="/profile/changeVisibility" method="POST" class="mt-6 text-center">
            @csrf
            <p class="text-lg mb-2">Current Status: 
                <span class="{{ $user->is_visible ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}">
                    {{ $user->is_visible ? 'VISIBLE' : 'HIDDEN' }}
                </span>
            </p>
            <input type="hidden" name="visibility" value="{{ $user->is_visible ? 0 : 1 }}">
            <button type="submit" class="{{ $user->is_visible ? 'text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300' : 'text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200' }} font-semibold rounded-lg text-sm px-6 py-3 transition duration-300 ease-in-out mt-4">
                {{ $user->is_visible ? 'Hide for 10000 coins' : 'Restore for 5000 coins' }}
            </button>
        </form>

        <!-- Add Coin Button -->
        <form action="/profile/addcoin" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-semibold rounded-lg text-sm px-6 py-3 transition duration-300 ease-in-out">
                + Add 1000 coins
            </button>
        </form>
    </div>
</div>

@endsection
