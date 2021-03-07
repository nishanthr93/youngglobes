@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 ">
            <div class="p-6">
                <div class="flex">
                   <h1 class="text-2xl font-medium mb-1">{{$user->name}}</h1><img src="{{$user->avatar}}" alt="" class="h-24 w-24 flex items-center justify-center ml-8">
                </div>
                <p>Posted {{$posts->count()}} {{ Str::plural('Post', $posts->count()) }}</p>
                <p>Total {{$user->recevied()->count()}} {{ Str::plural('Like', $user->recevied()->count()) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-user-post :post="$post" />
                    @endforeach

                    {{ $posts->onEachSide(2)->links() }}
                @else
                    <p> There is Post Yet</p>
                @endif
            </div>
        </div>
    </div>
@endsection
