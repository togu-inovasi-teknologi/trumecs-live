<?php $this->load->model("general/General_model", 'M_general'); ?>
<?php $kategori = $this->M_general->getcategori("0"); ?>
<div id="menu_area" class="menu-area pull-left p-y-0" style="min-width:120px;">
    <nav class="navbar navbar-light navbar-expand-lg mainmenu" style="padding:0px;border-top-left-radius: 5px;
        border-top-right-radius: 5px;">
        <ul class="navbar-nav mr-auto">
            <li class="dropdown">
                <a class="dropdown-toggle b-t-10" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff"><span class="fa fa-bars" style="vertical-align:middle;margin-right:10px;"></span> <?php echo $this->lang->line('kategori', FALSE); ?> </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <div class="mega-menu">
                            <ul>
                                <?php foreach ($kategori as $item) : ?>
                                    <li class="menu-item menu-1">
                                        <a href="<?php echo base_url(); ?>c/<?php echo $item['url'] ?>"><?php echo $item['name'] ?> <i class="fa fa-angle-right pull-right"></i></a>
                                        <div class="mega-submenu">
                                            <h2 style="position: sticky;position: -webkit-sticky;top:0;z-index: 2;background-color:#fff"><?php echo $item['name'] ?></h2>
                                            <div class="submenu-content">
                                                <div class="section">
                                                    <ul>
                                                        <?php $kategoris = $this->M_general->getcategori($item['id']); ?>
                                                        <?php foreach ($kategoris as $items) : ?>
                                                            <li style="background:#fff"><a alt="Jual Komponen <?php echo $items['name'] ?>" href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] ?>" class="list-kategori-atas"><?php echo $items['name'] ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
<style>
    .mega-menu {
        float: left;
        position: relative;
        display: block;
        width: 100%;
    }

    .mega-menu>ul {
        position: relative;
        background-color: #fff;
        display: block;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mega-menu>ul>li {
        width: 100%;
        height: 55px;
        list-style: none;
        border-bottom: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
    }

    .mega-menu>ul>li:hover {
        background-color: #ff9900;
    }

    .mega-menu>ul>li>a {
        padding: 17px;
        color: #333;
        text-decoration: none;
        width: 100%;
        display: block;
        overflow: hidden;
        position: relative;
    }

    .mega-menu>ul>li>a:hover {
        color: #fff;
    }

    .mega-menu>ul>li:last-child>a {
        border-bottom: 0;
    }

    .mega-menu>ul>li>a:before,
    .mega-menu>ul>li>a:after {
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        transition: all 0.5s;
    }


    .mega-menu>ul>li:hover>a:before {
        background-color: #ff9900;
    }

    .mega-menu>ul>li:hover>a:after {
        border-left-color: #fff;
    }

    .mega-menu>ul>li>.mega-submenu {
        width: 0;
        display: none;
        position: absolute;
        -webkit-transition: width 0.3s;
        -moz-transition: width 0.3s;
        transition: width 0.3s;
    }

    .mega-menu>ul>li:hover>.mega-submenu {
        top: 0;
        right: 0;
        left: 100%;
        z-index: 99;
        padding: 0px 20px;
        background-color: #fff;
        color: #fff;
        border: 1px solid #ccc;
        border-left: 0;
        overflow-y: scroll;
        display: block;
        width: 800px;
        height: 100%;
    }

    .mega-submenu>h2 {
        color: #ff9900;
        line-height: 1;
        margin: 0;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 10px;
        border-bottom: 1px solid #eee;
        display: block;
    }

    .mega-submenu>.submenu-content {
        display: block;
        overflow: hidden;
        position: relative;
    }

    .menu-item {
        padding: 0;
        margin: 0;
    }

    .menu-item>.submenu-content {
        margin-left: -15px;
        margin-right: -15px;
    }

    .menu-item>.section {
        width: 33.333%;
        float: left;
        padding: 0 5px;
        position: relative;
    }

    .section>ul {
        margin: 0;
        padding: 0;
    }

    .section>ul>li {
        font-size: 14px;
        display: block;
    }

    .section>ul>li>a:hover {
        background-color: #ff9900;
        color: #fff;
    }

    .section>ul>li:last-child {
        border-bottom: 0;
    }

    .section>ul>li>a {
        color: #555;
        display: block;
        text-decoration: none;
        padding: 15px 10px;
    }
</style>
<style>
    .dropdown-menu {
        padding: 0;
        margin: 0;
        border: 0 solid transition !important;
        border: 0 solid rgba(0, 0, 0, .15);
        border-radius: 0px;
        -webkit-box-shadow: none !important;
        box-shadow: none !important
    }

    .dropdown-submenu {
        padding: 0;
        margin: 0;
        border: 0 solid transition !important;
        border: 0 solid rgba(0, 0, 0, .15);
        border-radius: 0px;
        -webkit-box-shadow: none !important;
        box-shadow: none !important
    }

    .mainmenu>a,
    .navbar-default>.navbar-nav>li>a,
    .mainmenu>ul>li>a,
    .navbar-expand-lg>.navbar-nav {
        color: #333;
        font-size: 16px;
        text-transform: capitalize;
        padding: 7px 10px;
        display: block !important;
        text-decoration: none;
    }

    .mainmenu>.active>a,
    .mainmenu>.active>a:focus,
    .mainmenu>.active>a:hover,
    .mainmenu>li>a:hover,
    .mainmenu>li>a:focus,
    .navbar-default>.navbar-nav>.show>a,
    .navbar-default>.navbar-nav>.show>a:focus,
    .navbar-default>.navbar-nav>.show>a:hover {
        color: #fff;
        background: #ff9900;
        outline: 0;
    }

    /*==========Sub Menu=v==========*/

    .mainmenu>ul>li:hover>a {
        background: #ff9900;
    }

    .mainmenu>ul>ul>li:hover>a,
    .navbar-default>.navbar-nav>.show>.dropdown-menu>li>a:focus,
    .navbar-default>.navbar-nav>.show>.dropdown-menu>li>a:hover {
        background: #ff9900;
    }

    .mainmenu>ul>ul>ul>li:hover>a {
        background: #ff9900;
    }

    .mainmenu>ul>ul,
    .mainmenu>ul>ul>.dropdown-menu {
        background: #eee;
        padding: 0px !important;
    }


    /******************************Drop-down menu work on hover**********************************/
    .mainmenu {
        background: #777;
        border: 0 solid;
        margin: 0;
        padding: 0px;
        /* min-height: 20px; */
        width: auto;
        border-radius: 0px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    @media only screen and (min-width: 767px) {
        .mainmenu>.menu-item>ul>li:hover>ul {
            display: block
        }

        .mainmenu>ul>li,
        .mainmenu>ul>li>a {
            display: inline-block !important;
        }

        .mainmenu>ul>ul>li,
        .mainmenu>ul>ul>li>div {
            display: block !important;
        }


        .mainmenu>ul>ul>ul>li:first-child {
            border-top: 1px solid #ccc;
        }

        .mainmenu>ul>ul {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 200px;
            display: none;
        }

        /*******/
        .mainmenu>ul>ul>li {
            position: relative;
            padding: 0px;
        }

        .mainmenu>ul>ul>li:hover>ul {
            display: block
        }
    }

    @media only screen and (max-width: 767px) {
        .navbar-nav>.show>.dropdown-menu>.dropdown-menu>li>a {
            padding: 16px 15px 16px 35px
        }

        .navbar-nav>.show>.dropdown-menu>.dropdown-menu>.dropdown-menu>li>a {
            padding: 16px 15px 16px 45px
        }
    }



    .b-t-10:hover {
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .menu-area {
        background: none;
        padding: 0px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .menu-area .mr-auto {
        list-style: none;
        margin: 0px;
        padding: 0px;
    }

    .menu-area .dropdown-toggle::after {
        display: none;
        /*width: 0;
            position: absolute;
            height: 0;
            margin-right: 0px;
            margin-left: 0px;
            vertical-align: middle;
            top: 45%;
            content: "";
            border-left: .3em solid transparent;
            border-right: .3em solid transparent;
            border-top: .3em solid;*/
    }

    .menu-area .dropdown-menu {
        margin-left: 0px !important;
        border: 1px solid #ccc;
    }

    .menu-area .dropdown {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding-top: 0px !important;
    }
</style>