$("#tableHistory").DataTable({
  ordering: false,
  paging: true,
  searching: true,
  info: false,
  autowidth: true,
  columnDefs: [
    {
      targets: [2, 3, 4, 5, 6],
      className: "dt-head-center",
    },
  ],
  // ajax: "bulkJson",
  // columns: [
  //   { data: "no" },
  //   { data: "nama_rfq_modal" },
  //   { data: "jumlah_items" },
  //   { data: "items_qty" },
  //   { data: "total_harga" },
  // ],
});
$("#tableHistoryMobile").DataTable({
  ajax: {
    url: base_url + "/member/getBulk",
    type: "POST",
  },
  lengthChange: false,
  drawCallback: function (settings) {
    $("#tableHistoryMobile thead").remove();
  },
  processing: true,
  serverSide: true,
  createdRow: function (row, data, dataIndex) {
    var html = `
      <div class="d-flex flex-column gap-1" style="padding: 5px">
        <div class="d-flex-sb align-items-center">
          ${data[0]}
          ${data[1]}
        </div>
        <div class="d-flex-sb align-items-center">
          <p class="text-muted f12">Jumlah Item :</p>
          <p class="fbold">${data[4]}</p>
        </div>
        <div class="d-flex-sb align-items-center">
          <p class="text-muted f12">Jumlah Qty :</p>
          <p class="fbold">${data[5]}</p>
        </div>
        <div class="d-flex-sb align-items-center">
          <p class="text-muted f12">Total Harga :</p>
          <p class="fbold">${data[3]}</p>
        </div>
        ${data[2]}
      </div>`;
    $(row).html(html);
  },
});
