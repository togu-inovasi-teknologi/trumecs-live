<?php
function ctgprnnavmobile($categori, $parent)
{
	$array = array();
	if ($parent != "") {
		foreach ($categori as $key) {
			if ($key["parent"] == $parent) {
				$datakey = array(
					'id' => $key["id"],
					'name' => $key["name"]
				);
				array_push($array, $datakey);
			}
		}
	}
	return $array;
}

?>
<nav class="navbar navbar-fixed-top " role="navigation">
	<div class="row">
		<div class="col-xs-2 p-x-0">
			<span class="btn navbar-toggle offcanvas-toggle offcanvas-toggle-close" data-toggle="offcanvas" data-target="#js-mobile-offcanvas"><i class="fa fa-bars"></i></span>
		</div>
		<div class="">
			<div class="col-xs-6 p-x-0">
				<div class="col-xs-12">
					<div class="col-xs-12">
						<a href="<?php echo base_url() ?>">
							<img src="<?php echo base_url() ?>public/image/logonew.png" class="img-fluid img-responsive">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</nav>

<div class="navmobile col-xs-12 col-sm-12 p-y-0 navbar navbar-offcanvas navbar-offcanvas-touch  hidden-md-up " role="navigation" id="js-mobile-offcanvas">
	<div class="row m-t-1">
		<?php $this->load->view("backend/_menuadmin"); ?>
	</div>
</div>