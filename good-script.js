<?php ob_start(); ?>
function editCal() {
	function getColor(ele)
	{
		ele = $(ele);
		
		for ( c in colors )
		{
			if ( ele.hasClass(colors[c]) ) { return colors[c]; }
		}
		
		return false;
	}
	
	function getMonth(ele)
	{
		ele = $(ele);
		
		if ( ele.hasClass("month0") ) { return "0"; }
		else if ( ele.hasClass("month1") ) { return "1"; }
		else if ( ele.hasClass("month2") ) { return "2"; }
		else { return false; }
	}
	
	
	$(document).ready(function() {
		$('#login_form').remove();
		$("#mct1 > tbody").append('<tr><td><form id="calendar_form" action="#" method="post"></form></td></tr>');
		$(".ca1").each(function(i) { $(this).find("td").addClass("month"+i); });
		$(".ca1 td").each(function() {
			if ( /[1-9]{1,2}/i.test( $(this).html() ) )
			{
				var val = getColor(this);
				var name = "day_" + getMonth(this) + "_" + $(this).text();
				$(this).attr("name", name);
				$("#calendar_form").append('<input type="hidden" name="'+name+'" value="'+val+'" id="calendar_input_'+name+'" />');
				
				$(this).attr("onclick", "changeColour(this)");
			}
		});
		
		$("#calendar_form").append('<input id="submit-calendar" type="button" value="Save" onclick="submitCal()" /><br /><a onclick="location.reload(true);">cancel - logout</a><br /><a onclick="showModifier()" style="size: x-small">Modify colours (experimental)</a>');
	});
}

function changeColour(el)
{
	var t = $(el);
	var i = "calendar_input_"+t.attr("name");
	
	for ( c in colors )
	{
		c = parseInt(c);
		d = ( c+1 < colors.length ) ? c+1 : 0;
		if ( t.hasClass(colors[c]) )
		{
			$('#'+i).val(colors[d]);
			t.removeClass(colors[c]);
			t.addClass(colors[d]);
			return;
		}
	}
}

function submitCal()
{
	var params = $('#calendar_form').serializeArray();
	$.post(page_self, params, function(data) {}, 'text');
}

function showModifier()
{	
	$.getScript(page_self+'?data=blockui', function() {
		$.blockUI({
			message: '<h1>Not Implemented</h1>',
		});
		$('.blockOverlay').attr('title','Click to return to page.').click($.unblockUI);
	});
}

<?php $good_script = ob_get_clean(); ?>