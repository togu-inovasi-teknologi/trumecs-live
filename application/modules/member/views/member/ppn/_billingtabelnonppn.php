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
			<th><strong>Harga Satuan</strong></th>
	        <th><strong>Harga Total</strong></th>
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
		<?php foreach ($datadetail as $key): ?>
		<?php if ( $key["ppn"]=0): ?>
		<tr>
			<td>
				<?php echo ucwords($key["name_product"]) ?>
				[ <?php echo $key["partnumber_product"] ?> ] <?php echo $key["warranty"]!=NULL ? "<br>- Gransi : ".$key["warranty"]: ""; ?>
			</td>
			<td>
				<?php echo $key["quantity"] ?>
			</td>
			<td>Rp. <?php echo number_format($key["price"]); ?></td>
			<td>Rp. <?php $totalprice=$key["price"]*$key["quantity"];
			$total = $total+$totalprice;
			echo number_format($totalprice); ?>
			</td>
		</tr>
		<?php 
		$totalpxyz=$key["px"]*$key["py"]*$key["pz"];
		$totaldimensi= $totaldimensi+$totalpxyz;
		$quantity=$quantity+$key["quantity"];
		$totalw=$key["quantity"]*$key["weight"];
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
	*) Harga produk diatas tidak menggunakan ppn
</small>