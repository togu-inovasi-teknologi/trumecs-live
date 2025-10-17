$(document).ready(function () {
    $(document).on('change', 'select[name="shipping_province"]', function (e) {
        $.ajax({
            type: "POST",
            url: base_url + 'backendorder/get_city',
            data: {
                province_name: $(this).val(),
            },
            dataType: "json",
            success: function (response) {
                $('select[name="shipping_city"]').html('');
                $.each(response, function (i, value) { 
                    $('select[name="shipping_city"]').append(`<option value="${value.name}">${value.name}</option>`)
                });
                
            }
        });
    });

    $(document).on('change', 'input[name="file_delivery"]', function (e) {
        var file = this.files[0];
        $('#file_delivery_name').html(file.name);
    });
});