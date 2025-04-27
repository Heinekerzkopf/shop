<?php

use wfm\View;

?>

<?php $this->getPart('parts/header'); ?>

<?php echo $this->content ?>

<?= $this->getPart('parts/footer'); ?>