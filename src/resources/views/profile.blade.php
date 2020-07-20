<h1>プロフィール画面</h1>
<img src="https://avatars.githubusercontent.com/{{ $username }}">
{{ $username }}
@foreach($posts as $post)
@if ($post->user===$username)
    <div class="card-header text-center">
        <img src= {{ Storage::disk('s3')->url($post->image_file_name) }} alt="" width=250px height=250px></a>
    </div>
@endif
@endforeach
