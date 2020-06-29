<h1>投稿画面</h1>
<form method="POST" action="/upload" enctype="multipart/form-data" >
   {{ csrf_field() }}
   画像ファイル:<br>
   <input type="file" name="file">
   <br>コメント:<br>
   <textarea name="comment"></textarea>
   <input type="submit">
</form>
