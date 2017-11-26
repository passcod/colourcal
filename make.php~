<?php

/** Makefile for ColourCal.
 * Run this file to build the app.
 */

header('Content-type: text/plain');

function put_here($filename)
{
	$file = file_get_contents($filename);
	echo $file;
}

$dat_sample = file_get_contents('calendar.dat');


$version_short = '0.2';
$version = '1-'.$version_short.'-'.date('y.W.N-H.i.s');

echo "<"."?"."php\n\n";
?>

/** ColourCal <?php echo $version_short; ?>
 * @author passcod http://passcod.webege.com
 * @website http://colourcal.sourceforge.net
 * @licence GNU GPL see LICENSE file
 *
 * @version <?php echo $version; ?>
 */

$version_short = '<?php echo $version_short; ?>';
$version = '<?php echo $version; ?>');
ob_start();

<?php echo "\n\n?".">"; ?>

<?php put_here('jquery.js'); ?>
<?php put_here('ui.jquery.js'); ?>
<?php put_here('ui.jquery.css'); ?>
<?php put_here('md5.jquery.js'); ?>
<?php put_here('good-script.js'); ?>
<?php put_here('bad-script.js'); ?>
<?php put_here('data-control.php'); ?>
<?php put_here('page.php'); ?>
<?php echo "\n<"."?"."php\n\n"; ?>
ob_end_flush();
<?php echo "\n\n?".">"; ?>
