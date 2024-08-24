@extends('template.master')

@section('title', 'Login')

@section('content')

@if(session()->has('error'))
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
    {{ session('error') }}
</div>
@endif

<h1 class="text-4xl font-extrabold text-center my-10 text-gray-800">Login</h1>
<form action="/login" method="POST" class="w-full max-w-lg mx-auto bg-white shadow-md rounded-lg p-8" enctype="multipart/form-data">
    @csrf

    <div class="mb-6">
        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Enter your phone number</label>
        <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
        @error('phone')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Enter your password</label>
        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
        @error('password')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5">Login</button>
    <p class="my-5 text-center">If you don't have an account yet, please <a href="/register" class="text-blue-500">register</a></p>
</form>

@endsection
