<?php $ses = $this->session->all_userdata();
$firtsname = explode(" ", $ses["admin"]["nameadmin"]);

$menuadmin = (unserialize(MENUADMIN));
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$linkremovebase = str_replace(base_url(), "", $actual_link);
$geturlcontroller = $this->uri->segment(1);
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

<div class="row">
  <div class="col-xs-4">
    <img src="<?php echo base_url() ?>public/image/icon-mascot-trumecs.png" class="img-fluid img-circle">
  </div>
  <div class="col-xs-8 p-a-0">
    <strong class="f18"><?php echo ucwords($firtsname[0]) ?>
    </strong><small class="label label-warning"><?php echo ucwords($ses["admin"]["level"]) ?></small>
  </div>
</div>
<hr class="m-t-0 m-b-1">
<div class="list-group menu-admin">
  <a href="<?php echo base_url() ?>backend" class="list-group-item">
    Home
  </a>
  <?php $collapse = 0 ?>
  <?php foreach ($menuadmin as $key) : ?>
    <?php
    $notifnew = array(array("count(id)" => ""));
    $notifnew = ($key["id"] == 8) ? unserialize(COUNTPRODUCT) : $notifnew;
    $notifnew = ($key["id"] == 10) ? unserialize(COUNTPRODUCT) : $notifnew;

    $notifnew = ($key["id"] == 13) ? unserialize(COUNTUNPAIDORDER) : $notifnew;
    $notifnew = ($key["id"] == 14) ? unserialize(COUNTNEWORDER) : $notifnew;
    $notifnew = ($key["id"] == 15) ? unserialize(COUNTUNPAIDORDER) : $notifnew;
    $notifnew = ($key["id"] == 16) ? unserialize(COUNTPAIDORDER) : $notifnew;
    $notifnew = ($key["id"] == 17) ? unserialize(COUNTPROCESSORDER) : $notifnew;
    $notifnew = ($key["id"] == 18) ? unserialize(COUNTDELIVERYORDER) : $notifnew;
    $notifnew = ($key["id"] == 19) ? unserialize(COUNTCOMPLATEORDER) : $notifnew;
    $notifnew = ($key["id"] == 20) ? unserialize(COUNTCANCELORDER) : $notifnew;
    $notifnew = ($key["id"] == 21) ? unserialize(COUNTCHALLENGEORDER) : $notifnew;

    $notifnew = ($key["id"] == 22) ? unserialize(COUNTNEWCONFIRM) : $notifnew;
    $notifnew = ($key["id"] == 23) ? unserialize(COUNTCONFIRM) : $notifnew;
    $notifnew = ($key["id"] == 24) ? unserialize(COUNTNEWCONFIRM) : $notifnew;
    $notifnew = ($key["id"] == 25) ? unserialize(COUNTAPPROVEDCONFIRM) : $notifnew;


    $notifnew = ($key["id"] == 59) ? unserialize(COUNTMEMBER) : $notifnew;
    $notifnew = ($key["id"] == 60) ? unserialize(COUNTACTIVEMEMBER) : $notifnew;
    $notifnew = ($key["id"] == 61) ? unserialize(COUNTUNACTIVEMEMBER) : $notifnew;

    $notifnew = ($key["id"] == 30) ? unserialize(COUNTPROMO) : $notifnew;

    //$notifnew = ($key["id"]==62) ? unserialize(COUNTCUCIGUDANG) : $notifnew ;

    $notifnew = ($key["id"] == 33) ? unserialize(COUNTPAGE) : $notifnew;

    $notifnew = ($key["id"] == 36) ? unserialize(COUNTARTIKEL) : $notifnew;

    $notifnew = ($key["id"] == 46) ? unserialize(COUNTADMIN) : $notifnew;

    $notifnew = ($key["id"] == 48) ? unserialize(COUNTUNRESPONCOMPLAINT) : $notifnew;
    $notifnew = ($key["id"] == 49) ? unserialize(COUNTCOMPLAINT) : $notifnew;
    $notifnew = ($key["id"] == 50) ? unserialize(COUNTUNRESPONCOMPLAINT) : $notifnew;
    $notifnew = ($key["id"] == 51) ? unserialize(COUNTRESPONCOMPLAINT) : $notifnew;

    $notifnew = ($key["id"] == 52) ? unserialize(COUNTUNRESPONWARRANTY) : $notifnew;
    $notifnew = ($key["id"] == 53) ? unserialize(COUNTWARRANTY) : $notifnew;
    $notifnew = ($key["id"] == 54) ? unserialize(COUNTUNRESPONWARRANTY) : $notifnew;
    $notifnew = ($key["id"] == 55) ? unserialize(COUNTRESPONWARRANTY) : $notifnew;

    foreach ($notifnew as $notifnew) {
      # code...
    }
    ?>
    <?php if ($key["prn"] == "prn") : ?>
      <?php $collapse++; ?>
      <a style="background-color: #26d1ff !important;font-weight:bold;color:#fff !important" href="<?php echo ($key["url"] == "#") ? '.collapse' . $collapse : base_url() . $key["url"]; ?>" class="list-group-item" <?php echo ($key["url"] == "#") ? 'data-toggle="collapse" aria-expanded="false"' : ''; ?>>
        <?php echo ($key["url"] == "#") ? '<span class=" pull-xs-right">' . $notifnew["count(id)"] . '<i class="fa fa-angle-down"></i></span>' : ''; ?>
        <?php echo $key["name"] ?>
      </a>

    <?php endif ?>
    <?php $childprn = getmenuchild($menuadmin, $key["id"]);
    ?>
    <?php foreach ($childprn as $ckey) : ?>
      <?php if (1 == 1) : ?>
        <?php
        $notifnew = array(array("count(id)" => ""));
        $notifnew = ($ckey["id"] == 8) ? unserialize(COUNTPRODUCT) : $notifnew;
        $notifnew = ($ckey["id"] == 10) ? unserialize(COUNTPRODUCT) : $notifnew;

        $notifnew = ($ckey["id"] == 13) ? unserialize(COUNTUNPAIDORDER) : $notifnew;
        $notifnew = ($ckey["id"] == 14) ? unserialize(COUNTNEWORDER) : $notifnew;
        $notifnew = ($ckey["id"] == 15) ? unserialize(COUNTUNPAIDORDER) : $notifnew;
        $notifnew = ($ckey["id"] == 16) ? unserialize(COUNTPAIDORDER) : $notifnew;
        $notifnew = ($ckey["id"] == 17) ? unserialize(COUNTPROCESSORDER) : $notifnew;
        $notifnew = ($ckey["id"] == 18) ? unserialize(COUNTDELIVERYORDER) : $notifnew;
        $notifnew = ($ckey["id"] == 19) ? unserialize(COUNTCOMPLATEORDER) : $notifnew;
        $notifnew = ($ckey["id"] == 20) ? unserialize(COUNTCANCELORDER) : $notifnew;
        $notifnew = ($ckey["id"] == 21) ? unserialize(COUNTCHALLENGEORDER) : $notifnew;

        $notifnew = ($ckey["id"] == 22) ? unserialize(COUNTNEWCONFIRM) : $notifnew;
        $notifnew = ($ckey["id"] == 23) ? unserialize(COUNTCONFIRM) : $notifnew;
        $notifnew = ($ckey["id"] == 24) ? unserialize(COUNTNEWCONFIRM) : $notifnew;
        $notifnew = ($ckey["id"] == 25) ? unserialize(COUNTAPPROVEDCONFIRM) : $notifnew;
        $notifnew = ($ckey["id"] == 26) ? unserialize(COUNTREJECTEDCONFIRM) : $notifnew;

        $notifnew = ($ckey["id"] == 27) ? unserialize(COUNTMEMBER) : $notifnew;
        $notifnew = ($ckey["id"] == 59) ? unserialize(COUNTMEMBER) : $notifnew;
        $notifnew = ($ckey["id"] == 60) ? unserialize(COUNTACTIVEMEMBER) : $notifnew;
        $notifnew = ($ckey["id"] == 61) ? unserialize(COUNTUNACTIVEMEMBER) : $notifnew;

        $notifnew = ($ckey["id"] == 30) ? unserialize(COUNTPROMO) : $notifnew;
        $notifnew = ($ckey["id"] == 62) ? unserialize(COUNTCUCIGUDANG) : $notifnew;
        $notifnew = ($ckey["id"] == 33) ? unserialize(COUNTPAGE) : $notifnew;

        $notifnew = ($ckey["id"] == 36) ? unserialize(COUNTARTIKEL) : $notifnew;

        $notifnew = ($ckey["id"] == 46) ? unserialize(COUNTADMIN) : $notifnew;

        $notifnew = ($ckey["id"] == 48) ? unserialize(COUNTUNRESPONCOMPLAINT) : $notifnew;
        $notifnew = ($ckey["id"] == 49) ? unserialize(COUNTCOMPLAINT) : $notifnew;
        $notifnew = ($ckey["id"] == 50) ? unserialize(COUNTUNRESPONCOMPLAINT) : $notifnew;
        $notifnew = ($ckey["id"] == 51) ? unserialize(COUNTRESPONCOMPLAINT) : $notifnew;

        $notifnew = ($ckey["id"] == 52) ? unserialize(COUNTUNRESPONWARRANTY) : $notifnew;
        $notifnew = ($ckey["id"] == 53) ? unserialize(COUNTWARRANTY) : $notifnew;
        $notifnew = ($ckey["id"] == 54) ? unserialize(COUNTUNRESPONWARRANTY) : $notifnew;
        $notifnew = ($ckey["id"] == 55) ? unserialize(COUNTRESPONWARRANTY) : $notifnew;

        foreach ($notifnew as $notifnew) {
          # code...
        } ?>
        <?php $linkcontrolerkey = explode("/", $ckey["url"]) ?>
        <span class="collapse fade <?php echo ($linkcontrolerkey[0] == $geturlcontroller) ? "in" : ""; ?> collapse<?php echo $collapse ?>">
          <a class="list-group-item p-l-2" style="padding-left:50px !important;background-color: #ffae00 !important;font-weight:bold;color:#fff !important" href="<?php echo base_url() ?><?php echo $ckey["url"] ?>">
            <?php echo ($notifnew["count(id)"] != "") ? '<span class=" pull-xs-right">' . $notifnew["count(id)"] . '</span>' : ''; ?>
            <?php echo ($ckey["prn"] == "prn") ? '<span class=" pull-xs-right"><i class="fa fa-angle-down"></i></span>' : ''; ?>
            <?php echo $ckey["name"] ?>
          </a>
        </span>
      <?php endif ?>
    <?php endforeach ?>

  <?php endforeach ?>
  <a class="list-group-item" href="<?php echo base_url() ?>backend/logout">
    Keluar
  </a>
</div>
<style type="text/css">
  .collapse .list-group-item {
    border-radius: 0rem;
    border-bottom-color: transparent;

  }
</style>