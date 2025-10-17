ini cuma layanan administrator untuk looping upload file<br>
<div class="caca">
<form action="<?php echo base_url() ?>backendsetting/uploadloopimg" method="POST" enctype="multipart/form-data">
<input type="file" name="img">
<input type="number" name="loop" placeholder="88">
<input type="text" name="name" placeholder="nama">
<input type="text" name="format" placeholder=".jpg">
<input type="text" name="path" placeholder="./public/image/path/copy/place">
<button type="submit">proses</button>
</form>
</div>