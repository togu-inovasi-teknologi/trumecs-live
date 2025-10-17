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

    .mainmenu a,
    .navbar-default .navbar-nav>li>a,
    .mainmenu ul li a,
    .navbar-expand-lg .navbar-nav .nav-link {
        color: #333;
        font-size: 16px;
        text-transform: capitalize;
        padding: 7px 10px;
        display: block !important;
        text-decoration: none;
    }

    .mainmenu .active a,
    .mainmenu .active a:focus,
    .mainmenu .active a:hover,
    .mainmenu li a:hover,
    .mainmenu li a:focus,
    .navbar-default .navbar-nav>.show>a,
    .navbar-default .navbar-nav>.show>a:focus,
    .navbar-default .navbar-nav>.show>a:hover {
        color: #fff;
        background: #ff9900;
        outline: 0;
    }

    /*==========Sub Menu=v==========*/

    .mainmenu ul>li:hover>a {
        background: #ff9900;
    }

    .mainmenu ul ul>li:hover>a,
    .navbar-default .navbar-nav .show .dropdown-menu>li>a:focus,
    .navbar-default .navbar-nav .show .dropdown-menu>li>a:hover {
        background: #ff9900;
    }

    .mainmenu ul ul ul>li:hover>a {
        background: #ff9900;
    }

    .mainmenu ul ul,
    .mainmenu .ul ul.dropdown-menu {
        background: #eee;
        padding: 0px !important;
    }

    .mainmenu ul ul ul,
    .mainmenu ul ul ul.dropdown-menu {
        background: #eee
    }

    .mainmenu ul ul ul ul,
    .mainmenu ul ul ul ul.dropdown-menu {
        background: #eee
    }

    /******************************Drop-down menu work on hover**********************************/
    .mainmenu {
        background: #777;
        border: 0 solid;
        margin: 0;
        padding: 15px 0px;
        min-height: 20px;
        width: auto;
        border-radius: 0px;

    }

    @media only screen and (min-width: 767px) {
        .mainmenu ul li:hover>ul {
            display: block
        }

        .mainmenu ul ul {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 200px;
            display: none;
        }

        /*******/
        .mainmenu ul ul li {
            position: relative;
            padding: 0px;
        }

        .mainmenu ul ul li a {
            font-size: 14px;
            padding: 10px;
            border-bottom: 1px solid #ddd
        }


        .mainmenu ul ul li:hover>ul {
            display: block
        }

        .mainmenu ul ul ul {
            position: absolute;
            top: 0px;
            left: 100%;
            min-width: 250px;
            display: none;
        }

        /*******/
        .mainmenu ul ul ul li {
            position: relative;
            border-right: 1px solid #ccc;
        }

        .mainmenu ul ul ul li a {
            font-size: 14px;
            padding: 10px;
            border-left: 1px solid #ddd;
        }

        .mainmenu ul ul ul li:hover ul {
            display: block
        }

        .mainmenu ul ul ul ul {
            position: absolute;
            top: 0;
            left: 100%;
            min-width: 250px;
            display: none;
            z-index: 1
        }

    }

    @media only screen and (max-width: 767px) {
        .navbar-nav .show .dropdown-menu .dropdown-menu>li>a {
            padding: 16px 15px 16px 35px
        }

        .navbar-nav .show .dropdown-menu .dropdown-menu .dropdown-menu>li>a {
            padding: 16px 15px 16px 45px
        }
    }

    .mainmenu ul li,
    .mainmenu ul li a {
        display: inline-block !important;
    }

    .mainmenu ul ul li,
    .mainmenu ul ul li a {
        display: block !important;
    }

    .mainmenu ul ul ul li,
    .mainmenu ul ul ul li a {
        display: block !important;
    }

    .mainmenu ul ul ul li:first-child {
        border-top: 1px solid #ccc;
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
<?php $this->load->model("general/General_model", 'M_general'); ?>
<?php $kategori = $this->M_general->getcategori("0"); ?>
<div id="menu_area" class="menu-area pull-left p-y-0" style="min-width:120px;">
    <nav class="navbar navbar-light navbar-expand-lg mainmenu" style="padding:0px;border-top-left-radius: 5px;
        border-top-right-radius: 5px;">
        <ul class="navbar-nav mr-auto">
            <li class="dropdown">
                <a class="dropdown-toggle b-t-10" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff"><span class="fa fa-bars" style="vertical-align:middle;margin-right:10px;"></span> <?php echo $this->lang->line('kategori', FALSE); ?> </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach ($kategori as $item) : ?>
                        <li style="background:#fff">
                            <a alt="Jual Komponen <?php echo $item['name'] ?>" href="<?php echo base_url(); ?>c/<?php echo $item['url'] ?>"><strong><?php echo $item['name'] ?><i class="fa fa-angle-right" style="float: right; margin-top:2px;"></i></strong>
                            </a>
                            <ul class="dropdown-submenu" aria-labelledby="navbarDropdown" style="overflow-y:scroll;max-height:300px;">
                                <?php $kategoris = $this->M_general->getcategori($item['id']); ?>
                                <?php foreach ($kategoris as $items) : ?>
                                    <li style="background:#fff"><a alt="Jual Komponen <?php echo $items['name'] ?>" href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] ?>" class="list-kategori-atas"><?php echo $items['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </nav>
</div>