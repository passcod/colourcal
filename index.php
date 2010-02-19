<?php
$pass = md5('ffff3696');
$good_script = str_replace( '*/ ?'.'>', '', str_replace( '<'.'?php /*' , '', file_get_contents('cal.php') ) );
//$good_script = urldecode('function+editCal%28%29+%7B%0A%09function+getColor%28ele%29%0A%09%7B%0A%09%09ele+%3D+%24%28ele%29%3B%0A%09%09%0A%09%09for+%28+c+in+colors+%29%0A%09%09%7B%0A%09%09%09if+%28+ele.hasClass%28colors%5Bc%5D%29+%29+%7B+return+colors%5Bc%5D%3B+%7D%0A%09%09%7D%0A%09%09%0A%09%09return+false%3B%0A%09%7D%0A%09%0A%09function+getMonth%28ele%29%0A%09%7B%0A%09%09ele+%3D+%24%28ele%29%3B%0A%09%09%0A%09%09if+%28+ele.hasClass%28%22month0%22%29+%29+%7B+return+%220%22%3B+%7D%0A%09%09else+if+%28+ele.hasClass%28%22month1%22%29+%29+%7B+return+%221%22%3B+%7D%0A%09%09else+if+%28+ele.hasClass%28%22month2%22%29+%29+%7B+return+%222%22%3B+%7D%0A%09%09else+%7B+return+false%3B+%7D%0A%09%7D%0A%09%0A%09%0A%09%24%28document%29.ready%28function%28%29+%7B%0A%09%09%24%28%27%23login_form%27%29.remove%28%29%3B%0A%09%09%24%28%22%23mct1+%3E+tbody%22%29.append%28%27%3Ctr%3E%3Ctd%3E%3Cform+id%3D%22calendar_form%22+action%3D%22%23%22+method%3D%22post%22%3E%3C%2Fform%3E%3C%2Ftd%3E%3C%2Ftr%3E%27%29%3B%0A%09%09%24%28%22.ca1%22%29.each%28function%28i%29+%7B+%24%28this%29.find%28%22td%22%29.addClass%28%22month%22+i%29%3B+%7D%29%3B%0A%09%09%24%28%22.ca1+td%22%29.each%28function%28%29+%7B%0A%09%09%09if+%28+%2F%5B1-9%5D%7B1%2C2%7D%2Fi.test%28+%24%28this%29.html%28%29+%29+%29%0A%09%09%09%7B%0A%09%09%09%09var+val+%3D+getColor%28this%29%3B%0A%09%09%09%09var+name+%3D+%22day_%22+++getMonth%28this%29+++%22_%22+++%24%28this%29.text%28%29%3B%0A%09%09%09%09%24%28this%29.attr%28%22name%22%2C+name%29%3B%0A%09%09%09%09%24%28%22%23calendar_form%22%29.append%28%27%3Cinput+type%3D%22hidden%22+name%3D%22%27+name+%27%22+value%3D%22%27+val+%27%22+id%3D%22calendar_input_%27+name+%27%22+%2F%3E%27%29%3B%0A%09%09%09%09%0A%09%09%09%09%24%28this%29.attr%28%22onclick%22%2C+%22changeColour%28this%29%22%29%3B%0A%09%09%09%7D%0A%09%09%7D%29%3B%0A%09%09%0A%09%09%24%28%22%23calendar_form%22%29.append%28%27%3Cinput+id%3D%22submit-calendar%22+type%3D%22button%22+value%3D%22Save%22+onclick%3D%22submitCal%28%29%22+%2F%3E%3Cbr+%2F%3E%3Ca+onclick%3D%22location.reload%28true%29%3B%22%3Ecancel+-+logout%3C%2Fa%3E%27%29%3B%0A%09%7D%29%3B%0A%7D%0A%0Afunction+changeColour%28el%29%0A%7B%0A%09var+t+%3D+%24%28el%29%3B%0A%09var+i+%3D+%22calendar_input_%22+t.attr%28%22name%22%29%3B%0A%09%0A%09for+%28+c+in+colors+%29%0A%09%7B%0A%09%09c+%3D+parseInt%28c%29%3B%0A%09%09d+%3D+%28+c+1+%3C+colors.length+%29+%3F+c+1+%3A+0%3B%0A%09%09if+%28+t.hasClass%28colors%5Bc%5D%29+%29%0A%09%09%7B%0A%09%09%09%24%28%27%23%27+i%29.val%28colors%5Bd%5D%29%3B%0A%09%09%09t.removeClass%28colors%5Bc%5D%29%3B%0A%09%09%09t.addClass%28colors%5Bd%5D%29%3B%0A%09%09%09return%3B%0A%09%09%7D%0A%09%7D%0A%7D%0A%0Afunction+submitCal%28%29%0A%7B%0A%09var+params+%3D+%24%28%27%23calendar_form%27%29.serializeArray%28%29%3B%0A%09%24.post%28%27calendar.php%27%2C+params%2C+function%28data%29+%7B+console.log%28data%29%3B+%7D%2C+%27text%27%29%3B%0A%7D');
$bad_script = "function editCal() { $('#login_form').children().remove(); $('#login_form').prepend('<p class=\"red\" style=\"font-weight: bold\">Wrong password - <a onclick=\"location.reload(true);\">try again</a></p>'); }";

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
elseif(!empty($_POST['day_0_1']))
{
	$written = file_put_contents( 'calendar.dat', serialize($_POST) );
	echo $written;
	exit();
}

$c = unserialize(file_get_contents('calendar.dat'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php /* http://www.timeanddate.com/calendar/custom.html?year=2010&month=1&months=3&country=30&typ=2&display=3&cols=0&fdow=1&hol=0&ctf=4&ctc=2&holmark=1&cdt=6&ccc=9&holm=1&hid=1&df=1 */ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php $page_name = 'Calendar'; include("meta.php"); ?>

<script type="text/javascript" src="/breadcrumb.js"></script>
<link rel="stylesheet" href="/common.css" />

<style type="text/css">
@import url('calendar.css');

	.style4 {
		text-align: left;
	}
	.style5 {
		font-size: small;
	}
	.style6 {
		text-align: center;
		font-size: small;
	}
	.style7 {
		color: #F0AA31;
	}
	.style8 {
		text-align: center;
	}
	.style2 {
		background-color: #293828;
	}
	.style1 {
		background-color: #F0AA31;
	}
	.style3 {
		background-color: #CC0000;
	}
</style>

<script type="text/javascript" src="/jquery.js"></script>
<script type="text/javascript">

var colors = Array();
colors[0] = "red";
colors[1] = "yellow";
colors[2] = "green";

$(function() {
	$('#layout-left').append("<a onclick=\"loadEdit(); $(this).html(''); $(this).attr('onclick', '');\" style=\"color: #283939; font-size: x-small\">edit</a>");
});

function loadEdit()
{
	$('#layout-center').append('<div id="login_form"><p>Enter password:</p><input type="password" name="pass" class="pass" /><br /><input type="button" value="Continue" onclick="loginCal()" /></div>');
}

function loginCal()
{
	$.getScript('md5.jquery.js', function() {
		var param = $.md5( $('#login_form input.pass').val() );
		$.getScript('calendar.php?data=script&pass='+param, function() { editCal(); });
	});
}
</script>
</head>

<body>
<div id="layout-page">
	<div id="layout-head">
		<table id="table-head" cellspacing="0" cellpadding="0">
			<tbody><tr>
				<td id="cell-1-head" rowspan="2"><a href="gallery.php"><img alt="header_gallery" src="images_header/header_01.gif" width="364" height="200" /></a></td>
				<td id="cell-2-head"><a href="location.php"><img alt="header_location" src="images_header/header_02.gif" width="436" height="120" /></a></td>
			</tr>
			<tr>
				<td id="cell-3-head"><a href="index.php"><img alt="header_index" src="images_header/header_03.gif" width="436" height="80" /></a></td>
			</tr>
		</tbody></table>
	</div><a id="Top"></a>
	<div id="layout-breadcrumb">
		<table id="table-breadcrumb" cellspacing="0" cellpadding="0">
			<tbody><tr>
				<td><a href="index.php"><img alt="Index" src="images_nav/button_01.gif" onmouseover="breadcrumb('button-1', false, true)" onmouseout="breadcrumb('button-1', false, false)" id="button-1" width="133" height="30" /></a></td>
				<td><a href="gallery.php"><img alt="Gallery" src="images_nav/button_02.gif" onmouseover="breadcrumb('button-2', false, true)" onmouseout="breadcrumb('button-2', false, false)" id="button-2" width="133" height="30" /></a></td>
				<td><a href="location.php"><img alt="Location" src="images_nav/button_03.gif" onmouseover="breadcrumb('button-3', false, true)" onmouseout="breadcrumb('button-3', false, false)" id="button-3" width="133" height="30" /></a></td>
				<td><a href="safety.php"><img alt="Safety" src="images_nav/button_04.gif" onmouseover="breadcrumb('button-4', false, true)" onmouseout="breadcrumb('button-4', false, false)" id="button-4" width="133" height="30" /></a></td>
				<td><a href="pricing.php"><img alt="Pricing" src="images_nav/button_05.gif" onmouseover="breadcrumb('button-5', false, true)" onmouseout="breadcrumb('button-5', false, false)" id="button-5" width="133" height="30" /></a></td>
				<td><a href="activities.php"><img alt="Activities" src="images_nav/button_06.gif" onmouseover="breadcrumb('button-6', false, true)" onmouseout="breadcrumb('button-6', false, false)" id="button-6" width="133" height="30" /></a></td>
			</tr>
		</tbody></table>
	</div>
	<div id="layout-left" class="style4">
		<div class="style8">
		<br />
		<strong><br />
			Opening Days Calendar<br /><br />
			</strong>
		<br />
			<div>
&nbsp;&nbsp;&nbsp; <span class="green"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		OPEN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</strong></span><span class="style1"><span class="style2"><strong><br />
		</strong></span></span><br />
<br />
		<span class="style5">normal hours from 10am to 5pm</span><br />
<span class="style5">contact us for afterhours</span><br />
<br />
<br />
<span class="yellow"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BOOKING&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; </strong>
		</span><strong><br />
		</strong>
			</div>
		<span class="style5"></div>
		<div class="style6">
			Subject to availability, the park can be open at your request for groups 
			from 5 people: <br />
			<br />
&nbsp;<span class="style7"><strong>Ph 09 459 4485</strong></span><br />
			<a href="mailto:info@adventureforest.co.nz">
			info@adventureforest.co.nz</a><br />
		</div>
		</span>
		<br />
		<br />
		<div class="style8">
			<strong>
		<br />
		</strong><span class="red"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		CLOSED&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</strong></span><strong>
		<br />
		</strong>
		<br />
				</div>
		<span style="color: rgb(124, 105, 49);">_</span>
		</div>
	<div id="layout-center" style="text-align: left">
		<br />
<!-- BEGIN CALENDAR -->

<table cellspacing="0" cellpadding="4" border="0" align="center" class="ct1 cl2 cp4 cc10 cd1 cf3 ci8 cu3 cj1" id="mct1">
	<tbody>
		<tr>
			<th>
				January
			</th>
			<td class="cz"/>
			<th>
				February
			</th>
			<td class="cz"/>
			<th>
				March
			</th>
		</tr>
		<tr>
			<td valign="top" align="center" class="cbm cba cbo">
				<table cellspacing="0" cellpadding="2" border="0" class="ca ca1">
					<tbody>
						<tr class="cl">
							<td class="brown">Mo</td>
							<td class="brown">Tu</td>
							<td class="brown">We</td>
							<td class="brown">Th</td>
							<td class="brown">Fr</td>
							<td class="brown">Sa</td>
							<td class="cr brown">Su</td>
						</tr>
						<tr>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="<?php echo $c['day_0_1']; ?>">1</td>
							<td class="<?php echo $c['day_0_2']; ?>">2</td>
							<td class="cr <?php echo $c['day_0_3']; ?>">3</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_0_4']; ?>">4</td>
							<td class="<?php echo $c['day_0_5']; ?>">5</td>
							<td class="<?php echo $c['day_0_6']; ?>">6</td>
							<td class="<?php echo $c['day_0_7']; ?>">7</td>
							<td class="<?php echo $c['day_0_8']; ?>">8</td>
							<td class="<?php echo $c['day_0_9']; ?>">9</td>
							<td class="cr <?php echo $c['day_0_10']; ?>">10</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_0_11']; ?>">11</td>
							<td class="<?php echo $c['day_0_12']; ?>">12</td>
							<td class="<?php echo $c['day_0_13']; ?>">13</td>
							<td class="<?php echo $c['day_0_14']; ?>">14</td>
							<td class="<?php echo $c['day_0_15']; ?>">15</td>
							<td class="<?php echo $c['day_0_16']; ?>">16</td>
							<td class="cr <?php echo $c['day_0_17']; ?>">17</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_0_18']; ?>">18</td>
							<td class="<?php echo $c['day_0_19']; ?>">19</td>
							<td class="<?php echo $c['day_0_20']; ?>">20</td>
							<td class="<?php echo $c['day_0_21']; ?>">21</td>
							<td class="<?php echo $c['day_0_22']; ?>">22</td>
							<td class="<?php echo $c['day_0_23']; ?>">23</td>
							<td class="cr <?php echo $c['day_0_24']; ?>">24</td>
						</tr>
						<tr class="cb">
							<td class="<?php echo $c['day_0_25']; ?>">25</td>
							<td class="<?php echo $c['day_0_26']; ?>">26</td>
							<td class="<?php echo $c['day_0_27']; ?>">27</td>
							<td class="<?php echo $c['day_0_28']; ?>">28</td>
							<td class="<?php echo $c['day_0_29']; ?>">29</td>
							<td class="<?php echo $c['day_0_30']; ?>">30</td>
							<td class="cr <?php echo $c['day_0_31']; ?>">31</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td class="cz"/>
				<td valign="top" align="center" class="cbm cba cbo">
				<table cellspacing="0" cellpadding="2" border="0" class="ca ca1">
					<tbody>
						<tr class="cl">
							<td class="brown">Mo</td>
							<td class="brown">Tu</td>
							<td class="brown">We</td>
							<td class="brown">Th</td>
							<td class="brown">Fr</td>
							<td class="brown">Sa</td>
							<td class="cr brown">Su</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_1_1']; ?>">1</td>
							<td class="<?php echo $c['day_1_2']; ?>">2</td>
							<td class="<?php echo $c['day_1_3']; ?>">3</td>
							<td class="<?php echo $c['day_1_4']; ?>">4</td>
							<td class="<?php echo $c['day_1_5']; ?>">5</td>
							<td class="<?php echo $c['day_1_6']; ?>">6</td>
							<td class="cr <?php echo $c['day_1_7']; ?>">7</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_1_8']; ?>">8</td>
							<td class="<?php echo $c['day_1_9']; ?>">9</td>
							<td class="<?php echo $c['day_1_10']; ?>">10</td>
							<td class="<?php echo $c['day_1_11']; ?>">11</td>
							<td class="<?php echo $c['day_1_12']; ?>">12</td>
							<td class="<?php echo $c['day_1_13']; ?>">13</td>
							<td class="cr <?php echo $c['day_1_14']; ?>">14</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_1_15']; ?>">15</td>
							<td class="<?php echo $c['day_1_16']; ?>">16</td>
							<td class="<?php echo $c['day_1_17']; ?>">17</td>
							<td class="<?php echo $c['day_1_18']; ?>">18</td>
							<td class="<?php echo $c['day_1_19']; ?>">19</td>
							<td class="<?php echo $c['day_1_20']; ?>">20</td>
							<td class="cr <?php echo $c['day_1_21']; ?>">21</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_1_22']; ?>">22</td>
							<td class="<?php echo $c['day_1_23']; ?>">23</td>
							<td class="<?php echo $c['day_1_24']; ?>">24</td>
							<td class="<?php echo $c['day_1_25']; ?>">25</td>
							<td class="<?php echo $c['day_1_26']; ?>">26</td>
							<td class="<?php echo $c['day_1_27']; ?>">27</td>
							<td class="cr <?php echo $c['day_1_28']; ?>">28</td>
						</tr>
						<tr class="cb">
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="cr brown"></td>
						</tr>
					</tbody>
				</table>
			</td>
			<td class="cz"/>
			<td valign="top" align="center" class="cbm cba cbo">
				<table cellspacing="0" cellpadding="2" border="0" class="ca ca1">
					<tbody>
						<tr class="cl">
							<td class="brown">Mo</td>
							<td class="brown">Tu</td>
							<td class="brown">We</td>
							<td class="brown">Th</td>
							<td class="brown">Fr</td>
							<td class="brown">Sa</td>
							<td class="cr brown">Su</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_2_1']; ?>">1</td>
							<td class="<?php echo $c['day_2_2']; ?>">2</td>
							<td class="<?php echo $c['day_2_3']; ?>">3</td>
							<td class="<?php echo $c['day_2_4']; ?>">4</td>
							<td class="<?php echo $c['day_2_5']; ?>">5</td>
							<td class="<?php echo $c['day_2_6']; ?>">6</td>
							<td class="cr <?php echo $c['day_2_7']; ?>">7</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_2_8']; ?>">8</td>
							<td class="<?php echo $c['day_2_9']; ?>">9</td>
							<td class="<?php echo $c['day_2_10']; ?>">10</td>
							<td class="<?php echo $c['day_2_11']; ?>">11</td>
							<td class="<?php echo $c['day_2_12']; ?>">12</td>
							<td class="<?php echo $c['day_2_13']; ?>">13</td>
							<td class="cr <?php echo $c['day_2_14']; ?>">14</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_2_15']; ?>">15</td>
							<td class="<?php echo $c['day_2_16']; ?>">16</td>
							<td class="<?php echo $c['day_2_17']; ?>">17</td>
							<td class="<?php echo $c['day_2_18']; ?>">18</td>
							<td class="<?php echo $c['day_2_19']; ?>">19</td>
							<td class="<?php echo $c['day_2_20']; ?>">20</td>
							<td class="cr <?php echo $c['day_2_21']; ?>">21</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_2_22']; ?>">22</td>
							<td class="<?php echo $c['day_2_23']; ?>">23</td>
							<td class="<?php echo $c['day_2_24']; ?>">24</td>
							<td class="<?php echo $c['day_2_25']; ?>">25</td>
							<td class="<?php echo $c['day_2_26']; ?>">26</td>
							<td class="<?php echo $c['day_2_27']; ?>">27</td>
							<td class="cr <?php echo $c['day_2_28']; ?>">28</td>
						</tr>
						<tr class="cb">
							<td class="<?php echo $c['day_2_29']; ?>">29</td>
							<td class="<?php echo $c['day_2_30']; ?>">30</td>
							<td class="<?php echo $c['day_2_31']; ?>">31</td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="cr brown"></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>

<!-- END CALENDAR -->
</div>
	<?php include("footer.php"); ?>
</div>

</body>

</html>