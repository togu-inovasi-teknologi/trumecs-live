<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb p-x-0">
            <li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
            <li>Kemitraan</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <h1 class="text-center"><?php echo $this->lang->line('judul_halaman_partnership') ?></h1>
    </div>
</div>
<div class="listproduct row m-t-1 text-center ">
    <div class="col-lg-6">
        <div class="card p-a-2">
            <img src="<?php echo base_url("public/image/partnership.png"); ?>" width="70%" />
            <br />
            <br />
            <h2 class="m-y-1 fbold"><?php echo $this->lang->line('judul_principal') ?></h2>
            <p class="col-lg-10 col-lg-offset-1 m-y-1"><?php echo $this->lang->line('penjelasan_principal') ?></p>
            <a href="<?php echo base_url('principal/form') ?>" class="btn btn-lg btnnew text-center principal-button"><?php echo $this->lang->line('tombol_principal') ?></a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card p-a-2">
            <img src="<?php echo base_url("public/image/agent.png"); ?>" width="70%" />
            <br />
            <br />
            <h2 class="m-y-1 fbold"><?php echo $this->lang->line('judul_agen') ?></h2>
            <p class="col-lg-10 col-lg-offset-1 m-y-1"><?php echo $this->lang->line('penjelasan_agen') ?></p>
            <a href="<?php echo base_url('agent/form') ?>" class="btn btn-lg btnnew text-center agent-button"><?php echo $this->lang->line('tombol_agen') ?></a>
        </div>
    </div>
</div>
<!-- <div class="row">
<div class="col-lg-12 m-t-3 text-center">
    <a href="<?php echo base_url('principal/form') ?>" class="btn btn-lg btn-orange text-center">Daftar jadi supplier sekarang!</a>
    <br/>
    <br/>
    <p>atau</p>
    <p>Hubungi tim kami sekarang untuk mendapatkan penjelasan lebih lanjut</p>
    <p><a href="tel:+6282122668008">+62 821 2266 8008</a></p>
</div>
</div> -->