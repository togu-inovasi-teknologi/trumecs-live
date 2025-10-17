$(document).ready(function () {

    $('#form-input-delivery').submit(function (e) { 
        
        if($('.uploaded-file-deliver').html() == ""){
            $('#validation-file').html('Upload File Deliveri Terlebih dahulu.');
            e.preventDefault();
        }else {
            var resi = $('input[name="shipping_resi"]').val();
            if(resi === '')
            {
                $('#validation-resi').html('Input Resi Pengiriman.');   
                e.preventDefault();
            }
            
        }
    });

    $('#upload-file-delivery').change(function (e) { 
        e.preventDefault();
        var file = this.files[0];
        $('#validation-file').html('');
        $('.uploaded-file-deliver').html(file.name);
    });
    

    var element = document.getElementById('dropwdown-tempo');
    var fieldTempo = document.getElementById('tempo-value');

    var selectorPrice = document.querySelector('th[name="total_selling_price"]');
    const dataValue = selectorPrice.getAttribute('data-value');
    

    fieldTempo.innerHTML = 0;
    element.addEventListener('change', function(e) {
        var hargaBeli = dataValue;
        var tempo = e.target.value;
        var total = 0;
        if (tempo == 30) {
            total = 0.015 * hargaBeli;

        } else if (tempo == 60) {
            total = 0.03 * hargaBeli;
        } else if (tempo == 90) {
            total = 0.045 * hargaBeli;
        } else {
            total = 0;
        }

        var td = document.getElementById('tempo-value');
        td.innerHTML = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    })
});

const rupiah = (number)=>{
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0, // Minimum desimal 0
        maximumFractionDigits: 2, // Maksimum desimal 2
    });
    return formatter.format(number);
  }