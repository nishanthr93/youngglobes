@component('mail::message')
# Your Post was Commented

{{$commenter->name}} Commented Your Post.

@component('mail::button', ['url' => route("comments.store",$post)])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
