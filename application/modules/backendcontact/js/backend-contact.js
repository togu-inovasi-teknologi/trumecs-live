



$(document).ready(function () {

    $('.btn-search-company').click(function (e) { 
        var table;
        var dt;

        
        dt = $('#myModal .datatable').DataTable({
            ajax: {
                url: base_url + 'getjson/companies_table',
                method: 'POST'
            },
            processing: true,
            serverSide: true,
            columns: [
                { data: 'name' },
                { data: 'email' },
                { data: 'industry' },
                { data: 'ownership' },
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


    $('.btn-search-member').click(function (e) { 
        var table;
        var dt;

        dt = $('#user-modal .datatable').DataTable({
            ajax: {
                url: base_url + 'getjson/member_table',
                method: 'POST'
            },
            processing: true,
            serverSide: true,
            columns: [
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 3,
                    orderable: false,
                    render: function (data, type, row) {
                        return `<button class="btn btn-select btnnew selected-user" data-dismiss="modal" aria-label="Close" data-json='${JSON.stringify(row)}'>Pilih</button>`;
                    }
                },
            ]
        });

        table = dt.$;

        dt.on('draw', function () {
            handleSelectedRows();
        });

        function handleSelectedRows() {
            const buttons = document.querySelectorAll('[class="btn btn-select btnnew selected-user"]');
            
            buttons.forEach(element => {
                element.addEventListener('click', memberSelected)
            });
        }
    });

   

    

    setAddressAutocomplete($('input[name="billing_village"'), base_url + 'getjson/villages',function (ul, item) {
        
        label = item.label;
        return $( "<div class='border-sm bg-white f12'>" )
            .append( "<div>" + label + "</div>" )
            .appendTo( ul );

    }, function (event, ui) {
        $('input[name="billing_village_id"').val(ui.item.value);


        var split = ui.item.label.split(">");

        $('input[name="billing_village"').val(split[0]);
     
        $('.billing_show').remove();

       
        $(this).parent().append(`
                <span class="text-muted m-t-1 billing_show">Alamat : ${capitalizeFirst(ui.item.label)}</span>
            `);
        return false;
    });
    setAddressAutocomplete($('input[name="shipping_village"'), base_url + 'getjson/villages',function (ul, item) {
        
        label = item.label;
        return $( "<div class='border-sm bg-white f12'>" )
            .append( "<div>" + label + "</div>" )
            .appendTo( ul );

    }, function (event, ui) {
        $('input[name="shipping_village_id"').val(ui.item.value);


        var split = ui.item.label.split(">");

        $('input[name="shipping_village"').val(split[0]);
     
        $('.shipping_show').remove();
        $(this).parent().append(`
            <span class="text-muted m-t-1 shipping_show">Alamat : ${capitalizeFirst(ui.item.label)}</span>
        `)

        return false;
    });
    setAddressAutocomplete($('input[name="village_contact"'), base_url + 'getjson/villages',function (ul, item) {
        
        label = item.label;
        return $( "<div class='border-sm bg-white f12'>" )
            .append( "<div>" + label + "</div>" )
            .appendTo( ul );

    }, function (event, ui) {
        $('input[name="village_contact_id"').val(ui.item.value);


        var split = ui.item.label.split(">");

        $('input[name="village_contact"').val(split[0]);
     
        $('.contact_address_show').remove();
        $(this).parent().append(`
            <span class="text-muted m-t-1 contact_address_show">Alamat : ${capitalizeFirst(ui.item.label)}</span>
        `)

        return false;
    });
});



function memberSelected(e){
    e.preventDefault();
    
    const data = JSON.parse(e.target.dataset.json);
    console.log(data);
    const form = {
        id: document.querySelector('input[name="member_id"]'),
        name: document.querySelector('input[name="contact_name"]'),
        phone: document.querySelector('input[name="contact_phone"]'),
        email: document.querySelector('input[name="contact_email"]'),
        village_id: document.querySelector('input[name="village_contact_id"]'),
        village_name: document.querySelector('input[name="village_contact"]'),
        kodepos: document.querySelector('input[name="contact_code"]'),
        address: document.querySelector('textarea[name="address"]'),
    }

    for (const [key, value] of Object.entries(form)) {
        if(key !== 'type'){
            value.value = data[key] != null ? data[key] : null;
        }
    }

    $('#user-modal > .datatable').DataTable().destroy();
}
function rowClick(e){
    e.preventDefault();
    
    const company = JSON.parse(e.target.dataset.json);
    const form = {
        type: document.querySelectorAll('input[name="type"]'),
        name: document.querySelector('input[name="company_name"]'),
        id: document.querySelector('input[name="company_id"]'),
        telephone: document.querySelector('input[name="phone"]'),
        email: document.querySelector('input[name="email"]'),
        npwp: document.querySelector('input[name="npwp"]'),
        website: document.querySelector('input[name="website"]'),
        industry: document.querySelector('input[name="industry"]'),
        billing_country: document.querySelector('input[name="billing_country"]'),
        billing_village: document.querySelector('input[name="billing_village"]'),
        billing_village_id: document.querySelector('input[name="billing_village_id"]'),
        billing_code: document.querySelector('input[name="billing_code"]'),
        shipping_country: document.querySelector('input[name="shipping_country"]'),
        shipping_village: document.querySelector('input[name="shipping_village"]'),
        shipping_village_id: document.querySelector('input[name="shipping_village_id"]'),
        shipping_code: document.querySelector('input[name="shipping_code"]'),
    }

    form.type.forEach(element => {
        element.removeAttribute('checked');
        if(element.attributes.id.nodeValue == company.ownership){
            element.setAttribute('checked', true);
        }
    });

    for (const [key, value] of Object.entries(form)) {
        if(key !== 'type'){
            value.value = company[key] == undefined || company[key] == null ? null : company[key];
        }
    }

    $('#myModal > .datatable').DataTable().destroy();
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