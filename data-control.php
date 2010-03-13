<?php
$pass = md5('password'); //todo: implement user/pass system/db

//todo: encrypt all data i/o 
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
elseif($_GET['data'] == 'uijs')
{
	header('Content-type: text/javascript');
	echo $jQueryUI_js;
	exit();
}
elseif($_GET['data'] == 'uicss')
{
	header('Content-type: text/javascript');
	echo $jQueryUI_css;
	exit();
}
elseif(!empty($_POST['day_0_1']))
{
	$dat = $_POST;
	$dat["colors"] = array(); //todo: separate colours/month data save
	$cc = explode('|', $_GET['colors']);
	foreach ( $cc as $ccc )
	{
		$c4 = explode(':', $ccc);
		$dat["colors"][] = array($c4[0], $c4[1]);
	}
	
	$crypt = serialize($dat); //todo: put some real encryption there.
	
	$written = file_put_contents( 'calendar.dat', $crypt ); //for later versions: implement
		//several options (mysql/sqlite/flatfile)
	echo $written;
	exit();
}
$c = unserialize(file_get_contents('calendar.dat'));
?>
