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
elseif(!empty($_POST['day_0_1']))
{
	$written = file_put_contents( 'calendar.dat', serialize($_POST) );
	echo $written;
	exit();
}
$c = unserialize(file_get_contents('calendar.dat'));

?>