<div class="" id="">
  <div class="card card-block">
  	<div class="row">
  		<div class="col-md-6">
  			<h1 class="f16 fbold">Cari banyak produk sekaligus</h1>
        <hr>
        <form class="crxformxxx"action="<?php echo base_url() ?>caribanyakproduct/getsearchingmoreproduct" method="POST">
        <div class="formadd">
          <div class="form-moresearch">
            <select name="col[]">
              <option value="tittle">Nama</option>
              <option value="partnumber">Part Number</option>
              <option value="physicnumber">Physic Number</option>
            </select><input name="name[]" required class="fms_xx"  type="text" id="fms_1" placeholder="ketik yang di cari" ><i class="fa fa-times-circle delpromxx"></i>
          </div>

        </div>
        <div class="btn-group m-y-1" role="group" aria-label="Second group">
          <a class="btn btn-secondary btn-addform"><i class="fa fa-plus-circle"></i> Tambah pencarian</a>
          <a class="btn btn-secondary " data-toggle="collapse" data-parent="#accordion" href="#bataslimite"><i class="fa fa-sort-numeric-asc "></i> Batas</a>
          <button type="submit" class="btn btn-secondary"> <i class="fa fa-search"></i> Cari</button>
        </div>
        <div class="collapse form-moresearch" id="bataslimite">
          <input type="number" name="limit" value="4"> <small>batas list setiap pencarian</small>
        </div>
        </form>
  		</div>
      <div class="col-md-6">
        <div class="alert alert-warning">
          <strong>Ribet cari spare part yang terlalu banyak?</strong><br>
          Coba deh gimana cepatnya cari banyak spare part sekaligus di trumecs.com tanpa ribet.
        </div>
      </div>
  	</div>
  </div>
</div>
<div class="clearfix"></div>
<div class="lalala">
<progress class="progress progress-warning " value="0" max="100">0%</progress>
</div>
<div class="retrunallsearchingajax">

</div>
