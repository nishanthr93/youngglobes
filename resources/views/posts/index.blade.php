@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-6/12 bg-white p-6 rounded-lg">
            @if ( session('status') )
                <div class="bg-green-500 p-4  rounded-lg mb-6  text-white text-center">
                    {{ session('status') }}
                </div>
             @endif
            <div class="mb-1">
                <form action="{{ route('posts.index') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mt-2">
                            <input type="file" name="file" class="custom-file-input" id="chooseFile" value="{{ old('file') }}">
                    </div>
                    @error('file')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mt-2">
                        <label for="body" class="sr-only">body</label>
                        <textarea cols="30" rows="4" id="body" name="body"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                            placeholder="Post Something" value="{{ old('body') }}"></textarea>

                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">
                            Post
                        </button>
                    </div>
                </form>
            </div>
            <div>
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-user-post :post="$post"/>
                    @endforeach

                    {{ $posts->onEachSide(2)->links() }}
                @else
                    <p> There is Post Yet</p>
                @endif
            </div>
        </div>
    </div>
@endsection
