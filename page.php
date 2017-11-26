<?php if ( $c != 'notloaded' ) { ?>


<?php ob_start(); ?>
<link rel="stylesheet" type="text/css" href="calendar.css" />

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var page_self = "<?php echo $_SERVER['PHP_SELF']; ?>";

var colors = Array();
colors[0] = "red";
colors[1] = "yellow";
colors[2] = "green";

$(function() {
	$('#mct1').after("<a id='cc_init_link' style='color: #283939; font-size: x-small'>edit</a>");
	var ccil = $('#cc_init_link');
	ccil.click(function() {
		loadEdit();
		ccil.remove();
	});
});

function loadEdit()
{
	$('#mct1').after('<div id="login_form" style="font-family: sans-serif;"><span style="font-size: small;">Password: </span><input type="password" name="pass" class="pass" /><button id="butcont">Continue</button></div>');
	$('#butcont').click(loginCal);
	$('#login_form input.pass').focus().keypress(function(e) {
		if ( e.keyCode == 13 ) { loginCal(); }
	});
}

function loginCal()
{
	$.getScript('md5.jquery.js', function() {
		var param = $.md5( $('#login_form input.pass').val() );
		$("body").data('pass', param);
		$.getScript(page_self+'?data=script&pass='+param, function() { editCal(); });
	});
}
</script>
<?php $output_head_section = ob_get_clean(); ?>


<?php ob_start(); ?>
<!-- BEGIN CALENDAR -->

<table cellspacing="0" cellpadding="4" border="0" align="center" class="ct1 cl2 cp4 cc9 cd1 cf3 ci8 cu3 cj1" id="mct1">
	<tbody>
		<tr>
			<th>March</th>
			<td class="cz"></td>
			<th>April</th>
			<td class="cz"></td>
			<th>May</th>
		</tr>
		<tr>
			<td align="center" valign="top" class="cbm cba cbo">
				<table cellspacing="0" cellpadding="2" border="0" class="ca ca1">
					<tbody>
						<tr class="cl">
							<td class="brown">Mo</td>
							<td class="brown">Tu</td>
							<td class="brown">We</td>
							<td class="brown">Th</td>
							<td class="brown">Fr</td>
							<td class="brown">Sa</td>
							<td class="brown cr">Su</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_0_1']; ?>">1</td>
							<td class="<?php echo $c['day_0_2']; ?>">2</td>
							<td class="<?php echo $c['day_0_3']; ?>">3</td>
							<td class="<?php echo $c['day_0_4']; ?>">4</td>
							<td class="<?php echo $c['day_0_5']; ?>">5</td>
							<td class="<?php echo $c['day_0_6']; ?>">6</td>
							<td class="<?php echo $c['day_0_7']; ?> cr">7</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_0_8']; ?>">8</td>
							<td class="<?php echo $c['day_0_9']; ?>">9</td>
							<td class="<?php echo $c['day_0_10']; ?>">10</td>
							<td class="<?php echo $c['day_0_11']; ?>">11</td>
							<td class="<?php echo $c['day_0_12']; ?>">12</td>
							<td class="<?php echo $c['day_0_13']; ?>">13</td>
							<td class="<?php echo $c['day_0_14']; ?> cr">14</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_0_15']; ?>">15</td>
							<td class="<?php echo $c['day_0_16']; ?>">16</td>
							<td class="<?php echo $c['day_0_17']; ?>">17</td>
							<td class="<?php echo $c['day_0_18']; ?>">18</td>
							<td class="<?php echo $c['day_0_19']; ?>">19</td>
							<td class="<?php echo $c['day_0_20']; ?>">20</td>
							<td class="<?php echo $c['day_0_21']; ?> cr">21</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_0_22']; ?>">22</td>
							<td class="<?php echo $c['day_0_23']; ?>">23</td>
							<td class="<?php echo $c['day_0_24']; ?>">24</td>
							<td class="<?php echo $c['day_0_25']; ?>">25</td>
							<td class="<?php echo $c['day_0_26']; ?>">26</td>
							<td class="<?php echo $c['day_0_27']; ?>">27</td>
							<td class="<?php echo $c['day_0_28']; ?> cr">28</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_0_29']; ?>">29</td>
							<td class="<?php echo $c['day_0_30']; ?>">30</td>
							<td class="<?php echo $c['day_0_31']; ?>">31</td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown cr"></td>
						</tr>
						<tr class="cb">
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown cr"></td>
						</tr>
					</tbody>
				</table>
			</td>
			<td class="cz"></td>
			<td align="center" valign="top" class="cbm cba cbo">
				<table cellspacing="0" cellpadding="2" border="0" class="ca ca1">
					<tbody>
						<tr class="cl">
							<td class="brown">Mo</td>
							<td class="brown">Tu</td>
							<td class="brown">We</td>
							<td class="brown">Th</td>
							<td class="brown">Fr</td>
							<td class="brown">Sa</td>
							<td class="brown cr">Su</td>
						</tr>
						<tr>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="<?php echo $c['day_1_1']; ?>">1</td>
							<td class="<?php echo $c['day_1_2']; ?>">2</td>
							<td class="<?php echo $c['day_1_3']; ?>">3</td>
							<td class="<?php echo $c['day_1_4']; ?> cr">4</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_1_5']; ?>">5</td>
							<td class="<?php echo $c['day_1_6']; ?>">6</td>
							<td class="<?php echo $c['day_1_7']; ?>">7</td>
							<td class="<?php echo $c['day_1_8']; ?>">8</td>
							<td class="<?php echo $c['day_1_9']; ?>">9</td>
							<td class="<?php echo $c['day_1_10']; ?>">10</td>
							<td class="<?php echo $c['day_1_11']; ?> cr">11</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_1_12']; ?>">12</td>
							<td class="<?php echo $c['day_1_13']; ?>">13</td>
							<td class="<?php echo $c['day_1_14']; ?>">14</td>
							<td class="<?php echo $c['day_1_15']; ?>">15</td>
							<td class="<?php echo $c['day_1_16']; ?>">16</td>
							<td class="<?php echo $c['day_1_17']; ?>">17</td>
							<td class="<?php echo $c['day_1_18']; ?> cr">18</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_1_19']; ?>">19</td>
							<td class="<?php echo $c['day_1_20']; ?>">20</td>
							<td class="<?php echo $c['day_1_21']; ?>">21</td>
							<td class="<?php echo $c['day_1_22']; ?>">22</td>
							<td class="<?php echo $c['day_1_23']; ?>">23</td>
							<td class="<?php echo $c['day_1_24']; ?>">24</td>
							<td class="<?php echo $c['day_1_25']; ?> cr">25</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_1_26']; ?>">26</td>
							<td class="<?php echo $c['day_1_27']; ?>">27</td>
							<td class="<?php echo $c['day_1_28']; ?>">28</td>
							<td class="<?php echo $c['day_1_29']; ?>">29</td>
							<td class="<?php echo $c['day_1_30']; ?>">30</td>
							<td class="brown"></td>
							<td class="brown cr"></td>
						</tr>
						<tr class="cb">
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown cr"></td>
						</tr>
					</tbody>
				</table>
			</td>
			<td class="cz"></td>
			<td align="center" valign="top" class="cbm cba cbo">
				<table cellspacing="0" cellpadding="2" border="0" class="ca ca1">
					<tbody>
						<tr class="cl">
							<td class="brown">Mo</td>
							<td class="brown">Tu</td>
							<td class="brown">We</td>
							<td class="brown">Th</td>
							<td class="brown">Fr</td>
							<td class="brown">Sa</td>
							<td class="brown cr">Su</td>
						</tr>
						<tr>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="<?php echo $c['day_2_1']; ?>">1</td>
							<td class="<?php echo $c['day_2_2']; ?> cr">2</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_2_3']; ?>">3</td>
							<td class="<?php echo $c['day_2_4']; ?>">4</td>
							<td class="<?php echo $c['day_2_5']; ?>">5</td>
							<td class="<?php echo $c['day_2_6']; ?>">6</td>
							<td class="<?php echo $c['day_2_7']; ?>">7</td>
							<td class="<?php echo $c['day_2_8']; ?>">8</td>
							<td class="<?php echo $c['day_2_9']; ?> cr">9</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_2_10']; ?>">10</td>
							<td class="<?php echo $c['day_2_11']; ?>">11</td>
							<td class="<?php echo $c['day_2_12']; ?>">12</td>
							<td class="<?php echo $c['day_2_13']; ?>">13</td>
							<td class="<?php echo $c['day_2_14']; ?>">14</td>
							<td class="<?php echo $c['day_2_15']; ?>">15</td>
							<td class="<?php echo $c['day_2_16']; ?> cr">16</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_2_17']; ?>">17</td>
							<td class="<?php echo $c['day_2_18']; ?>">18</td>
							<td class="<?php echo $c['day_2_19']; ?>">19</td>
							<td class="<?php echo $c['day_2_20']; ?>">20</td>
							<td class="<?php echo $c['day_2_21']; ?>">21</td>
							<td class="<?php echo $c['day_2_22']; ?>">22</td>
							<td class="<?php echo $c['day_2_23']; ?> cr">23</td>
						</tr>
						<tr>
							<td class="<?php echo $c['day_2_24']; ?>">24</td>
							<td class="<?php echo $c['day_2_25']; ?>">25</td>
							<td class="<?php echo $c['day_2_26']; ?>">26</td>
							<td class="<?php echo $c['day_2_27']; ?>">27</td>
							<td class="<?php echo $c['day_2_28']; ?>">28</td>
							<td class="<?php echo $c['day_2_29']; ?>">29</td>
							<td class="<?php echo $c['day_2_30']; ?> cr">30</td>
						</tr>
						<tr class="cb">
							<td class="<?php echo $c['day_2_31']; ?>">31</td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown"></td>
							<td class="brown cr"></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>

<!-- END CALENDAR -->
<?php $output_body_section = ob_get_clean();

include('calendar.php');

 } ?>
