$(document).ready(function () {
  $("#tableSaldoHistory").DataTable({
    ajax: {
      url: base_url + "member/getSaldoHistory",
      type: "POST",
    },
    columnDefs: [
      {
        targets: [0, 2, 3, 4, 5],
        className: "dt-head-center",
      },
      {
        targets: [4],
        className: "text-right",
      },
      {
        targets: [0, 3, 5],
        className: "text-center",
      },
      {
        targets: [0, 1, 2, 3, 4, 5],
        className: "va-middle",
      },
      {
        targets: [1],
        className: "fbold",
      },
    ],
    ordering: false,
    paging: true,
    searching: true,
    info: true,
    autowidth: false,
    processing: true,
    serverSide: true,
  });
  $("#tableSaldoHistoryMobile").DataTable({
    ajax: {
      url: base_url + "member/getSaldoHistory",
      type: "POST",
    },
    drawCallback: function (settings) {
      $("#tableSaldoHistoryMobile thead").remove();
    },
    lengthChange: false,
    processing: true,
    serverSide: true,
    createdRow: function (row, data, dataIndex) {
      $(row).css("outline", "1px solid #eee");
      if (data["type"] == "Kredit") {
        var html = `<div class="d-flex flex-column gap-2" style="padding: 5px">
                    <div class="d-flex-sb align-items-start">
                        <div class="d-flex flex-column">
                          <div class="d-flex gap-1 align-items-center">
                            <p class="fbold f18">${data["type"]}</p>
                            <p class="fbold">${data["status"]}</p>
                          </div>
                          <p class="text-muted f10">${data["date"]}</p>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                        ${data["category"]}
                        ${data["total"]}
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-0">
                      <p class="fbold">Deskripsi</p>
                      <p class="f12">${data["name"]}</p>
                      <p class="f12">${data["bank"]}</p>
                      <p class="f12">${data["amount_wd"]}</p>
                      <p class="f12">${data["transferFee"]}</p>
                      <p class="f12">${data["totalAll"]}</p>
                    </div>
                    ${data["button"]}
                </div>`;
      } else {
        var html = `<div class="d-flex flex-column gap-2" style="padding: 5px">
                    <div class="d-flex-sb align-items-start">
                        <div class="d-flex flex-column">
                          <div class="d-flex gap-1 align-items-center">
                            <p class="fbold">${data["type"]}</p>
                            <p class="fbold">${data["status"]}</p>
                          </div>
                          <p class="text-muted f10">${data["date"]}</p>
                        </div>
                        ${data["total"]}
                    </div>
                    <div class="d-flex flex-column gap-0">
                      <p class="fbold">Deskripsi</p>
                      <p class="f12">${data["name"]}</p>
                      <p class="f12">${data["bank"]}</p>
                    </div>
                    ${data["button"]}
                </div>`;
      }
      $(row).html(html);
    },
  });
});
