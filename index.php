<?php

/** Runfile for ColourCal.
 * Run this file to test the app.
 */
ob_start();
?>

<?php include('good-script.js'); ?>
<?php include('bad-script.js'); ?>
<?php include('data-control.php'); ?>
<?php include('page.php'); ?>

<?php ob_end_flush(); ?>
