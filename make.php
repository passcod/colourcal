<?php

/** Makefile for ColourCal.
 * Run this file to build the one-file (two, actually,
 * but one's for the data) app. (for distro).
 */

header('Content-type: text/plain');

function put_here($filename)
{
	$file = file_get_contents($filename);
	echo $file;
}

?>

<?php put_here('jquery.js'); ?>
<?php put_here('md5.jquery.js'); ?>
<?php put_here('good-script.js'); ?>
<?php put_here('bad-script.js'); ?>
<?php put_here('data-control.php'); ?>
<?php put_here('page.php'); ?>