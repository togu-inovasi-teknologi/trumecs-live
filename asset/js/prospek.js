var base_url= $("body").attr("baseurl");

$(document).on('change', 'input[name="qty"]', function() {
    value = $(this).val();
    harga = $("input[name='harga']").val();
    total = new Intl.NumberFormat('id-ID').format(value*harga);
    $("input[name='price']").val(total);
});


$(document).on('change', 'select[name="province"]', function() {
    id_province = $(this).val();
    url = base_url + "product/prospek/get_regencies";
    $.post(url,{id_province:id_province}, function(data){
        select = '';
        data = jQuery.parseJSON(data);
        $.each(data, function(index, item){
            select += "<option value='"+item.id+"'>"+item.name+"</option>"
        })
        
        $("select[name='regency']").html(select);
        $("select[name='regency']").css({'textTransform':'capitalize'});
    });
});

$(document).on('change', 'select[name="regency"]', function() {
    id_regency = $(this).val();
    url = base_url + "product/prospek/get_districts";
    $.post(url,{id_regency:id_regency}, function(data){
        select = '';
        data = jQuery.parseJSON(data);
        $.each(data, function(index, item){
            select += "<option value='"+item.id+"'>"+item.name+"</option>"
        })
        
        $("select[name='district']").html(select);
    });
});