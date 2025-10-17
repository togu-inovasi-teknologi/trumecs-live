$(document).on('click', '.r_jenis', function() {
	val = $(this).val();
	if (val == 'barang') {
		$('#jenis_transaksi').show();
		$('.form_jasa').hide();
	} else {
		$('#jenis_transaksi').hide();
		$('.form_jasa').show();
	}
});

$(".addHint").focus(function ()
{
	$('.hint-first').hide();
	$('.hint').show();
	$('.hint .alert').html($(this).data('hint'));
	$('.hint .title-hint').html($(this).data('title'));
}).blur(function ()
{
	$('.hint').hide();
	$('.hint-first').show();
});

$(document).on('click', '.c_jenis', function() {
	val = $(this).val();
	checked = $(this).prop('checked');
	if (checked == true) {
		if (val == 'jual') {
			$('.form_jual').show();
		} else { 
			$('.form_rental').show();
		}
	} else { 
		if (val == 'jual') {
			$('.form_jual').hide();
		} else { 
			$('.form_rental').hide();
		}
	}
});
$(document).on('change','#tipe', function () {
	if (this.value == 'aksesoris' || this.value == 'sparepart')
		$('#part_number').show();
	else
		$('#part_number').hide();
});

var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

$(document).on('click', '.btn-upload', function () { 
	$('.btn-upload-hide').click();
})
	
$("#upload-image").dropzone({
	url: base_url + "bulk/upload",
	parallelUploads: 3,
	clickable: ".btn-upload-hide",
	previewTemplate: previewTemplate,
	autoQueue: true,
	maxFiles: 5,
	previewsContainer: "#previews",
	acceptedFiles: '.jpg, .jpeg, .png, .zip',
        init: function() {
			this.on("complete", file => {
				console.log(file);	
				
                $(file).each(function(index, item){
                    response = JSON.parse(item.xhr.response)
					$("#upload-image").append('<input type="hidden" name="files[]" value="' + response.name + '" />');
					$('.btn-upload').eq(0).remove();
						
					setTimeout(function(){
           				$(item.previewElement).find('.progress').fadeOut(1000);
      				},500);
                });
            })
            this.on("removedfile", file => {
                response = JSON.parse(file.xhr.response)
                filename = response.name;
                $.post(base_url+'bulk/remove',{filename:filename},function(data){
					$('input[value="' + filename + '"]').remove();
					$(".form-upload-image").append($("#form-upload-image").html());
                });
            });
        }
    });