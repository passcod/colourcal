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
		
		$("#calendar_form").append('<input id="submit-calendar" type="button" value="Save" onclick="submitCal()" /><br /><a onclick="location.reload(true);">cancel - logout</a><br /><a onclick="showControls()" style="size: x-small">Control (experimental)</a>');
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
	var colors_str = colors[0] + ':' + color_codes[0];
	for( i in colors )
	{
		if( i != 0 )
		{
		colors_str = colors_str + '|' + colors[i] + ':' + color_codes[i];
		}
	}
	
	$.post(page_self+'?colors='+colors_str, params, function(data) {}, 'text');
}

function showControls()
{	
	$.getScript(page_self+'?data=uijs', function() {
		$.get(page_self+'?data=uicss', function(css) {
			$('head').append('<style type="text/css">'+css+"\n\n"+
			"#controls-colours-list { list-style-type: none; margin: 0; padding: 0; }\n"+
			"#controls-colours-list li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 0.8em; height: 15px; }\n"+
			"#controls-buttons { float: right; }\n"+
			"#controls-buttons button * { font-size: 1em; height: 1.1em; margin: 0; padding: 0.2em; }\n"+
			'</style>');
			$('body').append('<div id="controls" style="display: none;"></div>');
			
			var tabs_str = ""+
			"<div id='tabs'>\n"+
			"	<ul>\n"+
			"		<li><a href='#tabs-1'>Colours</a></li>\n"+
			"		<li><a href='#tabs-2'>About</a></li>\n"+
			"	</ul>\n"+
			"	<div id='tabs-1'>\n"+
			"		<p>Available colours:</p>\n"+
			"		<ul id='controls-colours-list'>\n"+
			"		</ul>\n"+
			"		<button id='controls-colours-add'>Add a colour</button>\n"+
			"	</div>\n"+
			"	<div id='tabs-2'>\n"+
			"		<p>ColourCal is a project by: passcod</p>\n"+
			"		<p><a href='http://colourcal.sourceforge.net'>http://colourcal.sourceforge.net</a></p>\n"+
			"	</div>\n"+
			"<div id='controls-buttons'>\n"+
			"	<button id='controls-save'>Save</button>\n"+
			"	<button id='controls-cancel'>Cancel</button>\n"+
			"</div>\n"+
			"</div>";
			
			var ctrl = $('#controls');
			ctrl.html(tabs_str);
			
			var tabs = ctrl.find('#tabs');
			tabs.tabs();
			
			var colours_list = ctrl.find('#controls-colours-list');
			
			for( i in colors )
			{
				colours_list.append('<li class="ui-state-default">'+colors[i]+' - #'+color_codes[i]+' - <span style="background-color: #'+color_codes[i]+'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="float: right"><a class="controls-colours-edit">Edit</a> <a class="controls-colours-remove">Remove</a></span></li>'+"\n");
			}
			
			colours_list.sortable();
			colours_list.disableSelection();
			
			ctrl.find('#controls-colours-add').button().click(function() {
				ctrl.append('<div id="controls-ni" style="display: none;">Not Implemented (yet).</div>');
				ctrl.find('#controls-ni').dialog();
			});
			ctrl.find('.controls-colours-edit').click(function() {
				ctrl.append('<div id="controls-ni" style="display: none;">Not Implemented (yet).</div>');
				ctrl.find('#controls-ni').dialog();
			});
			ctrl.find('.controls-colours-remove').click(function() {
				ctrl.append('<div id="controls-ni" style="display: none;">Not Implemented (yet).</div>');
				ctrl.find('#controls-ni').dialog();
			});
			
			ctrl.find('#controls-save').button().click(function() {
				ctrl.append('<div id="controls-ni" style="display: none;">Not Implemented (yet).</div>');
				ctrl.find('#controls-ni').dialog();
			});
			ctrl.find('#controls-cancel').button().click(function() {
				ctrl.dialog('close');
			});
			
			ctrl.dialog({ modal: true, title: "Controls", width: 600, maxHeight: 500 });
			
		});
	});
}

<?php $good_script = ob_get_clean(); ?>