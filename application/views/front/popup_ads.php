<div class="modal fade popup_spadukbig" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
	<div class="modal-dialog modal-sm" style="margin: 5% auto;">
		<div class="modal-content">
			<div class="row">
				<div class="col-md-12">
					<?php
					if (!$this->agent->is_mobile()) :
						//if ($this->uri->segment(1) == ""):	
						$popup_adsbig = json_decode(unserialize(PROMOSPANDUK), true);
					//else:
					//	$popup_adsbig = json_decode(unserialize(PROMOSPANDUKUSED),true);
					//endif;
					else :
						//if ($this->uri->segment(1) == ""):	
						$popup_adsbig = json_decode(unserialize(PROMOSPANDUKMOBILE), true);
					//else:
					//	$popup_adsbig = json_decode(unserialize(PROMOSPANDUKMOBILEUSED),true);
					//endif;
					endif;

					$status = 'true';

					if (array_key_exists('end_date', $popup_adsbig)) {
						if ($popup_adsbig["end_date"] == 0) {
							$status = 'true';
						} else if ($popup_adsbig["start_date"] <= time() && $popup_adsbig["end_date"] >= time()) {
							$status = 'true';
						} else {
							$status = 'false';
						}
					} else {
						$status = 'false';
					}

					?>
					<div class="popup-check" data-popup="<?php echo $status; ?>"></div>
					<?php echo ($popup_adsbig["link"] != "") ? '<a href="' . $popup_adsbig["link"] . '">' : ''; ?>
					<img src="<?php echo $popup_adsbig['img'] ?>" alt="Poster Promo Pop Up">
					<?php echo ($popup_adsbig["link"] != "") ? '</a>' : ''; ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="closemodalpopup_spadukbig " style="position: fixed;
    background-color: orange;
    padding: 5px;color:white;
    right: 1px;">
				x [close]
			</div>
		</div>
	</div>
</div>