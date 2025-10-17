var baseurl = $("body").attr("baseurl");
$(document).on('click', '.update-kontak', function(data){
    url = baseurl + 'backendprospek/admin/get_detail_kontak';
    id_kontak = $(this).data('idkontak');
    $.post(url, {id_kontak : id_kontak}, function(data){
        data = jQuery.parseJSON(data);
        if(data.result == "success") {
            $(".form_update input[name='id_kontak']").val(data.id_kontak);   
            $(".form_update input[name='name']").val(data.name);   
            $(".form_update input[name='phone']").val(data.phone);   
            $(".form_update input[name='email']").val(data.email);   
            $(".form_update input[name='position']").val(data.position);   
            $(".form_update textarea[name='additional_information']").val(data.additional_information);   
        } else {
            window.reload();
        }
    });
});

$(document).on('click', '.delete-kontak', function(){
    data = confirm("Anda yakin ingin menghapus kontak ini?");
    return data;
});