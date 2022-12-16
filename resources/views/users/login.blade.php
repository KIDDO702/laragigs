@extends('layout')
@section('content')
    <x-card
                    class="p-10 max-w-lg mx-auto mt-2"
                >
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Login
                        </h2>
                        <p class="mb-4">Login to post a gig</p>
                    </header>

                    <form method="POST" action="/users/authenticate">
                        @csrf
                        <div class="mb-6">
                            <label for="email" class="inline-block text-lg mb-2"
                                >Email</label
                            >
                            <input
                                type="email"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="email"
                                value="{{old('email')}}"
                            />
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label
                                for="password"
                                class="inline-block text-lg mb-2"
                            >
                                Password
                            </label>
                            <input
                                type="password"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="password"
                                value=""
                            />
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Sign In
                            </button>
                        </div>

                        <div class="mt-8">
                            <p>
                                Dont have an account?
                                <a href="/register" class="text-laravel"
                                    >Signup</a
                                >
                            </p>
                        </div>
                    </form>
                </x-card>
@endsection