<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <h1 class="text-center"><?php echo $this->lang->line('judul_halaman_partnership') ?></h1>
    </div>
</div>
<div class="row">
    <div class="listproduct row m-t-3 text-center ">
        <div class="col-xs-6">
            <div class="card p-a-2">
                <img src="<?php echo base_url("public/image/partnership.png"); ?>" width="70%"/>
                <br/>
                <br/>
                <h3 class="m-y-2" style="font-size:20px"><strong><?php echo $this->lang->line('judul_principal') ?></strong></h3>
                <p class="col-xs-10 col-xs-offset-1 m-y-2"><?php echo $this->lang->line('penjelasan_principal') ?></p>
                <a href="<?php echo base_url('principal/form') ?>" class="btn btn-lg btn-orange text-center principal-button"><strong><?php echo $this->lang->line('tombol_principal') ?></strong></a>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="card p-a-2">
                <img src="<?php echo base_url("public/image/agent.png"); ?>" width="70%"/>
                <br/>
                <br/>
                <h3 class="m-y-2" style="font-size:20px"><strong><?php echo $this->lang->line('judul_agen') ?></strong></h3>
                <p class="col-xs-10 col-xs-offset-1 m-y-2"><?php echo $this->lang->line('penjelasan_agen') ?></p>
                <a href="<?php echo base_url('agent/form') ?>" class="btn btn-lg btn-orange text-center agent-button"><strong><?php echo $this->lang->line('tombol_agen') ?></strong></a>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-xs-12 m-t-3 text-center">
        <a href="<?php echo base_url('principal/form') ?>" class="btn btn-lg btn-orange text-center"><strong>Daftar jadi supplier sekarang!</strong></a>
        <br/>
        <br/>
        <p>atau</p>
        <p>Hubungi tim kami sekarang untuk mendapatkan penjelasan lebih lanjut</p>
        <p><a href="tel:+6282122668008">+62 821 2266 8008</a></p>
    </div>
</div> -->