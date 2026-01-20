<?php
function ctgprnnavmobile($categori, $parent)
{
	$array = array();
	if ($parent != "") {
		foreach ($categori as $key) {
			if ($key["parent"] == $parent) {
				$datakey = array(
					'id' => $key["id"],
					'name' => $key["name"]
				);
				array_push($array, $datakey);
			}
		}
	}
	return $array;
}
?>

<!-- Mobile Navigation Bar -->
<nav class="navbar navbar-dark bg-dark fixed-top d-lg-none">
	<div class="container-fluid">
		<!-- Hamburger Menu Button -->
		<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileOffcanvas">
			<i class="bi bi-list fs-4"></i>
		</button>

		<!-- Logo -->
		<div class="mx-auto">
			<a href="<?php echo base_url() ?>" class="navbar-brand">
				<img src="<?php echo base_url() ?>public/image/logonew.png" alt="Trumecs" height="30" class="img-fluid">
			</a>
		</div>

		<!-- Placeholder untuk alignment -->
		<div class="invisible">
			<button class="navbar-toggler" type="button">
				<i class="bi bi-list fs-4"></i>
			</button>
		</div>
	</div>
</nav>

<!-- Offcanvas Mobile Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel">
	<div class="offcanvas-header bg-dark text-white">
		<h5 class="offcanvas-title" id="mobileOffcanvasLabel">Menu Admin</h5>
		<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body p-0">
		<!-- Include Admin Menu -->
		<?php $this->load->view("backend/_menuadmin"); ?>
	</div>
</div>


<style>
	/* Mobile Navigation Styles */
	.navbar {
		min-height: 56px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
	}

	.navbar-brand img {
		max-height: 30px;
		width: auto;
	}

	/* Offcanvas Styles */
	.offcanvas {
		max-width: 85%;
		background-color: #f8f9fa;
	}

	.offcanvas-header {
		padding: 1rem;
	}

	.offcanvas-body {
		padding: 0;
		overflow-y: auto;
	}

	/* Touch-friendly buttons */
	.navbar-toggler {
		padding: 0.5rem;
		min-width: 44px;
		min-height: 44px;
		border: none;
		background: transparent;
	}

	.btn-close {
		min-width: 44px;
		min-height: 44px;
		padding: 0.75rem;
	}

	/* Custom scrollbar for offcanvas */
	.offcanvas-body::-webkit-scrollbar {
		width: 6px;
	}

	.offcanvas-body::-webkit-scrollbar-track {
		background: #f1f1f1;
	}

	.offcanvas-body::-webkit-scrollbar-thumb {
		background: #888;
		border-radius: 3px;
	}

	.offcanvas-body::-webkit-scrollbar-thumb:hover {
		background: #555;
	}

	/* Spacer untuk fixed navbar */
	body {
		padding-top: 56px;
	}
</style>