<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('decoration')){
    function decoration($storeModel){
        switch ($storeModel->template) {
            case 1:
                return storeDescription($storeModel->description_id) . decoration_banner($storeModel->banners());
            default:
                return decoration_banner_carousel($storeModel->banners()) . storeDescription($storeModel->description_id);
              
        }
    }
}

if(!function_exists('decoration_description')){
    function storeDescription($description = '')  {
        return '<div class="row">
                    <div class="col-lg-12">
                        '. $description .'
                    </div>
                </div>';
    }
}

if(!function_exists('decoration_banner')){
    function decoration_banner($banners = []){
        $banner = '<div class="row d-flex flex-column gap-3 m-t-3">';

        foreach ($banners as $key => $value) {
            $banner .= '<div class="col-lg-12">';
            $banner .= '<div class="banner-decoration" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url( ' .  base_url('public/image/store/cover/'. $value->source  ) . ' );background-size:cover;">';
            $banner .= '</div>';
            $banner .= '</div>';
        }
        $banner .= '</div>';

        return $banner;
    }
}

if(!function_exists('decoration_banner_carousel')){
    function decoration_banner_carousel($banners = []){
        // $banner = '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">';

        // $banner .= '<ol class="carousel-indicators">';
        // $banner .= '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
        // $banner .= '<li data-target="#carousel-example-generic" data-slide-to="1"></li>';
        // $banner .= '<li data-target="#carousel-example-generic" data-slide-to="2"></li>';
        // $banner .= '</ol>';


        // $banner .= '<div class="carousel-inner" role="listbox">';
        // foreach ($banners as $key => $value) {
        //     if($key == 0){
        //         $banner .= '<div class="item active">';
        //     }else{
        //         $banner .= '<div class="item">';
        //     }
        //     $banner .='<img src="'. base_url('public/image/store/cover/'. $value->source) .'" alt="...">';
        //     $banner .= '<div class="carousel-caption">';
        //     $banner .= '</div>';
        //     $banner .= '</div>';
        // }
        

        // $banner .= '<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">';
        // $banner .= '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
        // $banner .= '<span class="sr-only">Previous</span>';
        // $banner .= '</a>';
        // $banner .= '<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">';
        // $banner .= '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
        // $banner .= '<span class="sr-only">Next</span>';
        // $banner .= '</a>';
        // $banner .= '</div>';

        // return $banner;

        return '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
      
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="'. base_url('public/image/store/cover/banner-1.jpg') .'" alt="...">
            <div class="carousel-caption">
              ...
            </div>
          </div>
          <div class="item">
            <img src="'. base_url('public/image/store/cover/banner-2.jpeg') .'" alt="...">
            <div class="carousel-caption">
              ...
            </div>
          </div>
          ...
        </div>
      
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>';
    }
}