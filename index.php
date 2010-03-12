<?php

/** Runfile for ColourCal.
 * Run this file to test the app.
 */

$version_short = '0.2';
$version = '1-'.$version_short.'-'.date('y.W.N-H.i.s');
ob_start();
?>

<?php include('jquery.js'); ?>
<?php include('ui.jquery.js'); ?>
<?php include('ui.jquery.css'); ?>
<?php include('md5.jquery.js'); ?>
<?php include('good-script.js'); ?>
<?php include('bad-script.js'); ?>
<?php include('data-control.php'); ?>
<?php include('page.php'); ?>

<?php ob_end_flush(); ?>
