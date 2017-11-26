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
	
	
	$(function() {
		$('#login_form').remove();
		$("#mct1 > tbody").append('<tr><td><form id="calendar_form" method="post" action="#"></form></td></tr>');
		$(".ca1").each(function(i) { $(this).find("td").addClass("month"+i); });
		$(".ca1 td").each(function() {
			if ( /[1-9]{1,2}/i.test( $(this).html() ) )
			{
				var val = getColor(this);
				var name = "day_" + getMonth(this) + "_" + $(this).text();
				$(this).attr("name", name);
				$("#calendar_form").append('<input type="hidden" name="'+name+'" value="'+val+'" id="calendar_input_'+name+'" />');
			}
		});
		$('.ca1 td').click(changeColour);
		
		$("#calendar_form").append('<button id="submit-calendar">Save</button><span id="cc-status" style="font-size: small">Loaded</span><br /><a href="javascript:location.reload(true);">exit</a>&nbsp;<a id="new_cal_button">new calendar</a>');
		$('#submit-calendar').click(submitCal);
		$('#new_cal_button').click(clickNewCal);
	});
}

function clickNewCal()
{
	var m=window.prompt('Starting Month? (1-12)');
	newCal(m,2010);	
}

function changeColour()
{
	var t = $(this);
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
	$.post(page_self, params, function(data) {
		$('#cc-status').text('written '+data+' bytes');
	}, 'text');
	return false;
}

// ##### //

function newCal(startMonth, startYear)
{
	var t = new Date( Date.parse(startMonth+' 1 '+startYear) );
	var cal = Array();
	for ( i = 0; i < 3; i++ )
	{
		cal[i] = Array();
		var j = true;
		var day = 0;
		while ( j )
		{
			t.setDate(day+1);
			var test = startMonth-1+i;
			if ( test == 12 ) { test = 0; } else if ( test == 13 ) { test = 1; }
			if ( t.getMonth() != test ) { j = false; }
			else
			{
				var N = t.getDay()-1;
				if ( N == -1 ) { N = 6; }
				var S = t.getTime();
				
				cal[i][day] = {
					'weekday': N,
					'timestamp': S
				};
				day++;
			}
		}
	}
	
	
	var week_cal = Array();
	for ( y = 0; y < 3; y++ )
	{
		week_cal[y] = Array();
		var j = true;
		var w = 0;
		var x = 0;
		while ( j )
		{
			week_cal[y][w] = Array();
			for ( i = 0; i < 7; i++ )
			{
				if ( cal[y][x] != undefined )
				{
					if ( cal[y][x].weekday == i )
					{
						week_cal[y][w][i] = x;
						x++;
					}
					else
					{
						week_cal[y][w][i] = null;
					}
				}
			}
			w++;
			if ( x >= cal[y].length ) { j = false; }
		}
	}
	
	
	var monthNames = [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'September',
		'October',
		'November',
		'December'
	];
	
	
	$('#mct1').html('<tbody><tr id="monthshead"></tr><tr id="monthsbody"></tr></tbody>');
	$('#monthshead').append('<th>'+monthNames[startMonth-1]+'</th><td class="cz"></td><th>'+monthNames[startMonth]+'</th><td class="cz"></td><th>'+monthNames[startMonth-(-1)]+'</th>');
	console.log(startMonth+1);
	var nC = $('#monthsbody');
	for ( i = 0; i < 3; i++ )
	{
		nC.append('<td align="center" valign="top" class="brown cbm cba cbo"><table cellspacing="0" cellpadding="2" border="0" class="ca ca1"><tbody><tr class="cl"><th class="brown">Mo</th><th class="brown">Tu</th><th class="brown">We</th><th class="brown">Th</th><th class="brown">Fr</th><th class="brown">Sa</th><th class="brown cr">Su</th></tr></tbody></table></td><td class="cz"></td>');
		var nM = $("#monthsbody > td[class*='cbm']:last > table > tbody");
		for ( j in week_cal[i] )
		{
			nM.append('<tr></tr>');
			for ( k in week_cal[i][j] )
			{
				if ( week_cal[i][j][k] == null )
				{
					nM.find('tr:last').append('<td class="brown"></td>');
				}
				else
				{
					nM.find('tr:last').append('<td class="yellow">'+(week_cal[i][j][k]+1)+'</td>');
				}
				if ( k == 6 ) { nM.find('tr:last > td:last').addClass('cr'); }
				if ( k == 5 || k == 6 ) { nM.find('tr:last > td:last').removeClass('yellow'); nM.find('tr:last > td:last').addClass('green'); }
			}
		}
	}
}
<?php $good_script = ob_get_clean(); ?>
