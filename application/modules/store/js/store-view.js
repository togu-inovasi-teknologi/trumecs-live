$(document).ready(function () {
  $(".catalog").each(function (index, element) {
    var categoryId = $(element).children("input[name='category_id']").val();

    // Initialize the DataTable with the corresponding id
    $("#datatable-product-" + categoryId).DataTable({
      responsive: true,
      columnDefs: [
        {
          targets: [1, 2, 3],
          className: "dt-head-center",
        },
      ],
      // ajax: {
      //   url: base_url + "/store/getProducts",
      //   type: "POST",
      //   data: { categoryId: categoryId },
      // },
      // processing: true,
      // // serverSide: true,
      // // Add other DataTable options as needed
    });
  });
  $(".catalog").each(function (index, element) {
    var categoryId = $(element).children("input[name='category_id']").val();

    // Initialize the DataTable with the corresponding id
    $("#datatable-product-mobile-" + categoryId).DataTable({
      responsive: true,
      columnDefs: [
        {
          targets: [1],
          className: "dt-head-center",
        },
      ],
      // ajax: {
      //   url: base_url + "/store/getProducts",
      //   type: "POST",
      //   data: { categoryId: categoryId },
      // },
      // processing: true,
      // serverSide: true,
      // // Add other DataTable options as needed
    });
  });
  $("#slick-mobile").slick({
    arrows: true,
    autoplay: true,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 1,
    speed: 200,
    dots: true,
    infinite: true,
    cssEase: "linear",
    prevArrow: ".prev",
    nextArrow: ".next",
  });

  $(document).ready(function () {
    $(".read-more-btn").click(function () {
      const fullContext = $(this).parent().find(".full-description");
      const lessContext = $(this).parent().find(".less-description");

      if (fullContext.css("display") === "none") {
        fullContext.css("display", "block");
        lessContext.css("display", "none");
        $(this).text("Lihat lebih sedikit");
      } else {
        fullContext.css("display", "none");
        lessContext.css("display", "block");
        $(this).text("Lihat selengkapnya");
      }
    });
    $("#sph-bazaar").click(function () {
      $("#form-bazaar").trigger("reset");
      $("#modal-bazaar").modal("show");
    });
  });

  // $(".catalog").each(function (i, val) {
  //   var category_id = $(this).children("input[name='category_id']").val();

  //   datatableInit($(this).children(".datatable"), "", category_id);
  // });

  // $(".search-datatable").keyup(function (e) {
  //   e.preventDefault();

  //   var category_id = $(this).data("search_id");

  //   var id = `#id_datatable_${category_id}`;

  //   var element = $(id);

  //   datatableDestroy(element);

  //   datatableInit(element, $(this).val(), category_id);
  // });

  // function datatableInit(element, search, categoryId) {
  //   var url = $(location).attr("href");
  //   var segments = url.split("/");
  //   var nameStore = segments[3];

  //   var dataToRequest = {
  //     where: {
  //       component: categoryId,
  //     },
  //   };

  //   if (search != "") {
  //     dataToRequest.search = {
  //       value: search,
  //     };
  //   }

  //   var table = element.DataTable({
  //     ajax: {
  //       url: base_url + nameStore + "/getProducts",
  //       type: "POST",
  //       data: dataToRequest,
  //     },
  //     columnDefs: [
  //       // {
  //       //   targets: 0,
  //       //   visible: false,
  //       // },
  //       {
  //         targets: 3,
  //         className: "text-center",
  //       },
  //       // {
  //       //   targets: 4,
  //       //   className: "text-right",
  //       // },
  //       // {
  //       //   targets: 5,
  //       //   className: "text-center",
  //       // },
  //       // {
  //       //   targets: [3, 4, 5],
  //       //   className: "dt-head-center",
  //       // },
  //     ],
  //     orderClasses: false,
  //     searching: false,
  //     lengthChange: true,
  //     processing: true,
  //     serverSide: true,
  //   });
  //   console.log(table);
  //   table.on("click", "tbody tr", function () {
  //     // console.log(table.row(this));
  //     // let data = table.row(this).data();
  //     // var id = data[0];
  //     // str = data[1].replace(/\s+/g, '-').toLowerCase();
  //     // redirect = base_url + 'product/' + id + '/' + str;
  //     // window.location.href = redirect;
  //   });
  // }

  // function datatableDestroy(element) {
  //   // console.log(element.DataTable());
  //   element.empty();
  //   element.DataTable().destroy();
  // }
  // $("#slick >  *.slick-slide").hide();
});
