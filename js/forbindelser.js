var mouseDown = 0;
var mouseDownCoor = 0;
var lastClick = new Array();
var startDrag = 0;
var sockets = new Array(false, false, false, false, false);

$(function(){
	for (var i = 0; i < $('#innerback .socket').length; i++) {
		lastClick.push(new Date().getTime() - 1000);
	}
	
	var mids = '<img src="images/sideimg-left-mid.png">';
	for (var i = 1; i < Math.ceil(($('#innerback').height() - 280) / 300); i++)
		mids += '<img src="images/sideimg-left-mid.png">';
	$('#leftfloater .mids').html(mids);
	$('#rightfloater .mids').html(mids.replace(/\-left\-/gi, "-right-"));
	
	$('header ul').css('margin-left', -$('header ul').width() / 2).css('left', '50%');
	
	$('#innerback .socket .toggler').mousedown(function(e){
		var md = $(this).parent().parent().index();
		if (lastClick[md - 1] + 1000 < new Date().getTime()) {
			mouseDown = md;
			startDrag = parseInt($(this).css('left'));
			mouseDownCoor = e.clientX - startDrag;
			console.log(md);
		}
	});
	$('#innerback .socket .onoff').mousedown(function(){ return false; });
	$(document).mouseup(function(e){
		if (mouseDown) {
			var toggler = $('#innerback .socket:eq(' + (mouseDown - 1) + ') .toggler');
			var max = toggler.parent().width() - toggler.width();
			var md = mouseDown - 1;
			toggler.css('transition', 'left .25s');
			
			if (startDrag == parseInt(toggler.css('left'))) {
				var toggleTo = (parseInt(toggler.css('left')) < max / 2);
				$.post("toggleSocket.php", "area=" + md + '=' + (toggleTo ? 
				'1' : '0'), function(d){
					if (d == "OK") {
						if (toggleTo) {
							toggler.css('left', max - 1);
							toggler.parent().css('background', '#46FF3E');
						}
						else {
							toggler.css('left', -1);
							toggler.parent().css('background', '#fafafa');
						}
					}
				});
			}
			else {
				var toggleTo = (parseInt(toggler.css('left')) < max / 2);
				$.post("toggleSocket.php", "area=" + md + '=' + (toggleTo ? 
				'1' : '0'), function(d){
					if (d == "OK") {
						if (toggleTo) {
							toggler.css('left', -1);
							toggler.parent().css('background', '#fafafa');
						}
						else {
							toggler.css('left', max - 1);
							toggler.parent().css('background', '#46FF3E');
						}
					}
				});
			}
			
			setTimeout(function(){
				toggler.css('transition', 'none');
				
				if ((parseInt(toggler.css('left')) == -1 && sockets[md]) || (parseInt(toggler.css('left')) == max - 1 && !sockets[md])) {
					sockets[md] = !sockets[md];
					lastClick[md] = new Date().getTime();
				}
			}, 300);
		}
		mouseDown = 0;
	});
	$(document).mousemove(function(e){
		if (mouseDown) {
			var toggler = $('#innerback .socket:eq(' + (mouseDown - 1) + ') .toggler');
			var max = toggler.parent().width() - toggler.width() - 1;
			var moveCoor = e.clientX - mouseDownCoor;
			
			if (moveCoor < -1)
				moveCoor = -1;
			if (moveCoor > max)
				moveCoor = max;
			
			toggler.css('left', moveCoor);
			return false;
		}
	});
			});