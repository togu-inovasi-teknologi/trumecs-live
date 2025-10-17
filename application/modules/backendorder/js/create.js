$(document).ready(function () {
    
    $('.button-show-sorcing-supplier-order').click(function (e) { 
        
        var table;
        var dt;
        
        dt = $('#supplier .table-sourcing-list').DataTable({
            ajax: {
                url: base_url + 'getjson/getsourcinglist',
                method: 'POST',
                data: (d) => {
                    d.type = "supplier";
                },
            },
            
            processing: true,
            serverSide: true,
            columns: [
                { data: 'name' },
                { data: 'company' },
                { data: 'date' },
                { data: null},
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
                {
                    targets: 3,
                    orderable: false,
                    render: function (data, type, row) {
                        return `${row.village_name ?? ''} - ${row.district_name ?? ''} - ${row.district_name ?? ''} - ${row.province_name ?? ''}`;
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

    $('input[type="file"]').change(function (e) { 
        e.preventDefault();
        var file = this.files[0];
        if (file) {
           const tr = $(this).parent().parent().children();
           tr.eq(0).html(`${file.name}`);

        } else {
            console.log('Please select a file');
        }
        
    });

    sumTotal();

    $('input[name="shipping_cost"]').keyup(function (e) { 
        sumTotal();
    });
    // <?= $sourcing->inc_ongkir > 0 ? 'readonly' : '' ?>

    $('input[name="referal_persentase"],input[name="cashback_persentase"],input[name="marketing_persentase"]').keyup(function (e) { 
        e.preventDefault();
       
        validateNumberInput(e);
    });
});

function validateNumberInput(event) {
    const input = event.target;
    if (!/^[0-9\b]+$/.test(input.value)) {
        input.value = input.value.replace(/[^\d]/g, '');
    }
}

const rupiah = (number)=>{
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0, // Minimum desimal 0
        maximumFractionDigits: 2, // Maksimum desimal 2
    });
    return formatter.format(number);
  }

function sumTotal()
{
    const shipping_cost = parseInt($('input[name="shipping_cost"]').val() == "" ? 0 : $('input[name="shipping_cost"]').val());
    const subtotal = parseInt($('input[name="subtotal"]').val());

    const total = shipping_cost + subtotal;


    $('input[name="total"]').val(total);
    $("td#total-price-field").html(`<strong>${rupiah(total)}</strong>`);

}

function keepSupplierData()
{
    var supplierId = $('input[name="sourcing_supplier]').val();
    if(supplierId)
    {
        $.ajax({
            type: "POST",
            url: base_url + 'getjson/sourcing_detail',
            data: {
                id: supplierId,
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
            }
        });
    }
}

function tableRow()
{
    return `
    
    <tr>
        <td></td>
        <td width="300px">
            <label class="radio-inline">
                <input type="radio" name="types" id="inlineRadio1" value="supplier" checked>
                Supplier
            </label>
            <label class="radio-inline">
                <input type="radio" name="types" id="inlineRadio2" value="buyer">
                Customer
            </label>
        </td>
        <td width="300px">
            <select class="form-control" name="file_types">
                <option>PO</option>
                <option>Invoice</option>
                <option>Bukti Pembayaran</option>
                <option>Bukti Pengiriman</option>
                <option>Bukti Penerimaan</option>
            </select>
        </td>
        <td width="300px">
            <input id="btn-upload" type="file" name="documents" style="display: none">
            <label for="btn-upload" class="btn btn-sm btn-primary m-a-0"> <i
                    class="fa fa-fw fa-folder-open"></i>
                Upload</label>
            <button type="button" class="btn btn-sm btn-danger"> <i class="fa fa-fw fa-trash"></i>
                Hapus</button>
        </td>
    </tr>
    
    `;
}

// function grossprofite(dataBuying, dataSelling){
        
//     $dppPlusPPn = $buying->total_price + $buying->calculateppn();
//     $dppPlusPPnSelling = $selling->price + $selling->calculateppn();
//     $grossProfite = $dppPlusPPnSelling - $dppPlusPPn;

//     return $grossProfite;
// }

// function calculateppn(){
//     $ppnSatuan = $this->price * ppn_value();
//     $ppnTotal = $ppnSatuan * $this->quantity;
//     return $ppnTotal;
// }

function rowClick(e){
    e.preventDefault();
    
    const data = JSON.parse(e.target.dataset.json);
    console.log(data)
    const view = `
    
    <div class="col-lg-4 ">
        <div class="" style="height: 200px">
            <table>
                <tr>
                    <th width="200px" class="f16 forange">Detail Kontak</th>
                </tr>
                <tr>
                    <th width="200px" class="f16">Nama</th>
                    <td class="f16">: ${data.contact_name}</td>
                </tr>
                <tr>
                    <th width="200px" class="f16">Email</th>
                    <td class="f16">: ${data.contact_email}</td>
                </tr>
                <tr>
                    <th width="200px" class="f16">Telepon</th>
                    <td class="f16">: ${data.contact_phone}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="" style="height: 200px">
            <table>
                <tr>
                    <th width="200px" class="f16 forange">Perusahaan</th>
                </tr>
                <tr>
                    <th width="200px" class="f16">Nama</th>
                    <td class="f16">: ${data.company}</td>
                </tr>
                <tr>
                    <th width="200px" class="f16">Email</th>
                    <td class="f16">: ${data.company_email}</td>
                </tr>
                <tr>
                    <th width="200px" class="f16">Telepon</th>
                    <td class="f16">: ${data.company_phone}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="" style="height: 200px">
            <p class="f16 fbold forange">Alamat</p>
            <p>${ data.company_village + ', ' + data.company_district +', ' + data.company_regency + ', ' +data.company_province }
            </p>

        </div>
    </div>
    
    `

    for (let index = 0; index < data.items.length; index++) {
        const element = data.items[index];
        const ppnSatuan = element.price * 0.11;
        const ppnTotal = ppnSatuan * element.qty;
        
        console.log($('#table-memo > tbody').children());

        $('#table-memo > tbody').children().eq(index + 1).children().eq(2).html(rupiah(element.price));
        
        $('#table-memo > tbody').children().eq(index + 1).children().eq(4).html(rupiah(ppnTotal));

    }

    

    
    $('.supplier-info-content').html(view);

    $('input[name="sourcing_supplier"]').val(data.id);

    $('#supplier > .table-sourcing-list').DataTable().destroy();
}

function change_province(el, val, type, id_regency = null) {
    
    parent = el.parent();
    
    id_province = val;
    url = base_url + "product/prospek/get_regencies";
    $.post(url,{class:el.data("type"), id_province:id_province}, function(data){
        select = '';
        data = jQuery.parseJSON(data);
        $.each(data, function(index, item){
            select += "<option value='"+item.id+"'>"+item.name+"</option>"
        })

        if(type == 'double'){
            $('select[name="regency"]').each(function(index, item) {
                $(item).html(select);
                $(item).val(id_regency);
                $(item).css({'textTransform':'capitalize'});
            });
        } else {
            parent.children("."+el.data("type")+"-regency").html(select);
            parent.children("."+el.data("type")+"-regency").css({'textTransform':'capitalize'});
        }

        
        
    });
}

function change_regency(el, val, type, id_district = null) {
    parent = el.parent();
    id_regency = val;
    
    url = base_url + "product/prospek/get_districts";
    $.post(url,{id_regency:id_regency}, function(data){
        select = '';
        data = jQuery.parseJSON(data);
        $.each(data, function(index, item){
            select += "<option value='"+item.id+"'>"+item.name+"</option>"
        })
        if(type == 'double'){
            $('select[name="district"]').each(function(index, item) {
                $(item).html(select);
                $(item).val(id_district);
            });
        }else{
            parent.find("select[name='district']").html(select);
        }
    });
}

function change_district(el, val, type, id_village = null) {
    parent = el.parent();
    id_district = val;
    url = base_url + "product/prospek/get_villages";
    $.post(url,{id_district:id_district}, function(data){
        select = '';
        data = jQuery.parseJSON(data);
        $.each(data, function(index, item){
            select += "<option value='"+item.id+"'>"+item.name+"</option>"
        })
        
        if(type == 'double'){
            $('select[name="village"]').each(function(index, item) {
                $(item).html(select);
                $(item).val(id_village);
            });
        }else{
            parent.find("select[name='village']").html(select);
        }
    });
}