$('select[name="bank_name"]').on('change', function(){
    fee = $(this).val() == 'Mandiri' ? 0 : 6500;
    $('input[name="transfer_fee"]').val(fee);
});