var base_url =$("body").attr("baseurl");
$(document).ready(function () {
    $('.tab-search').click(function (e) { 
        e.preventDefault();
        if($('.tab-search').hasClass('active')){
            $('.tab-search').removeClass('active');
        };

        $(this).addClass('active');
    });

    $(document).on('change','#category-options', function (e) { 
        e.preventDefault();
        _checkButtonDisabled();
        $.ajax({
            type: 'GET',
            url: base_url + `/general/getmerekall/${$(this).val()}/false`,
            success: function (response) {
                $('#merk-options').html(response)
            }
        });
    });

    $(document).on('keyup', 'input[name=keyword]',function (e) { 
        _checkButtonDisabled();
    });



   
});

function _checkButtonDisabled()
{
    
    if($('input[name=keyword]').val() !== ''){
        $('#btn-submit-search').removeAttr('disabled');
    }else if($('select[name=komponen]').val() !== ''){
        $('#btn-submit-search').removeAttr('disabled');
    }else{
        $('#btn-submit-search').attr('disabled', '');
    }
}