@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" id="name" name="name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror"
                        placeholder="Name" value="{{ old("name")}}">

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror"
                        placeholder="Username" value="{{ old("username")}}">
                    @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" id="email" name="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror"
                        placeholder="email" value="{{ old("email")}}">

                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="dob" class="sr-only">Date Of Birth</label>
                    <input type="text" id="dob" name="dob" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('dob') border-red-500 @enderror"
                        placeholder="Date of Birth" value="{{ old("dob")}}">

                    @error('dob')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="designation" class="sr-only">Designation</label>
                    <input type="text" id="designation" name="designation" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('designation') border-red-500 @enderror"
                        placeholder="Designation" value="{{ old("designation")}}">

                    @error('designation')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center mt-3">
                        <input type="checkbox" name="gender" value="1" class="form-checkbox h-5 w-5 text-gray-600" {{ old("gender")== 1 ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700" >Male</span>
                    </label>
                    <label class="inline-flex items-center mt-3 ">
                        <input type="checkbox" name="gender" value="2"class="form-checkbox h-5 w-5 text-gray-600" {{ old("gender")== 2 ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700" >Female</span>
                    </label>

                    @error('gender')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="country" class="sr-only">Country</label>
                    <input type="text" id="country" name="country" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('country') border-red-500 @enderror"
                        placeholder="Country" value="{{ old("country")}}">

                    @error('country')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="fav_color" class="sr-only">Favorite Color</label>
                    <input type="text" id="fav_color" name="fav_color" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('fav_color') border-red-500 @enderror"
                        placeholder="Favorite Color" value="{{ old("fav_color")}}">

                    @error('fav_color')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="fav_actor" class="sr-only">Favorite Actor</label>
                    <input type="text" id="fav_actor" name="fav_actor" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('fav_actor') border-red-500 @enderror"
                        placeholder="Favorite Actor" value="{{ old("fav_actor")}}">

                    @error('fav_actor')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

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
                <div class="mb-4">
                    <label for="avatar" class="sr-only">Profile Pic</label>
                    <input type="file" id="avatar" name="avatar" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('avatar') border-red-500 @enderror"
                        placeholder="avatar" value="">
                    @error('avatar')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
    $( function() {
        $( "#dob" ).datepicker();
    } );

    </script>
@endsection
