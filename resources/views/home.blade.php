@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if ( session('status') )
                <div class="bg-green-500 p-4  rounded-lg mb-6 w-auto   text-white text-center">
                    {{ session('status') }}
                </div>
          @endif

            @guest
                Login First
            @endguest
            @auth
                 Home
                    @if ($user->count())

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

                        {{ $user->onEachSide(2)->links() }}
                    @else
                        <p> There is Friends Yet</p>
                    @endif

            @endauth
        </div>
    </div>
@endsection
