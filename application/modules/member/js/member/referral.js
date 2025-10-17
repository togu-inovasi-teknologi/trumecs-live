$(document).ready(function () {
        $("#copyReferral").click(function () {
            var referralCode = $("#referralCode");
            var tempInput = $("<input>");
            tempInput.val(referralCode.text());
            $("body").append(tempInput);
            console.log(tempInput);
            tempInput.select();
            document.execCommand("copy");
            tempInput.remove();
            alert("Kode Referral berhasil disalin!");
        });
});
$('select[name="bank_name"]').on('change', function(){
    fee = $(this).val() == 'Mandiri' ? 0 : 6500;
    $('input[name="transfer_fee"]').val(fee);
});