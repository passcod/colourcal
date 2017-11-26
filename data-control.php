<?php
$cal_data = unserialize(base64_decode(file_get_contents('calendar.dat')));

$pass = $cal_data['pss'];
$c = 'notloaded';
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
	$P = $cal_data;
	foreach( $cal_data as $key => $val )
	{
		if ( $_POST[$key] != $val ) { $P[$key] = $_POST[$key]; }
	}
	$written = file_put_contents( 'calendar.dat', base64_encode(serialize($P)) );
	echo $written;
	exit();
}
elseif(!empty($_POST['pss']))
{
	$P = $cal_data;
	$P['pss'] = $_POST['pss'];
	$written = file_put_contents( 'calendar.dat', base64_encode(serialize($P)) );
	echo $written;
	exit();
}
else
{
	$c = $cal_data;
}
?>
