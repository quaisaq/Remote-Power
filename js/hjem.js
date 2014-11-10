var sockets = new Array(false, false, false, false, false);
var canvas = null;
var ctx = null;
var canvasSize = new Array(0, 0);
var rectSizes = new Array(new Array(0,0,233,139), new Array(0,281,232,466), new Array(328,281,559,466), new Array(0,140,403,280), new Array(234,0,403,140), new Array(404,0,560,280));
var rectIndexes = new Array(0, 1, 2, 3, 3, 4);

$(function(){
	canvas = document.getElementById('grundplansCanvas');
	ctx = canvas.getContext('2d');

	var mids = '<img src="images/sideimg-left-mid.png">';
	for (var i = 1; i < Math.ceil(($('#innerback').height() - 280) / 300); i++)
		mids += '<img src="images/sideimg-left-mid.png">';
	$('#leftfloater .mids').html(mids);
	$('#rightfloater .mids').html(mids.replace(/\-left\-/gi, "-right-"));
	
	$('header .nav').css('margin-left', -$('header .nav').width() / 2).css('left', '50%');
	
	$('img.house').width($('#innerback').width());
	setTimeout(function(){
		canvasSize = new Array($('img.house').width(), $('img.house').height());
		$('#grundplansCanvas').attr('width', canvasSize[0]).attr('height', canvasSize[1]);
		
		for (var i = 0; i < 5; i++)
			drawSocket(i);
	}, 10);
	
	$('map#house').children().each(function(){
		var s = "";
		for (var i = 0; i < 4; i++)
			s += "," + rectSizes[$(this).index()][i];
		$(this).attr('coords', s.substring(1));
	});
	
});

function toggleSocket(i){
	var toggleTo = !sockets[i];
	$.get('toggleSocket.php?area=' + i + '=' + (toggleTo ? "1" : "0"), function(d){
		if (d == "OK") {
			sockets[i] = toggleTo;
			drawSocket(i);
		}
	});
	
}

function drawSocket(i) {
	if (ctx != null) {
		var indexes = new Array();
		for (var l = 0; l < rectIndexes.length; l++)
			if (rectIndexes[l] == i)
				indexes.push(l);
		
		for (var l = 0; l < indexes.length; l++)
			ctx.clearRect(rectSizes[indexes[l]][0], rectSizes[indexes[l]][1], rectSizes[indexes[l]][2] - rectSizes[indexes[l]][0], rectSizes[indexes[l]][3] - rectSizes[indexes[l]][1]);
		
		ctx.fillStyle = sockets[i] ? "#6ff76d" : "#bfbfbf";
		for (var l = 0; l < indexes.length; l++)
			ctx.fillRect(rectSizes[indexes[l]][0], rectSizes[indexes[l]][1], rectSizes[indexes[l]][2] - rectSizes[indexes[l]][0], rectSizes[indexes[l]][3] - rectSizes[indexes[l]][1]);
	}
}