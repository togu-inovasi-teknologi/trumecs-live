<?php $ses = $this->session->all_userdata();
$firtsname = explode(" ", $ses["admin"]["nameadmin"]);
?>
<?php function getmenuchild($menu, $id)
{
    $tampung = array();
    foreach ($menu as $key) {
        if ($key["prn"] == $id) {
            $okeinichildnya = array('id' => $key["id"], 'name' => $key["name"], 'icon' => $key["icon"], 'prn' => $key["prn"], 'url' => $key["url"]);
            array_push($tampung, $okeinichildnya);
        }
    }
    return $tampung;
} ?>
<style>
    .head-nav>.nav-item>.active {
        background: #555;
        color: #fff;
        border-color: #000 !important;
        border-bottom: 0px !important;
    }

    .head-menu {
        border: 1px solid #ccc !important;
        color: #333;
        font-size: 12px;
        background: #fff;
    }

    a,
    a:hover,
    a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
    }

    .navbar {
        padding: 15px 10px;
        background: #fff;
        border: none;
        border-radius: 0;
        margin-bottom: 40px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none;
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd;
        margin: 40px 0;
    }

    /* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */


    #sidebar {
        min-width: 200px;
        max-width: 200px;
        height: 100vh;
        background: #000000;
        color: #fff !important;
        transition: all 0.3s;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #000000;
        border-bottom: 1px solid #444444;
    }

    #sidebar .sidebar-menu {
        padding: 5px 0px;
        overflow-y: scroll !important;
    }

    #sidebar .sidebar-footer {
        padding: 5px;
        background: #000000;
        border-top: 1px solid #444444;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #sidebar ul li a:hover {
        color: #fa8420;
        background: #444444;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #fff;
        background: #444444;
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #444444;
    }

    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
        }

        #sidebar.active {
            margin-left: 0;
        }

        #sidebarCollapse span {
            display: none;
        }
    }

    .show-menu {
        display: inline-block !important;
    }

    .sub-menu {
        display: inline-block;
        padding: 10px;
        width: 100px;
        vertical-align: top;
        border-right: 1px solid #ccc;
        color: #fa8420;
    }

    .separator {
        display: inline-block;
        height: 10px;
        width: 1px;
        background: #ccc;
    }

    .nav-item.active {
        background: #ccc;
    }
</style>
<!-- <nav class="navbar navbar-fixed-top " role="navigation" style="padding:0px;background:#333;">
    <div class="row" style="margin:0px;">
        <div style="width:100%;display:flex;margin-top:5px;">
            <ul class="nav nav-tabs head-nav" style="width:100%;flex:1;">
                <li class="nav-item">
                    <a class="nav-link btn-sm btnnew head-menu" style="background:#fa8420" href="#"><span class="fa fa-bars"></span></a>
                </li>
                <?php
                $menuadmin = (unserialize(MENUADMIN));
                foreach ($menuadmin as $key) :
                    $childprn = getmenuchild($menuadmin, $key["id"]);

                    if (count($childprn) > 0) :
                        foreach ($childprn as $ckey) :
                            $linkcontrolerkey = explode("/", $ckey["url"]);
                        endforeach;
                    else :
                        $linkcontrolerkey = explode("/", $key["url"]);
                    endif;
                    $geturlcontroller = $this->uri->segment(1);

                    if ($key["prn"] == "prn") : ?>
                        <li class="nav-item">
                            <a <?php echo $key["url"] != "#" ? '' : 'data-toggle="tab"' ?> class="nav-link btn-sm head-menu <?php echo ($linkcontrolerkey[0] == $geturlcontroller) ? "active" : ""; ?>" id-menu="<?php echo $key["id"] ?>" href="<?php echo $key["url"] != "#" ? site_url($key["url"]) : "#" . $key["id"]; ?>"><?php echo $key["name"] ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <li class="nav-item">
                    <a class="nav-link btn-sm btnnew head-menu" style="background:#d9534f" href="<?php echo base_url('backend/login/logout'); ?>"><span class="fa fa-exit"></span> Logout</a>
                </li>
            </ul>
        </div>
        <div class="row" style="margin:0px">
            <div class="col-xs-12 tab-content" style="background:#555;">
                <?php
                foreach ($menuadmin as $key) :
                    $childprn = getmenuchild($menuadmin, $key["id"]);
                    foreach ($childprn as $ckey) :
                        $linkcontrolerkey = explode("/", $ckey["url"]);
                    endforeach;
                ?>
                    <?php
                    if ($key["url"] == "#") :
                    ?>
                        <div class="tab-pane fade <?php echo ($linkcontrolerkey[0] == $geturlcontroller) ? "active in" : ""; ?>" id="<?php echo $key["id"] ?>">
                            <?php foreach ($childprn as $ckey) : ?>
                                <a class="sub-menu text-center" href="<?php echo site_url($ckey['url']); ?>" style="line-height:1">
                                    <span class="fa <?php echo $ckey["icon"] ?>"></span><br /><small><?php echo $ckey['name'] ?></small>
                                </a>
                            <?php endforeach; ?>
                        </div>
                <?php endif;
                endforeach; ?>
            </div>
        </div>
        <span class="pull-right">
            <div class="btn-group btn-group-sm" role="group">
                <span class="btn btn-info"><strong>Halo, <?php echo ucwords($firtsname[0]) ?> </strong></span>
                <span class="btn btnnew"><strong><?php echo ucwords($ses["admin"]["level"]) ?></strong></span>
            </div>
        </span>
    </div>
</nav> -->
<nav id="sidebar" class="d-flex flex-column">
    <div class="sidebar-header">
        <a href="/backend"><img src="/public/image/logofooternew.png" alt="" width="100%"></a>
    </div>
    <div class="sidebar-menu">
        <ul class="list-unstyled components m-b-0">
            <li>
                <?php
                $menuadmin = (unserialize(MENUADMIN));
                foreach ($menuadmin as $key) :
                    $childprn = getmenuchild($menuadmin, $key["id"]);
                    foreach ($childprn as $ckey) :
                        $linkcontrolerkey = explode("/", $ckey["url"]);
                    endforeach;
                    if (count($childprn) > 0) :
                        foreach ($childprn as $ckey) :
                            $linkcontrolerkey = explode("/", $ckey["url"]);
                        endforeach;
                    else :
                        $linkcontrolerkey = explode("/", $key["url"]);
                    endif;
                    $geturlcontroller = $this->uri->segment(1);

                    if ($key["prn"] == "prn") : ?>
                        <a <?php echo $key["url"] != "#" ? '' : 'data-toggle="collapse"' ?> class="dropdown-toggle <?php echo ($linkcontrolerkey[0] == $geturlcontroller) ? "active" : ""; ?>" id-menu="<?php echo $key["id"] ?>" href="<?php echo $key["url"] != "#" ? site_url($key["url"]) : "#" . $key["id"]; ?>" aria-expanded="false"><?php echo $key["name"] ?></a>
                        <?php
                        if ($key["url"] == "#") :
                        ?>
                            <ul class="collapse list-unstyled <?php echo ($linkcontrolerkey[0] == $geturlcontroller) ? "active in" : ""; ?>" id="<?php echo $key["id"] ?>">
                                <?php foreach ($childprn as $ckey) : ?>
                                    <li>
                                        <a class="" href="<?php echo site_url($ckey['url']); ?>" style="line-height:1">
                                            <div class="d-flex gap-1 align-items-center">
                                                <span class="fa <?php echo $ckey["icon"] ?>"></span><small><?php echo $ckey['name'] ?></small>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </li>
        </ul>
    </div>
    <div class="sidebar-footer p-a-1 d-flex flex-column gap-2">
        <a href="<?= base_url() ?>/backend">
            <div class="d-flex gap-1 align-items-center">
                <img src="<?= base_url(); ?>/public/image/icon-mascot-trumecs.png" class="img-circle" width="50px" height="50px">
                <div class="d-flex flex-column gap-1 align-items-start">
                    <strong><?php echo ucwords($firtsname[0]) ?></strong>
                    <strong class="forange"><?php echo ucwords($ses["admin"]["level"]) ?></strong>
                </div>
            </div>
        </a>
        <div class="d-flex gap-1 align-items-center">
            <span class="fa fa-sign-out fred"></span>
            <a href="<?php echo base_url('backend/login/logout'); ?>">Logout</a>
        </div>
    </div>
</nav>