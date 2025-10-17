var storeDomain = window.location.pathname.split('/')[1];
var categoryid = 0;
var short = {new: 'DESC'}
var perPage = 0;
var currentPage = 1;
var totalPage = 1;

$(document).ready(function () {
    getProducts().then((data) => {
        show(data.products);
    });


   $('.category-tab').click(function (e) { 
        e.preventDefault();
        $('.category-tab').removeClass('active');
        $(this).addClass('active');

        categoryid = $(this).data('id');

        currentPage = 1;

        getProducts().then((data) => {
            show(data.products);
        });
   });


   $('#order').change(function (e) { 
        e.preventDefault();
        if($(this).val() == 'new'){
            short = {new: 'DESC'};
        }else if($(this).val() == 'price asc'){
            short = {price: 'ASC'};
        }else if($(this).val() == 'price desc'){
            short = {price: 'DESC'};
        }

        getProducts().then((data) => {
            show(data.products);
        });
   });

   $(document).on('click', '#paginate-previous', function (e){
        e.preventDefault();

        currentPage = parseInt(currentPage) - 1;

        getProducts().then((data) => {
            show(data.products);
        });

   });
   $(document).on('click', '#paginate-next', function (e){
        e.preventDefault();

        currentPage = parseInt(currentPage) + 1;

        getProducts().then((data) => {
            show(data.products);
        });
   });

});

async function getProducts()  {
    console.log(currentPage);
    var data = await $.ajax({
        type: "GET",
        url: baseurl + '/' + storeDomain + '/getProducts',
        data: {
            category_id: categoryid,
            page: currentPage,
            ...short
        },
        dataType: "json",
        success: function (response) {
            totalProduct = response.total;
            totalPage = response.totalPage;
            perPage = response.perPage;
            return response;
        }
    });

    return data;
}

function show(products = []) {
    $('#product-store').html('');
    $('#paginate').html('');
    $.each(products, function (i, value) { 
         $('#product-store').append(productCard(value));
    });

    var paginate = `<div class="col-sm-12 d-flex justify-content-end">
                            <nav aria-label="...">
                                <ul class="pager">`;

    if(currentPage > 1){
        
        paginate += `<li class="previous"><a href="#" id="paginate-previous"><span aria-hidden="true">&larr;</span> Previous</a>
        </li>`;
        

    }
    if(currentPage < totalPage){
        paginate += `<li class="next"><a href="#" id="paginate-next">Next <span aria-hidden="true">&rarr;</span></a></li>`;
    }

    paginate += `</ul>
                </nav>
            </div>`;

    if(totalPage > 1){
        $('#paginate').html(paginate);
    }        
}

function productCard(product) {
    var url = baseurl + 'product/' + product.id + '/' + product.tittle.toLowerCase().replace(/[^a-zA-Z0-9]/g, "-");
    console.log(url);
    var timthumb = baseurl + 'timthumb?src=' + baseurl + 'public/image/product/' + '../noimage.png';
    var lfp = product.img.length;
    var ext = product.img.substr(0, lfp - 4);
    // is_file("public/image/product/" . product.img) != 1 ? product.img = "../noimage.png" : product.img;
    var percent = 90;
    var pricepromo = 0;
    if (product.price_promo != 0 && product.price_promo != null) {
        product.price = (product.price != 0) ? product.price : product.price_promo;
        var got = product.price_promo;
        var total = product.price;
        percent = (got / total) * 100;
        pricepromo = product.price;
    } else {
        if(product.price != null){
            pricepromo = (product.price * 100) / percent;
        }
    }

    console.log(pricepromo);
   
    return `
    
    <div class="col-lg-3">
    
    <div class="card card-shadow" style="border-radius: 0;">
    <a class="random-product" itemprop="url"
        href="${url}"
        style=" text-decoration:none;">
        
                <img src="${timthumb}"
                    alt="${product.tittle}"
                    style="width: 100%; max-height:170px; margin-bottom:16px;">
                <div class="p-x-1" style="height: 90px;">
                    <h4 itemprop="name" class="f13 fblack">
                    ${product.tittle}
                    </h4>${pricepromo == 0 ? '' : `<h4 class="f14 fbold fred">
                    ${Math.ceil(100 - percent)}<small>%</small>
                    <span class="f11"
                        style="color:#999"><small><strike>${pricepromo.toLocaleString('en-US')}</strike></small></span>
                </h4>`}
                    <h4 class="f13 fbold fblack">
                        <span itemprop="priceCurrency" content="IDR">Rp</span> <span
                            itemprop="price">${ product.price_promo == 0 || product.price_promo == null ? product.price.toLocaleString('en-US') : product.price_promo.toLocaleString('en-US') }</span>
                    </h4>
                </div>
                <span id="btnbuy${product.id}" class="btn btnnew btn-block btn-hide"><i
                        class="fa fa-shopping-cart"></i>
                    Beli</span>
            </a>
        </div>
    
    </div>
    
    `
}