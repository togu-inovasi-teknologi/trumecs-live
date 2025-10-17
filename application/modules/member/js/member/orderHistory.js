var baseurl = $("body").attr("baseurl");

$("#tableHistoryOrder").DataTable({
  ajax: {
    url: base_url + "member/getSourcingComplete",
    type: "POST",
  },
  ordering: false,
  paging: true,
  searching: true,
  info: true,
  autowidth: false,
  processing: true,
  serverSide: true,
});

$("#tableHistoryOrderMobile").DataTable({
  ajax: {
    url: base_url + "member/getSourcingComplete",
    type: "POST",
  },
  drawCallback: function (settings) {
    $("#tableHistoryOrderMobile thead").remove();
  },
  lengthChange: false,
  processing: true,
  serverSide: true,
  createdRow: function (row, data, dataIndex) {
    var html = `<div class="d-flex flex-column" style="padding: 5px">
                    <div class="d-flex-sb align-items-center">
                        <p class="fbold">ID Order : ${data[0]}</p>
                        ${data[2]}
                    </div>
                </div>
                <div class="d-flex flex-column align-items-start" style="padding: 5px">
                <span class="text-muted f12">${data[3]}</span>
                </div>`;
    $(row).html(html);
  },
});
