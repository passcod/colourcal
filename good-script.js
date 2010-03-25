<?php ob_start(); ?>
function editCal() {
	loadLibs();
	$('body').append('<span id="colourcal-data-store" style="width: 0px; height: 0px; display: none; visibility: hidden;"></span>');

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
		for ( i=0; i<12; i++ )
		{
			if ( $(ele).hasClass("month"+i) )
			{
				return ''+i;
			}
		}
		return false;
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
	$('head').append('<style type="text/css">'+
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
	"		<li><a href='#tabs-2'>Users</a></li>\n"+
	"		<li><a href='#tabs-3'>Months</a></li>\n"+
	"		<li><a href='#tabs-4'>About</a></li>\n"+
	"	</ul>\n"+
	"	<div id='tabs-1'>\n"+
	"		<p>Available colours:</p>\n"+
	"		<ul id='controls-colours-list'>\n"+
	"		</ul>\n"+
	"		<button id='controls-colours-add'>Add a colour</button>\n"+
	"	</div>\n"+
	"	<div id='tabs-2'>\n"+
	"		<p>This is not implemented yet</p>\n"+
	"		<p>Feature Coming Soon</p>\n"+
	"	</div>\n"+
	"	<div id='tabs-3'>\n"+
	"		<p>This is not implemented yet</p>\n"+
	"		<p>Feature Coming Soon</p>\n"+
	"	</div>\n"+
	"	<div id='tabs-4'>\n"+
	"		<p>ColourCal is a project by: passcod</p>\n"+
	"		<p><a href='http://colourcal.sourceforge.net'>http://colourcal.sourceforge.net</a></p>\n"+
	"	</div>\n"+
	"<div id='controls-buttons'>\n"+
	"	<button id='controls-save'>Save</button>\n"+
	"	<button id='controls-cancel'>Cancel</button>\n"+
	"</div>\n"+
	"</div>";
	//todo: implement users + months capabilities
	
	
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
	
	ctrl.find('#controls-colours-add').button().click(coloursAdd);
	ctrl.find('.controls-colours-edit').click(coloursEdit);
	ctrl.find('.controls-colours-remove').click(coloursRemove);
	
	ctrl.find('#controls-save').button().click(coloursSave);
	ctrl.find('#controls-cancel').button().click(function() {
		ctrl.dialog('close');
	});
	
	ctrl.dialog({ modal: true, title: "Controls", width: 600, maxHeight: 500 });
	
	//todo: implement those funcs.
	var coloursAdd = function() {
		$('body').append('<div id="controls-colours-add-dialog" style="display: none"></div>');
		var box = $('#controls-colours-add-dialog');
		
		box.append('<form></form>');
		
		$('#controls-colours-add-dialog-pick').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#controls-colours-add-dialog-pick').css('backgroundColor', '#' + hex);
			}
		});

	};
	
	var coloursEdit = function() {
		//
	};
	
	var coloursRemove = function() {
		//
	};
	
	var coloursSave = function() {
		//
	};
}


function loadLibs()
{
	$.getScript(page_self+'?data=uijs', function() {
		$.get(page_self+'?data=uicss', function(css) {
			$('head').append('<style type="text/css">'+css+'</style>');
			
			$.getScript(page_self+'?data=colorpickerjs', function() {
				return true;
			});
		});
	});
}

<?php $good_script = ob_get_clean(); ?>
