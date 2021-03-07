@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            @if ( session('status') )
                <div class="bg-red-500 p-4  rounded-lg mb-6  text-white text-center">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('password.update',$user) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror"
                        placeholder="password" value="">
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password confirmation</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg" placeholder="Password confirmation" value="">
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
