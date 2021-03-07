@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 ">

            @if ( session('friend_added') )
            <div class="bg-green-500 p-4  rounded-lg mb-6 w-auto   text-white text-center">
                {{ session('friend_added') }}
            </div>
          @endif

            <div class="p-6">
                <div class="user-profile-overall">
                    <div class="profile-img">
                    <img src="{{asset('storage/'.$user->avatar)}}" alt="" class="h-24 w-24 flex items-center justify-center ml-8">
                    </div>
                    <div class="username">
                        <h1 class="text-2xl font-medium mb-1">{{$user->name}}</h1>
                    </div>
                    @if ((!$user->friendAdded($user)) && (!(auth()->user()->id == $user->id)))

                    <div class="addfriend mt-5">
                        <form action="{{ route('friend.addfriend',$user) }}" method="POST">
                            @csrf
                            <button class="p-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit" >Add friend</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="mb-4">
               <div class="mb-4">Email : {{$user->email}}</div>
               <div class="mb-4">Date of Birth :  {{ Carbon\Carbon::parse($user->dob)->format('d-m-Y') }}</div>
               <div class="mb-4">Designation : {{$user->designation}}</div>
               <div class="mb-4">country : {{$user->country}}</div>
               <div class="mb-4">Favourite Color : {{$user->fav_color}}</div>
               <div class="mb-4">Favourite Actor : {{$user->fav_actor}}</div>

               <div class="mb-4">Gender : {{ $user->gender == 1 ? 'Male' : 'Female'}}</div>
            </div>
        </div>
    </div>
@endsection
