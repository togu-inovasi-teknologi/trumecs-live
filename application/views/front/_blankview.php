<?php
 if (isset($css)) {
     $minicss = $this->minifile->create($css, 'css');
     echo '<link rel="stylesheet" href="' . base_url("asset/core/css/" . $minicss) . '" />';
 }
 ?>
 <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/template.css">
 <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/bootstrap.4-alpha.css">

 <?php if (isset($content)) {
     $this->load->view($content);
 }