$(document).ready(function () {
    var table;
    var dt;
    
    dt = $('#contact-datatable').DataTable({
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
            { data: null },
        ],
        columnDefs: [
            {
                targets: 4,
                orderable: false,
                render: function (data, type, row) {
                   
                    if(data.member_id == null){
                        return `<div class="alert alert-warning" role="alert" style="padding: 0px; margin-bottom: 0px; text-align:center;">Belum Ada Akun</div>`;
                    }else{
                        return `<div class="alert alert-success" role="alert" style="padding: 0px; margin-bottom: 0px; text-align:center;">Sudah Ada Akun</div>`;
                    }
                }
            },
            {
                targets: 5,
                orderable: false,
                render: function (data, type, row) {
                    return `
                        <form action="${base_url + 'backendcontact/delete'}" method="GET">
                        <input type="hidden" name="id" value="${row.id}" />
                        <button type="submit" class="btn btn-select btn-danger btn-sm" data-dismiss="modal" aria-label="Close" data-id='${row.id}'><i class="fa fa-fw fa-trash"></i> Hapus</button>
                        </form>
                    `;
                }
            },
        ]
    });

    table = dt.$;

    dt.on('draw', function () {
        // handleSelectedRows();
    });

    // function handleSelectedRows() {
    //     const buttons = document.querySelectorAll('[class="btn btn-select btn-danger btn-sm"]');
        
    //     buttons.forEach(element => {
    //         element.addEventListener('click', rowClick)
    //     });
    // }
});

function rowClick(e){
    e.preventDefault();
    
    const data = e.target.dataset.id;

    console.log(data);

    // $('# .datatable').DataTable().destroy();
}