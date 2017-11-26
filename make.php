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
echo "<"."?php ob_start(); ?".">\n\n";
?>

<?php put_here('good-script.js'); ?>
<?php put_here('bad-script.js'); ?>
<?php put_here('data-control.php'); ?>
<?php put_here('page.php'); ?>
<?php echo "\n\n<"."?php ob_end_flush(); ?".">"; ?>
