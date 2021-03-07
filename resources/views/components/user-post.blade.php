<div>
    <div class="mt-4">

        <x-media-viwer :post="$post"/>

        <a href="{{ route("user.posts",$post->user)}}" class="font-bold">{{ $post->user->name }}</a><span
            class="text-gray-600 text-sm p-1">{{ $post->created_at->diffForHumans() }}</span>
        <p class="mb-2 mt-1">
            {{ $post->body }}
        </p>
        <div class="flex items-center">

            @auth
                @if (!$post->likedby(auth()->user()))
                    <form action="{{ route('posts.likes', $post) }}" method="POST" class="mr-1">
                        @csrf
                        <button type="submit" class="text-blue-500">
                            Like
                        </button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post) }}" method="POST" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500">
                            Unlike
                        </button>
                    </form>
                @endif
            @endauth
            <div class="px-3">
                <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
            </div>

            <div class="px-3">
                <a href="{{ route('comments.index', $post) }}">
                    <span>{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</span>
                </a>
            </div>

            @auth
                @if (!auth()->user()->cannot('delete', $post))
                    <div class="ml-2">
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>

    </div>
</div>
