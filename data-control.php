<?php
$pass = md5('password');
if($_GET['data'] == 'script')
{
	header('Content-type: text/javascript');
	if ( $_GET['pass'] == $pass )
	{
		echo $good_script;
	}
	else
	{
		echo $bad_script;
	}
	exit();
}
elseif($_GET['data'] == 'md5')
{
	header('Content-type: text/javascript');
	echo $md5;
	exit();
}
elseif($_GET['data'] == 'ui')
{
	header('Content-type: text/javascript');
	echo $jQueryUI;
	exit();
}
elseif(!empty($_POST['day_0_1']))
{
	$dat = $_POST;
	$dat["colors"] = array();
	$cc = explode('|', $_GET['colors']);
	foreach ( $cc as $ccc )
	{
		$c4 = explode(':', $ccc);
		$dat["colors"][] = array($c4[0], $c4[1]);
	}
	
	$written = file_put_contents( 'calendar.dat', serialize($dat) );
	echo $written;
	exit();
}
$c = unserialize(file_get_contents('calendar.dat'));

?>