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
<div id="page_c">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view("_form-filter-search") ?>
		</div>
		<div class="col-md-9">
			<?php $this->load->view($view_product) ?>
		</div>
	</div>

</div>

