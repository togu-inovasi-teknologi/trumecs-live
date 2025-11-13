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
<nav id="sidebar" class="d-flex flex-column bg-dark text-white">
    <div class="sidebar-header p-3 border-bottom border-secondary">
        <a href="/backend" class="d-block">
            <img src="/public/image/logofooternew.png" alt="Logo" class="img-fluid">
        </a>
    </div>

    <div class="sidebar-menu flex-grow-1 p-3">
        <ul class="list-unstyled components mb-0">
            <?php
            $menuadmin = unserialize(MENUADMIN);
            foreach ($menuadmin as $key) :
                if ($key["prn"] == "prn") :
                    $childprn = getmenuchild($menuadmin, $key["id"]);

                    // Determine active state for parent
                    $isParentActive = false;
                    $activeChildFound = false;

                    if (count($childprn) > 0) {
                        foreach ($childprn as $ckey) {
                            $linkcontrolerkey = explode("/", $ckey["url"]);
                            if ($linkcontrolerkey[0] == $this->uri->segment(1)) {
                                $isParentActive = true;
                                $activeChildFound = true;
                                break;
                            }
                        }
                    } else {
                        $linkcontrolerkey = explode("/", $key["url"]);
                        $isParentActive = ($linkcontrolerkey[0] == $this->uri->segment(1));
                    }

                    // Menu item with dropdown
                    if ($key["url"] == "#") : ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link d-flex align-items-center text-white text-decoration-none py-2 px-3 rounded <?php echo $isParentActive ? 'bg-primary' : 'hover-bg-light'; ?>"
                                data-bs-toggle="collapse"
                                href="#submenu-<?php echo $key["id"] ?>"
                                role="button"
                                aria-expanded="<?php echo $isParentActive ? 'true' : 'false'; ?>"
                                aria-controls="submenu-<?php echo $key["id"] ?>">
                                <span class="flex-grow-1"><?php echo $key["name"] ?></span>
                                <i class="fa-solid fa-chevron-down transition-rotate <?php echo $isParentActive ? 'rotate-180' : ''; ?>"></i>
                            </a>

                            <div class="collapse <?php echo $isParentActive ? 'show' : ''; ?>" id="submenu-<?php echo $key["id"] ?>">
                                <ul class="list-unstyled ms-3 mt-2">
                                    <?php foreach ($childprn as $ckey) :
                                        $childActive = (explode("/", $ckey["url"])[1] == $this->uri->segment(2));
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex gap-2 align-items-center text-white-50 text-decoration-none py-2 px-3 rounded <?php echo $childActive ? 'bg-primary text-white' : 'hover-bg-light'; ?>"
                                                href="<?php echo site_url($ckey['url']); ?>">
                                                <span class="fa <?php echo $ckey["icon"] ?>"></span>
                                                <small><?php echo $ckey['name'] ?></small>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    <?php else : ?>
                        <!-- Menu item without dropdown -->
                        <li class="nav-item mb-2">
                            <a class="nav-link d-flex align-items-center text-white text-decoration-none py-2 px-3 rounded <?php echo $isParentActive ? 'bg-primary' : 'hover-bg-light'; ?>"
                                href="<?php echo site_url($key["url"]); ?>">
                                <span><?php echo $key["name"] ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="sidebar-footer p-3 border-top border-secondary">
        <a href="<?= base_url() ?>/backend" class="text-decoration-none text-white">
            <div class="d-flex gap-2 align-items-center mb-3">
                <img src="<?= base_url(); ?>/public/image/icon-mascot-trumecs.png"
                    class="rounded-circle"
                    width="50"
                    height="50"
                    alt="Profile">
                <div class="d-flex flex-column">
                    <strong><?php echo ucwords($firtsname[0]) ?></strong>
                    <strong class="text-warning"><?php echo ucwords($ses["admin"]["level"]) ?></strong>
                </div>
            </div>
        </a>

        <div class="d-flex gap-2 align-items-center">
            <span class="fa fa-sign-out text-danger"></span>
            <a href="<?php echo base_url('backend/login/logout'); ?>" class="text-white text-decoration-none">Logout</a>
        </div>
    </div>
</nav>

<style>
    #sidebar {
        width: 280px;
        min-height: 100vh;
        height: 100vh;
        /* Tambahkan ini */
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
    }

    .sidebar-menu {
        overflow-y: auto;
        overflow-x: hidden;
        flex: 1;
        /* Ini akan membuat menu memenuhi sisa space */
        max-height: calc(100vh - 200px);
        /* Sesuaikan dengan header dan footer */
    }

    .sidebar-menu::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-menu::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar-menu::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    .hover-bg-light:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
    }

    .transition-rotate {
        transition: transform 0.3s ease;
    }

    .rotate-180 {
        transform: rotate(180deg);
    }

    .sidebar-menu .nav-link {
        transition: all 0.2s;
    }

    /* Maintain original styling for footer */
    .sidebar-footer {
        background-color: rgba(0, 0, 0, 0.2);
        flex-shrink: 0;
        /* Footer tidak akan menyusut */
    }

    .sidebar-header {
        flex-shrink: 0;
        /* Header tidak akan menyusut */
    }

    /* Ensure proper height calculation */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        /* Prevent body scroll */
    }

    /* Improved active states */
    .nav-link.bg-primary {
        background-color: #0d6efd !important;
    }

    .nav-link.bg-primary .text-white-50 {
        color: white !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collapseTriggers = document.querySelectorAll('[data-bs-toggle="collapse"]');

        collapseTriggers.forEach(trigger => {
            const targetId = trigger.getAttribute('href');
            const target = document.querySelector(targetId);
            const icon = trigger.querySelector('.fa-chevron-down');

            if (target && target.classList.contains('show') && icon) {
                icon.classList.add('rotate-180');
            }

            trigger.addEventListener('click', function() {
                setTimeout(() => {
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    const icon = this.querySelector('.fa-chevron-down');
                    if (icon) {
                        icon.classList.toggle('rotate-180', isExpanded);
                    }
                }, 10);
            });
        });
    });
</script>