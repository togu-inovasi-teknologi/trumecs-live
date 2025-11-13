var base_url = $("body").attr("baseurl");

$(document).ready(function () {
  $("#datatables").DataTable();
  $("#datatables").DataTable().order([0, "desc"]).draw();

  url = base_url + "backendagent/get_new";

  var notif = function () {
    last_id = $(".list-prospek").data("lastid");
    $.post(url, { last_id: last_id }, function (data) {
      data = jQuery.parseJSON(data);
      if (data.number > 0) {
        test = [];
        $.each(data.list, function (index, item) {
          tests = {
            0: item[0],
            1: item[1],
            2: item[2],
            3: item[3],
            4: item[4],
            5: item[5],
            6: item[6],
          };
          test.push(tests);
        });
        $(".list-prospek").data({ lastid: data.last });
        $("#datatables")
          .DataTable()
          .rows.add(test)
          .draw()
          .nodes()
          .to$()
          .addClass("f12 fbold")
          .css({ background: "#ccc" });
        $("#datatables")
          .DataTable()
          .cells(":contains('Belum Dihubungi')")
          .nodes()
          .to$()
          .addClass("btn-danger text-center");
        $("#datatables")
          .DataTable()
          .cells(":contains('Belum Diperiksa')")
          .nodes()
          .to$()
          .addClass("btn-danger text-center");
        $("#datatables")
          .DataTable()
          .column(1)
          .nodes()
          .to$()
          .addClass("btn-black")
          .css({ "border-radius": "0" });
        $("#datatables")
          .DataTable()
          .column(0)
          .nodes()
          .to$()
          .addClass("text-center");
        $("#datatables")
          .DataTable()
          .column(3)
          .nodes()
          .to$()
          .addClass("text-center");
        $("#datatables")
          .DataTable()
          .column(4)
          .nodes()
          .to$()
          .addClass("text-center");
      }
    });

    setTimeout(notif, 10000);
  };

  setTimeout(notif, 10000);
});
