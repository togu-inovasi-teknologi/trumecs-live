$(document).ready(function(){
    $('#tablelist').DataTable();
    $('.tablelist').DataTable();
});

$( document ).ready(function() {
	var base_url= $("body").attr("baseurl");
	//$("select[name=shipping_city]").load(base_url+"general/getcity");

	$("select[name=province]").load(base_url+"general/getwilayahprovince",function() {
		var id = $(this).attr("id");
		$(this).val(id);
		if (id!="") {
			$("select[name=city]").load(base_url+"general/getwilayahrigences?id="+id,function() {
				$("select[name=city]").val($("select[name=city]").attr("id"));
			});
		};
	}).on('change', function() {
		$("select[name=city]").load(base_url+"general/getwilayahrigences?id="+$(this).val(),function() {
		});
		$("select[name=districts]").html('<option value="">-Pilih Kecamatan-<option>');
		$("select[name=village]").html('<option value="">-Pilih Desa-<option>');
	});

	$("select[name=city]").load(base_url+"general/getwilayahrigences",function() {
		var id = $(this).attr("id");
		$(this).val(id);
		if (id!="") {
			$("select[name=districts]").load(base_url+"general/getwilayahdistricts?id="+id,function() {
				$("select[name=districts]").val($("select[name=districts]").attr("id"));
			});
		};
	}).on('change', function() {
		$("select[name=districts]").load(base_url+"general/getwilayahdistricts?id="+$(this).val(),function() {
		});
		$("select[name=village]").html('<option value="">-Pilih Desa-<option>');
	});
	

	$("select[name=districts]").load(base_url+"general/getwilayahdistricts?id=",function() {
		var id = $(this).attr("id");
		$(this).val(id);
		if (id!="") {
			$("select[name=village]").load(base_url+"general/getwilayahvillages?id="+id,function() {
				$("select[name=village]").val($("select[name=village]").attr("id"));
			});
		};
	}).on('change', function() {
		$("select[name=village]").load(base_url+"general/getwilayahvillages?id="+$(this).val(),function() {
		});
	});

	$("select[name=village]").load(base_url+"general/getwilayahvillages?id=",function() {
		var id = $(this).attr("id");
		$(this).val(id);
	});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("select[name=shipping_province]").load(base_url+"general/getwilayahprovince",function() {
		var id = $(this).attr("id");
		$(this).val(id);
		if (id!="") {
			$("select[name=shipping_city]").load(base_url+"general/getwilayahrigences?id="+id,function() {
				$("select[name=shipping_city]").val($("select[name=shipping_city]").attr("id"));
			});
		};
	}).on('change', function() {
		$("select[name=shipping_city]").load(base_url+"general/getwilayahrigences?id="+$(this).val(),function() {
		});
		$("select[name=shipping_districts]").html('<option value="">-Pilih Kecamatan-<option>');
		$("select[name=shipping_village]").html('<option value="">-Pilih Desa-<option>');
	});

	$("select[name=shipping_city]").load(base_url+"general/getwilayahdistricts",function() {
		var id = $(this).attr("id");
		$(this).val(id);
		if (id!="") {
			$("select[name=shipping_districts]").load(base_url+"general/getwilayahdistricts?id="+id,function() {
				$("select[name=shipping_districts]").val($("select[name=shipping_districts]").attr("id"));
			});
		};
	}).on('change', function() {
		$("select[name=shipping_districts]").load(base_url+"general/getwilayahdistricts?id="+$(this).val(),function() {
		});
		$("select[name=shipping_village]").html('<option value="">-Pilih Desa-<option>');
	});
	

	$("select[name=shipping_districts]").load(base_url+"general/getwilayahdistricts",function() {
		var id = $(this).attr("id");
		$(this).val(id);
		if (id!="") {
			$("select[name=shipping_village]").load(base_url+"general/getwilayahvillages?id="+id,function() {
				$("select[name=shipping_village]").val($("select[name=shipping_village]").attr("id"));
			});
		};
	}).on('change', function() {
		$("select[name=shipping_village]").load(base_url+"general/getwilayahvillages?id="+$(this).val(),function() {
		});
	});

	$("select[name=shipping_village]").load(base_url+"general/getwilayahvillages",function() {
		var id = $(this).attr("id");
		$(this).val(id);
	});

});