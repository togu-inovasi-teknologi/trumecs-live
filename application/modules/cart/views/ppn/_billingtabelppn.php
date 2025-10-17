<table class="table text-left">
	<?php echo ($this->session->flashdata('message') == "")? "" : 
	'<div class="alert alert-warning alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.
	$this->session->flashdata('message').
	'</div>'
	; ?>  
	<thead>
		<tr>
			<th><strong>Nama produk</strong></th>
			<th><strong>Jumlah</strong></th>
			<th><strong>Harga</strong></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$total =0;
		$totalw=0;$totalweight=0;
		$quantity=0;
		$totaldimensi=0;
		$form=1;
		?>
		<?php foreach ($this->cart->contents() as $key): ?>
		<?php if ( $key["ppn"]>0): ?>
		<tr>
			<td>
				<a class="f12 fbold" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^A-Za-z0-9\-]/", "-", str_replace(" ", "-", ucwords($key["name"]))) ?>" ><?php echo ucwords($key["name"]) ?>
					[ <?php echo $key["partnumber_product"] ?> ] <?php echo $key["warranty"]!=NULL ? "<br>- Gransi : ".$key["warranty"]: ""; ?>
				</a>
			</td>
			<td>
				<?php echo $key["qty"] ?>
			</td>
			<td>Rp. <?php $totalprice=$key["price"]*$key["qty"];
			$total = $total+$totalprice;
			echo number_format($totalprice) ?></td>
			<td><a class="btn btn-circle  btn-sm btn-orange delproduct" data-rowid="<?php echo $key["rowid"] ?>"  data-produk="<?php echo $key["id"] ?>" data-rowid="<?php echo $key["rowid"] ?>"  data-qty="0"><i class="fa fa-trash f12"></i></a>
			</td>
		</tr>
		<?php 
		$totalpxyz=$key["px"]*$key["py"]*$key["pz"];
		$totaldimensi= $totaldimensi+$totalpxyz;
		$quantity=$quantity+$key["qty"];
		$totalw=$key["qty"]*$key["weight"];
		$totalweight=$totalweight+$totalw;
		?>
	<?php endif ?> 
<?php endforeach ?> 
<tr>
	<?php if ( $key["ppn"]>0): ?>
	<td></td>
	<td><strong>Total Harga</strong></td>
	<td>Rp. <?php echo number_format($total) ?></td>
	<td></td>
<?php else: ?>
	<td>Tidak ada yang di pesan</td>
<?php endif ?> 
</tr>
</tbody>
</table>

<small>
	*harga setiap produk sudah termasuk ppn
</small>