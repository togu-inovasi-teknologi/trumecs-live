<?php 

function ctgprn($categori,$parent)
{
    $array = array();
    if ($parent!="") {
        foreach ($categori as $key) {
            if ($key["parent"]==$parent) {
                $datakey= array(
                    'id' => $key["id"],
                    'name'=>$key["name"]
                 );
                array_push($array, $datakey);
            }
        }
    }
    return $array;
    
}

$session_data=$this->session->all_userdata();

 ?>
<div id="page_caribanyaksparepart">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view("_form-filter-search") ?>
			<?php if ($this->agent->is_mobile()): ?>
			<?php else: ?>
			<div class="">
				<a alt="trumecs jual sparepart truk" href="<?php echo base_url(); ?>page/46/Cara-Berbelanja">
					<img alt="trumecs jual sparepart truk" class="img-responsive" src="<?php echo base_url(); ?>public/image/mudah-belisparepart.png">
				</a>
			</div>
		<?php endif ?>
		</div>
		<div class="col-md-9">
			<?php $this->load->view("_caribanyaksparepart") ?>
		</div>
	</div>

</div>

