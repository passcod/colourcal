<?php ob_start();
?>
function editCal()
{
	$('#login_form').children().remove();
	$('#login_form').prepend('<p style=\"font-weight: bold; background-color: red;\">Wrong password - <a onclick=\"location.reload(true);\">try again</a></p>');
}
<?php
$bad_script = ob_get_clean();
?>