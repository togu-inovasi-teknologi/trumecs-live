<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
$namemember = $sessionmember["name"];
$pointmember = $sessionmember["point"];
$levelmember = $sessionmember["level"];
?>

<!-- alert akun belum lengkap -->
<?php $arraynone = (array('shipping_method' => "", 'shipping_province' => "", "shipping_city" => "")); ?>
<?php if (in_array("", array_diff_assoc($sessionmember, $arraynone))) : ?>
	<div class="row m-t-1">
		<div class="col-xs-12">
			<div class="alert alert-warning borderalert">
				<strong>Perhatian!</strong> Akun anda belum lengkap, silahkan lengkapi akun Anda.
				<a href="<?php echo base_url() ?>member/setting" style="color: #ff9900;"><u>Lengkapi Sekarang</u></a>
			</div>
		</div>
	</div>
<?php endif ?>
<div class="col-xs-12" style="margin-top:-10px;">
	<?php if (isset($contentmember)) {
		$this->load->view($contentmember);
	} ?>
</div>

<style>
	.borderalert {
		font-size: 12px;
		color: #ff9900, 29%;
	}
</style>