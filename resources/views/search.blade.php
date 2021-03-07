@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @guest
                Login First
            @endguest
            @auth
            <div class="mb-4" >
                <h1>{{$tittle}}</h1>
                 </div>
                    @if ($user)
                    <div class="mb-4 w-25">
                        <div class="search_friend">
                            <form action="{{ route('friend.search') }}" method="POST">
                                @csrf
                                <label for="Search" class="sr-only">Search</label>
                                <input type="Search" id="Search" name="Search" class="bg-gray-100 border-2 w-full p-4 rounded-lg"                           placeholder="Search" value="{{old("Search")}}">
                                @error('Search')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="mb-4 w-25">
                                    <label for="filter">Filter By:</label>
                                    <select name="filter" id="filter">
                                    <option value="name">Name</option>
                                    <option value="gender">Gender</option>
                                    <option value="fav_color">Favorite Color</option>
                                    <option value="fav_actor">Favorite Actor</option>
                                    </select>
                                </div>
                                <button class="p-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit" >Search</button>
                            </form>
                        </div>
                    </div>

                        @foreach ($user as $users)
                        <a href="{{ route("users.show",$users)}}">
                            <div class="mt-4">
                                <div class="user-profile-overall">
                                    <div class="profile-img">
                                    <img src="{{asset('storage/'.$users->avatar)}}" alt="" class="h-24 w-24 flex items-center justify-center ml-8">
                                    </div>
                                    <div class="username">
                                        <h1 class="text-2xl font-medium mb-1">{{$users->name}}</h1>
                                    </div>
                                    <div class="designation">
                                        <h1 class="text-2xl font-medium mb-1">{{$users->designation}}</h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach

                    @else
                        <p> There is NO Friends</p>
                    @endif

            @endauth
        </div>
    </div>
@endsection
