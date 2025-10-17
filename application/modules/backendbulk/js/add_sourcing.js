var items = [];
var supplierIndex;

$(document).ready(function () {
    //toggleSupplierButton();
    
    var previewNode = document.querySelector("#template");
      previewNode.id = "";
      var previewTemplate = previewNode.parentNode.innerHTML;
      previewNode.parentNode.removeChild(previewNode);
      $("#uploader").dropzone({
        url: base_url + "bulk/upload",
        parallelUploads: 3,
        clickable: ".btn-upload",
        previewTemplate: previewTemplate,
        autoQueue: true,
        maxFiles: 3,
        previewsContainer: "#previews",
        acceptedFiles: ".xls, .xlsx, .png, .jpg, .jpeg, .docx, .pdf",
        init: function () {
          this.on("dragenter", function () {
            $("#uploader").addClass("drag-enter");
          });
          this.on("dragleave", function () {
            $("#uploader").removeClass("drag-enter");
          });
          this.on("complete", (file) => {
            $(file).each(function (index, item) {
              response = JSON.parse(item.xhr.response);
              $("#uploader").removeClass("drag-enter");
              $("#uploader").append(
                '<input type="hidden" name="files[]" value="' +
                  response.name +
                  '" />'
              );
              setTimeout(function () {
                $(item.previewElement).find(".progress").fadeOut(1000);
              }, 500);
            });
          });
          this.on("removedfile", (file) => {
            response = JSON.parse(file.xhr.response);
            filename = response.name;
            $.post(
              base_url + "bulk/remove",
              { filename: filename },
              function (data) {
                $('input[value="' + filename + '"]').remove();
              }
            );
          });
        },
      });
    
    

    $('input[type="radio"]').change(function (e) { 
        e.preventDefault();
        toggleSupplierButton();
    });


    if($('input[name="village_id"]').val() != '')
    {
        const village_id = $('input[name="village_id"]').val();

        $.ajax({
            type: "GET",
            url: base_url + 'getjson/getAddressByVillage/' + village_id,
            dataType: "json",
            success: function (response) {
                var adddress = `${response.village} > ${response.district} > ${response.regency} > ${response.province}`;
                $('input[name="village_id"]').parent().append(`
                    <span class="text-muted m-t-1 billing_show">Alamat : ${capitalizeFirst(adddress)}</span>
                `)
                console.log(response);
            }
        });

    }

    $('.add-item-list').click(function (e) { 
        e.preventDefault();

        
        
        $('table.table-item tbody').append(`
        <tr>
            <td>
            <input type="hidden" name="id_items[]" class="form-control product-id"
                                        id="id_items">
            <input type="name" name="items[]" class="form-control product-name" id="name"
                    placeholder="Masukan nama item">
            </td>
            <td>
            <input type="number" name="qty[]" class="form-control" id="qty" value="1" min="1">
            </td>
            <td>
            <input type="text" name="uom[]" class="form-control" id="uom" value="">
            </td>
            <td>
            <input type="number" name="price[]" class="form-control" id="price" placeholder="0">
            </td>
            <td>
                <input type="text" name="notes[]" class="form-control" id="notes" value="">
            </td>
            <td><button class="btn btn-sm btn-danger remove-list-item"><i
                        class="fa fa-fw fa-trash"></i></button>
            </td>
        </tr>
        <tr class="select-supplier">
            <!--<td class="text-right" >
                <a href="#" class="supplier-source" data-toggle="modal"
                    data-target="#modalSupplier">Supplier</a>
            </td>
            <td></td>
            <td></td>
            <td></td>-->
        </tr>
        `)

        toggleSupplierButton();
    });



   $(document).on('click', '.remove-list-item', function(e) {
        $(this).parent().parent().remove();
   })
   
   

    // $(document).on('keyup', '.price-quantity', function (e) { 
        
    //     var val = e.target.value;
       
        
    //     var valueFormat = formatRupiah(val);
    //     console.log(valueFormat);
    //     e.target.value = valueFormat
    // });

    $(document).on('focus', '.product-name', function (e) { 
        e.preventDefault();
        setAddressAutocomplete($(this), base_url + 'getjson/items',function (ul, item) {
        
            label = item.tittle;
            return $( "<div class='border-sm bg-white f12'>" )
                .append( `<div class="f14"> ${label} - ${item.category} (${item.brand}) </div>` )
                .appendTo( ul );
    
        }, function (event, ui) {
            
            $(this).parent().children().eq(0).val(ui.item.product_id)
            $(this).val(ui.item.tittle);
    
            return false;
        });
    });
    
    

    setAddressAutocomplete($('input[name="village"'), base_url + 'getjson/villages',function (ul, item) {
        
        label = item.label;
        return $( "<div class='border-sm bg-white f12'>" )
            .append( "<div>" + label + "</div>" )
            .appendTo( ul );

    }, function (event, ui) {
        $('input[name="village_id"').val(ui.item.value);

        $('.billing_show').remove();

        $(this).parent().append(`
            <span class="text-muted m-t-1 billing_show">Alamat : ${ui.item.label}</span>
        `)

        return false;
    });
    
    setAddressAutocomplete($('input[name="contact"]'), base_url + 'getjson/contacts', function(ul, item){
        
        label = item.contact_name;
        company = item.company;
        telephone = item.telephone;
        return $( "<div class='border-sm bg-white f12'>" )
            .append( `<h6>${label} - (${company}) - ${telephone} </h6>` )
            .appendTo( ul );
    },function(event, ui){
        
        $('input[name="contact_id"').val(ui.item.id);
        $('input[name="company_id"').val(ui.item.company_id);

        

        $('.contact-alert-space').append(`
            <p class="f16 fbold m-a-0 m-t-1">Data Kontak</p>
            <div class="alert alert-info alert-info-contact alert-dismissible" role="alert">
                <button type="button" class="contact-close close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span class="font-weight-bold">${ui.item.contact_name}</span> -
                <span class="text-muted">${ui.item.telephone}</span>
            </div>
        `);
        $('.company-alert-space').append(`
            <p class="f16 fbold m-a-0">Data Perusahaan</p>
            <div class="alert alert-info alert-info-contact alert-dismissible" role="alert">
                <button type="button" class="company-close close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span class="font-weight-bold">${ui.item.company}</span> -
                <span class="text-muted">${ui.item.company_phone}</span>
            </div>
        `);

        $('.contact-close').click(function (e) { 
            e.preventDefault();
            $('input[name="contact_id"').val();
            $('input[name="company_id"').val();
            $('.alert-info-contact').remove();
            $('.company-alert-space').html('');
            $('.contact-alert-space').html('');
        });

        $('.company-close').click(function (e) { 
            e.preventDefault();
            $('input[name="contact_id"').val();
            $('input[name="company_id"').val();
            $('.alert-info-contact').remove();
            $('.company-alert-space').html('');
            $('.contact-alert-space').html('');
        });

    });

    $(document).on('click', '.delete-source', function (e) {
        console.log('hllo');
        e.preventDefault();
        $(this).parent().parent().remove();
        
    });

    $(document).on('click', '.btn-delete-source', function (e) {
        console.log('hllo');
        e.preventDefault();

        $(this).parent().parent().parent().remove();
    });



    $(document).on('click', '.supplier-source', function () {
        var table;
        var dt;

        supplierIndex = $(this).parent().parent().index();
        items = [];

        // const checkboxs = document.querySelectorAll('[class="checkbox-item-source-datatable"]');

        // checkboxs.forEach(element => {
        //     element.target.checked = false;
        // });
        

        
        dt = $('#modalSupplier .datatable').DataTable({
            ajax: {
                url: base_url + 'getjson/getsourcing_items_supplier',
                method: 'POST',
                data: {
                    where: "type = 'supplier'",
                }
            },
            processing: true,
            serverSide: true,
            columns: [
                { data: 'company' },
                { data: 'items' },
                { data: 'qty' },
                { data: 'price' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 4,
                    orderable: false,
                    render: function (data, type, row) {
                        return `<label>
                                    <input type="checkbox" class="checkbox-item-source-datatable" data-json='${JSON.stringify(row)}' name="item_checks[]"  value="${data.id}">
                                </label>`;
                    }
                },
            ],
            drawCallback: function (settings) {
                var api = this.api();
         
                // Output the data for the visible rows to the browser's console
                console.log(api.rows({ page: 'current' }).data());
            }
        });

        table = dt.$;
      
        dt.on('draw', function (data, row) {
            console.log(row);
            handleSelectedRows();
        });
        

        function handleSelectedRows() {
            const buttons = document.querySelectorAll('[class="checkbox-item-source-datatable"]');
            
            buttons.forEach(element => {
                element.addEventListener('change', selectedSource);
            });
        }
    });
   

    $(document).on('click', '#btn-save-item-list-source', function(e){
       

        var trItem = $('table.table-item > tbody').children().eq(supplierIndex - 1);
        var tdItemProduct = trItem.children().eq(0);
        var tdItemQuantity = trItem.children().eq(1);
        var tdItemPrice = trItem.children().eq(2);


        tdItemProduct.html(`

            <input type="hidden" name="id_items[]" value="${items[0].product_id}" class="form-control product-id" id="id_items">
            <input type="name" name="items[]" value="${items[0].items}" class="form-control product-name" id="name" placeholder="Masukan nama item">
        
        `);

        var currentQuantity = tdItemQuantity.children().eq(0);
        currentQuantity = parseInt(currentQuantity.val());


        var qtySelected = 0;

        items.forEach(element => {
            qtySelected = qtySelected +parseInt(element.qty);
        });

        if(qtySelected > currentQuantity){
            currentQuantity = qtySelected;
        }
        tdItemQuantity.html(`<input type="number" name="qty[]" class="form-control product-quantity" id="qty" value="${currentQuantity}" min="1">`);

        


        var tr = $('table.table-item > tbody').children().eq(supplierIndex);

        var tdQuantity = tr.children().eq(1);
        var tdPrice = tr.children().eq(2);
        var tdSupplierName = tr.children().eq(3);

        var elementQuantity = '';
        var elementPrice = '';
        var elementSupplier = '';

        items.forEach(element => {
            elementQuantity += `<input type="number" name="qty_supplier[]" class="form-control m-b-1" id="qty" value="${element.qty}" min="1" readonly>`;
        });

        items.forEach(element => {
            elementPrice += `
                <input type="text" value="${element.price}" class="form-control m-b-1 price-display" placeholder="0" readonly>
                <input type="hidden" name="price_supplier[]" value="${element.price}" class="form-control m-b-1" id="price" placeholder="0" readonly>
            `;
        });

        items.forEach(element => {
            elementSupplier += `
                <div class="input-group m-b-1">

                    <input type="text" class="form-control" readonly value="${element.company}">
                    <input type="hidden" class="form-control" name="source_id[]" value="${element.id}">
                    <input type="hidden" class="form-control" name="source_item_id[]" value="${element.product_id}">
                    <span class="input-group-btn">
                        <button class="btn btn-danger btn-delete-source" type="button"><i
                                class="fa fa-fw fa-trash"></i></button>
                    </span>
                </div>
            `;
        });

        tdQuantity.html(elementQuantity);
        tdPrice.html(elementPrice);
        tdSupplierName.html(elementSupplier);

        var tr = $('table.table-item > tbody').append(`
            <tr>
                <td>
                    <input type="hidden" name="id_items[]" class="form-control product-id"
                        id="id_items">
                    <input type="name" name="items[]" class="form-control product-name" id="name"
                        placeholder="Masukan nama item">
                </td>
                <td><input type="number" name="qty[]" class="form-control product-quantity" id="qty"
                        value="1" min="1">
                </td>
                <td><input type="number" name="price[]" class="form-control price-quantity" id="price"
                        placeholder="0"></td>
                <td><button disabled class="btn btn-sm btn-danger"><i
                            class="fa fa-fw fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <!--<td class="text-right">
                    <a href="#" class="supplier-source" data-toggle="modal" data-target="#modalSupplier">Supplier</a>
                </td>
                <td></td>
                <td></td>
                <td></td>-->
            </tr>`
        );

    });
    

    $('.btn-show-list-contact').click(function (e) { 
        var table;
        var dt;

        

        console.log($('#myModal .datatable'));
        
        dt = $('#myModal .datatable').DataTable({
            ajax: {
                url: base_url + 'getjson/contact_table',
                method: 'POST'
            },
            processing: true,
            serverSide: true,
            columns: [
                { data: 'name' },
                { data: 'email' },
                { data: 'telephone' },
                { data: 'company' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 4,
                    orderable: false,
                    render: function (data, type, row) {
                        return `<button class="btn btn-select btnnew" data-dismiss="modal" aria-label="Close" data-json='${JSON.stringify(row)}'>Pilih</button>`;
                    }
                },
            ]
        });

        table = dt.$;

        dt.on('draw', function () {
            handleSelectedRows();
        });

        function handleSelectedRows() {
            const buttons = document.querySelectorAll('[class="btn btn-select btnnew"]');
            
            buttons.forEach(element => {
                element.addEventListener('click', rowClick)
            });
        }
    });
});

function split( val ) {
return val.split( /,\s*/ );
}
function extractLast( term ) {
return split( term ).pop();
}

function setAddressAutocomplete(element, url, render, onSelect){

    element.autocomplete({
        source: function(request, response){
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    keyword: request.term
                },
                dataType: "json",
                success: function (data) {
                    if(data.length > 0){
                        response(data);
                    }
                }
            });
        },
        minLength: 3,
        select: onSelect,
        
    }).autocomplete("instance")._renderItem = render;
}


function rowClick(e){
    e.preventDefault();
    
    const data = JSON.parse(e.target.dataset.json);

    $('input[name="contact_id"').val(data.id);
    $('input[name="company_id"').val(data.company_id);

    $('.contact-alert-space').html('');
    $('.company-alert-space').html('');

    $('.contact-alert-space').append(`
        <p class="f16 fbold m-a-0 m-t-1">Data Kontak</p>
        <div class="alert alert-info alert-info-contact alert-dismissible" role="alert">
            <button type="button" class="contact-close close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="font-weight-bold">${data.name}</span> -
            <span class="text-muted">${data.telephone}</span>
        </div>
    `);
    $('.company-alert-space').append(`
        <p class="f16 fbold m-a-0">Data Perusahaan</p>
        <div class="alert alert-info alert-info-contact alert-dismissible" role="alert">
            <button type="button" class="company-close close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="font-weight-bold">${data.company}</span> -
            <span class="text-muted">${data.company_phone}</span>
        </div>
    `);

    $('#myModal .datatable').DataTable().destroy();
}
function selectedSource(e){
    const data = JSON.parse(e.target.dataset.json);
    
    if (e.target.checked)
    {
        items.push(data);
    }else{
        
        items.forEach((element, index) => {
            if(element.id == data.id){
                items.splice(index, 1);
            }
        });
    }
}

function formatRupiah(input){
    input = input.replace(/[^,\d]/g, '').toString();
    var split = input.split(',');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // Menambahkan titik jika input sudah menjadi ribuan
    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}

/*
function toggleSupplierButton()
{   
    var buyer = document.getElementById("buyer");

    if(buyer.checked){
        
        $('.select-supplier').removeClass('d-none');
    }else{
        $('.select-supplier').addClass('d-none');
    }

}
*/