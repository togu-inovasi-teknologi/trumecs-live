$(document).ready(function () {
  var store = $('input[name="store"]').val();

  $("#tablelist-product").DataTable({
    ajax: {
      url: base_url + "/member/store/getProductStore",
      type: "POST",
      data: {
        store_id: store,
      },
    },
    columnDefs: [
      { className: "va-middle", targets: [0, 1, 2, 3, 4, 5, 6] },
      { className: "text-right", targets: [2] },
      { className: "text-center", targets: [0, 3, 4, 5, 6] },
    ],
    // searching: false,
    // lengthChange: false,
    processing: true,
    serverSide: true,
  });
  $("#tablelist-product-mobile").DataTable({
    ajax: {
      url: base_url + "/member/store/getProductStore",
      type: "POST",
      data: {
        store_id: store,
      },
    },
    lengthChange: false,
    drawCallback: function (settings) {
      $("#tablelist-product-mobile thead").remove();
    },
    processing: true,
    serverSide: true,
    createdRow: function (row, data, dataIndex) {
      var html = `
      <div class="d-flex flex-row align-items-center" style="padding: 5px">
        ${data[0]}
        <div class="d-flex flex-column gap-0 align-items-start w-100">
          <div class="d-flex-sb align-items-center w-100">
            <p class="fbold m-a-0">${data[1]}</p>
            <div class="d-flex gap-1 align-items-center vertical-align-middle">
              <button class="btn btn-edit-product" data-toggle="modal" data-target="#edit-product-${data[5]}"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-delete-product" data-toggle="modal" data-target="#delete-product-${data[5]}"><i class="bi bi-trash"></i></button>
            </div>
          </div>
          <p class="fbold forange m-a-0">${data[3]}</p>
          <p class="m-a-0">${data[4]}</p>
          ${data[2]}
        </div>
      </div>`;
      $(row).html(html);
    },
  });
});
