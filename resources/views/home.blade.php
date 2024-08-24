@extends('template.master')

@section('title', 'Home')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-4xl font-extrabold mb-8 text-center text-gray-800">All Users</h1>

    <!-- Search and Filter Form -->
    <form action="" method="get" class="mb-8 flex justify-center items-center space-x-4">
        <select name="gender" id="gender" class="w-40 p-2.5 text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="all" {{ $request->gender == 'all' ? 'selected' : '' }}>All genders</option>
            <option value="male" {{ $request->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $request->gender == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        <div class="relative w-1/3">
            <input type="search" name="keyword" value="{{ $request->keyword }}" id="search-dropdown" class="block p-2.5 w-full text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Search by name">
            <button type="submit" class="absolute top-0 right-0 p-2.5 text-white bg-blue-700 rounded-r-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition duration-200 ease-in-out">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </form>

    <!-- Users Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($users as $user)
            <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <a href="#">
                    <img class="w-full h-48 object-cover rounded-t-lg border-t-4 border-gray-300" src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}'s Profile Picture">
                </a>
                <div class="p-6 text-center">
                    <h5 class="mb-2 text-2xl font-semibold text-gray-900">{{ $user->name }}</h5>
                    <a href="/user/{{ $user->id }}" class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition duration-200 ease-in-out">
                        Like
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
