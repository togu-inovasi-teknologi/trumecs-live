<?php
$ses = $this->session->all_userdata();
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

<!-- User Profile Section -->
<div class="bg-dark text-white p-4">
  <div class="d-flex align-items-center">
    <div class="me-3">
      <img src="<?php echo base_url() ?>public/image/icon-mascot-trumecs.png" class="rounded-circle" width="60" height="60">
    </div>
    <div class="flex-grow-1">
      <h6 class="fw-bold mb-1"><?php echo ucwords($firtsname[0]) ?></h6>
      <span class="badge bg-warning"><?php echo ucwords($ses["admin"]["level"]) ?></span>
    </div>
  </div>
</div>

<!-- Menu Items -->
<div class="list-group list-group-flush">
  <!-- Home Link -->
  <a href="<?php echo base_url() ?>backend" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center">
    <i class="bi bi-house-door me-3 text-primary"></i>
    <span>Home</span>
  </a>

  <?php $collapse = 0 ?>
  <?php foreach ($menuadmin as $key) : ?>
    <?php
    // Notifikasi counts
    $notifnew = array(array("count(id)" => ""));
    $notifnew = ($key["id"] == 8) ? unserialize(COUNTPRODUCT) : $notifnew;
    $notifnew = ($key["id"] == 10) ? unserialize(COUNTPRODUCT) : $notifnew;

    $notifnew = ($key["id"] == 13) ? unserialize(COUNTUNPAIDORDER) : $notifnew;
    $notifnew = ($key["id"] == 14) ? unserialize(COUNTNEWORDER) : $notifnew;
    $notifnew = ($key["id"] == 15) ? unserialize(COUNTUNPAIDORDER) : $notifnew;
    $notifnew = ($key["id"] == 16) ? unserialize(COUNTPAIDORDER) : $notifnew;
    $notifnew = ($key["id"] == 17) ? unserialize(COUNTPROCESSORDER) : $notifnew;
    $notifnew = ($key["id"] == 18) ? unserialize(COUNTDELIVERYORDER) : $notifnew;
    // $notifnew = ($key["id"] == 19) ? unserialize(COUNTCOMPLETEORDER) : $notifnew;
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

    // Cek apakah menu memiliki child
    $childprn = getmenuchild($menuadmin, $key["id"]);
    $hasChildren = !empty($childprn);
    ?>

    <?php if ($key["prn"] == "prn") : ?>
      <?php if ($hasChildren): ?>
        <?php $collapse++; ?>
        <!-- Menu dengan child - tampilkan sebagai accordion -->
        <div class="accordion accordion-flush" id="accordionMenu<?php echo $collapse ?>">
          <div class="accordion-item border-0">
            <div class="accordion-header">
              <button class="accordion-button collapsed bg-dark bg-opacity-10 text-primary fw-bold py-3"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse<?php echo $collapse ?>"
                aria-expanded="false">
                <i class="bi bi-folder me-3"></i>
                <span class="flex-grow-1 text-start"><?php echo $key["name"] ?></span>
                <?php if ($notifnew["count(id)"] != ""): ?>
                  <span class="badge bg-danger rounded-pill ms-2"><?php echo $notifnew["count(id)"] ?></span>
                <?php endif; ?>
                <i class="bi bi-chevron-down ms-2 accordion-icon"></i>
              </button>
            </div>

            <div id="collapse<?php echo $collapse ?>" class="accordion-collapse collapse" data-bs-parent="#accordionMenu<?php echo $collapse ?>">
              <div class="accordion-body p-0">
                <?php foreach ($childprn as $ckey) : ?>
                  <?php
                  // Child notifications
                  $notifnew = array(array("count(id)" => ""));
                  $notifnew = ($ckey["id"] == 8) ? unserialize(COUNTPRODUCT) : $notifnew;
                  $notifnew = ($ckey["id"] == 10) ? unserialize(COUNTPRODUCT) : $notifnew;

                  $notifnew = ($ckey["id"] == 13) ? unserialize(COUNTUNPAIDORDER) : $notifnew;
                  $notifnew = ($ckey["id"] == 14) ? unserialize(COUNTNEWORDER) : $notifnew;
                  $notifnew = ($ckey["id"] == 15) ? unserialize(COUNTUNPAIDORDER) : $notifnew;
                  $notifnew = ($ckey["id"] == 16) ? unserialize(COUNTPAIDORDER) : $notifnew;
                  $notifnew = ($ckey["id"] == 17) ? unserialize(COUNTPROCESSORDER) : $notifnew;
                  $notifnew = ($ckey["id"] == 18) ? unserialize(COUNTDELIVERYORDER) : $notifnew;
                  // $notifnew = ($ckey["id"] == 19) ? unserialize(COUNTCOMPLETEORDER) : $notifnew;
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
                  // $notifnew = ($ckey["id"] == 62) ? unserialize(COUNTCUCIGUDANG) : $notifnew;
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
                  }
                  ?>

                  <?php $linkcontrolerkey = explode("/", $ckey["url"]) ?>
                  <?php $isActive = ($linkcontrolerkey[0] == $geturlcontroller) ? true : false; ?>

                  <a href="<?php echo base_url() . $ckey["url"] ?>"
                    class="list-group-item list-group-item-action border-0 py-3 ps-5 d-flex align-items-center <?php echo $isActive ? 'active' : ''; ?>">
                    <i class="bi bi-<?php echo $ckey["icon"] ? $ckey["icon"] : 'circle' ?> me-3"></i>
                    <span class="flex-grow-1"><?php echo $ckey["name"] ?></span>
                    <?php if ($notifnew["count(id)"] != ""): ?>
                      <span class="badge bg-danger rounded-pill"><?php echo $notifnew["count(id)"] ?></span>
                    <?php endif; ?>
                  </a>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        <!-- Menu tanpa child - tampilkan sebagai link biasa -->
        <a href="<?php echo base_url() . $key["url"] ?>" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center">
          <i class="bi bi-folder me-3"></i>
          <span class="flex-grow-1"><?php echo $key["name"] ?></span>
          <?php if ($notifnew["count(id)"] != ""): ?>
            <span class="badge bg-danger rounded-pill"><?php echo $notifnew["count(id)"] ?></span>
          <?php endif; ?>
        </a>
      <?php endif; ?>
    <?php endif ?>
  <?php endforeach ?>

  <!-- Logout Link -->
  <a href="<?php echo base_url() ?>backend/logout" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center text-danger">
    <i class="bi bi-box-arrow-right me-3"></i>
    <span>Keluar</span>
  </a>
</div>

<style>
  /* Menu Styles */
  .list-group-item {
    border-radius: 0;
    border-left: none;
    border-right: none;
    min-height: 52px;
    display: flex;
    align-items: center;
  }

  .list-group-item.active {
    background-color: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
    font-weight: bold;
    border-left: 4px solid #0d6efd;
  }

  .accordion-button {
    border-radius: 0 !important;
    font-size: 0.9rem;
    min-height: 52px;
  }

  .accordion-button:not(.collapsed) {
    background-color: rgba(13, 110, 253, 0.15);
    color: #0d6efd;
    box-shadow: none;
  }

  .accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0, 0, 0, 0.125);
  }

  .accordion-body {
    padding: 0 !important;
    background-color: #f8f9fa;
  }

  /* Touch-friendly adjustments */
  button,
  a {
    min-height: 44px;
  }

  .badge {
    font-size: 0.7rem;
  }

  /* Profile image */
  .rounded-circle {
    object-fit: cover;
  }

  /* Remove arrow icon for non-accordion items */
  .accordion-button::after {
    content: none !important;
  }

  /* Custom arrow icon */
  .accordion-icon {
    transition: transform 0.2s ease-in-out;
    font-size: 0.8rem;
  }

  .accordion-button:not(.collapsed) .accordion-icon {
    transform: rotate(180deg);
  }
</style>

<script>
  // Auto open active menu accordion
  document.addEventListener('DOMContentLoaded', function() {
    // Find active link and open its parent accordion
    const activeLink = document.querySelector('.list-group-item.active');
    if (activeLink) {
      const parentAccordion = activeLink.closest('.accordion-collapse');
      if (parentAccordion) {
        const bsCollapse = new bootstrap.Collapse(parentAccordion, {
          toggle: true
        });
      }
    }

    // Close offcanvas when clicking on menu item (except accordion toggles)
    document.querySelectorAll('.list-group-item[href]').forEach(item => {
      item.addEventListener('click', function(e) {
        if (!this.getAttribute('data-bs-toggle')) {
          const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('mobileOffcanvas'));
          if (offcanvas) {
            offcanvas.hide();
          }
        }
      });
    });
  });
</script>