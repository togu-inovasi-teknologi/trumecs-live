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
</style>
<nav class="navbar navbar-fixed-top " role="navigation" style="padding:0px;background:#333;">
    <div class="row" style="margin:0px;">
        <div style="width:100%;display:flex;margin-top:5px;">
            <ul class="nav nav-tabs head-nav" style="width:100%;flex:1;">
                <li class="nav-item">
                    <a class="nav-link btn-sm btnnew head-menu" style="background:#ff9900" href="#"><span class="fa fa-bars"></span></a>
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
        <!--<span class="pull-right">
        <div class="btn-group btn-group-sm" role="group">
            <span class="btn btn-info"><strong>Halo, <?php echo ucwords($firtsname[0]) ?> </strong></span>
            <span class="btn btnnew"><strong><?php echo ucwords($ses["admin"]["level"]) ?></strong></span>
        </div>
    </span>-->
    </div>
</nav>
<div class="clearfix"></div>

<style>
    .show-menu {
        display: inline-block !important;
    }

    .sub-menu {
        display: inline-block;
        padding: 10px;
        width: 100px;
        vertical-align: top;
        border-right: 1px solid #ccc;
        color: #ff9900;
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