@extends('template.master')

@section('title', 'Register')

@section('content')

@if(session()->has('error'))
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
    {{ session('error') }}
</div>
@endif

<h1 class="text-4xl font-extrabold text-center my-10 text-gray-800">Register</h1>
<form action="/register" method="POST" class="w-full max-w-lg mx-auto bg-white shadow-md rounded-lg p-8" enctype="multipart/form-data">
    @csrf

    <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
        {{-- @error('name')
            <div class="text-red-600">{{ $message }}</div>
        @enderror --}}
    </div>

    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
        {{-- @error('password')
            <div class="text-red-600">{{ $message }}</div>
        @enderror --}}
    </div>

    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
        <div class="flex items-center">
            <input type="radio" name="is_male" id="male" value="1" {{ old('is_male') == '1' ? 'checked' : '' }}>
            <label for="male" class="ml-2">Male</label>
            <input type="radio" name="is_male" id="female" value="0" {{ old('is_male') == '0' ? 'checked' : '' }} class="ml-4">
            <label for="female" class="ml-2">Female</label>
        </div>
        {{-- @error('is_male')
            <div class="text-red-600">{{ $message }}</div>
        @enderror --}}
    </div>

    <div class="mb-6">
        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Profile Picture</label>
        <input type="file" name="image" id="image" onchange="previewImage()" class="border border-gray-300 rounded-lg w-full">
        <img class="img-preview mt-2" src="" alt="" style="display:none; max-width: 100%; height: auto;">
        {{-- @error('image')
            <div class="text-red-600">{{ $message }}</div>
        @enderror --}}
    </div>

    <div class="mb-6">
        <input type="hidden" name="price" value="{{ $price }}">
        <label for="payment" class="block mb-2 text-sm font-medium text-gray-900">Registration Price: {{ $price }}. Enter your amount to pay</label>
        <input type="text" name="payment" value="{{ old('payment') }}" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
        {{-- @error('payment')
            <div class="text-red-600">{{ $message }}</div>
        @enderror    --}}
    </div>

    @foreach (['job'] as $job)
        <div class="mb-6">
            <label for="{{ $job }}" class="block mb-2 text-sm font-medium text-gray-900">Choose Your {{ ucfirst(str_replace('_', ' ', $job)) }}</label>
            <select name="{{ $job }}" id="{{ $job }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
                @php
                    $jobs = \App\Models\Job::all();
                @endphp
                @foreach ($jobs as $jobItem)
                    <option value="{{ $jobItem->id }}">{{ $jobItem->name }}</option>
                @endforeach
            </select>
            {{-- @error($job)
                <div class="text-red-600">{{ $message }}</div>
            @enderror    --}}
        </div>
    @endforeach

    <div class="mb-6">
        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Your Phone</label>
        <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
        {{-- @error('phone')
            <div class="text-red-600">{{ $message }}</div>
        @enderror --}}
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5">Submit</button>
    <p class="my-5 text-center">If you already have an account, <a href="/login" class="text-blue-500">Login here</a></p>
</form>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvenet) {
            imgPreview.src = oFREvenet.target.result;
        }
    }
</script>

@endsection
