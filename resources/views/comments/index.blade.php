@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-6/12 bg-white p-6 rounded-lg">
        <div class="mb-1">
         <x-user-post :post="$post"/>
        </div>
        <div class="mb-1">
            <form action="{{ route('comments.store', $post) }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="mt-2">
                    <label for="comment" class="sr-only">comment</label>
                    <textarea cols="30" rows="4" id="comment" name="comment"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('comment') border-red-500 @enderror"
                        placeholder="Comment" value="{{ old('comment') }}"></textarea>

                    @error('comment')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">
                        Comment
                    </button>
                </div>
            </form>
        </div>
        <div class="mt-2">
            @foreach ($comments as $item)
                <div class="mb-2">
                  <span> {{$item->user->username}} </span>
                </div>

                <div class="mb-2">
                  <span> {{$item->comments}} </span>
                </div>
                @auth
                    <div class="ml-2">
                        <form action="{{ route('comments.destroy', $item) }}" method="POST" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">
                                Delete
                            </button>
                        </form>
                    </div>
            @endauth
            @endforeach
        </div>
    </div>
</div>
@endsection
