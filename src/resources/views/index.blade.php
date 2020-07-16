<h1>ホーム画面</h1>
<!-- 画像とコメントをすべて表示-->
@foreach($posts as $post)
    <div class="card-header text-center">
        <img src= {{ Storage::disk('s3')->url($post->image_file_name) }} alt="" width=250px height=250px></a>
    </div>
    <div class="card-body p-1">
        <span class="card-title">{{link_to('/profile',$post->user)}}<br>{{ $post->image_title }}</span>
    </div>
@endforeach
