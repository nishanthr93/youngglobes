<div>
    @if ($post->file_type == "video")
    <video class="md:w-auto" controls>
        <source src="{{asset('storage/'.$post->file_path)}}" type="video/mp4">
        Your browser does not support HTML video.
    </video>
    @else
    <img src="{{asset('storage/'.$post->file_path)}}" alt="Girl in a jacket" class="md:w-auto">
    @endif

</div>
