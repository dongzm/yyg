$(document).ready(function(){
	$("#xuwanting").Jcrop({
		aspectRatio:1,
		setSelect:[160,160,0,0],
		onChange:showCoords,
		onSelect:showCoords
	});	
	function showCoords(obj){
		$("#x").val(obj.x);$("#y").val(obj.y);$("#w").val(obj.w);$("#h").val(obj.h);
		if(parseInt(obj.w) > 0){
			var rx = $("#w160").width() / obj.w; 
			var ry = $("#w160").height() / obj.h;
			$("#crop_preview").css({
				width:Math.round(rx * $("#xuwanting").width()) + "px",	
				height:Math.round(rx * $("#xuwanting").height()) + "px",	
				marginLeft:"-" + Math.round(rx * obj.x) + "px",
				marginTop:"-" + Math.round(ry * obj.y) + "px"
			});
			var rx2 = $("#w80").width() / obj.w; 
			var ry2 = $("#w80").height() / obj.h;
			$("#crop_preview2").css({
				width:Math.round(rx2 * $("#xuwanting").width()) + "px",	
				height:Math.round(rx2 * $("#xuwanting").height()) + "px",	
				marginLeft:"-" + Math.round(rx2 * obj.x) + "px",
				marginTop:"-" + Math.round(ry2 * obj.y) + "px"
			});
			var rx3 = $("#w30").width() / obj.w; 
			var ry3 = $("#w30").height() / obj.h;
			$("#crop_preview3").css({
				width:Math.round(rx3 * $("#xuwanting").width()) + "px",	
				height:Math.round(rx3 * $("#xuwanting").height()) + "px",
				marginLeft:"-" + Math.round(rx3 * obj.x) + "px",
				marginTop:"-" + Math.round(ry3 * obj.y) + "px"
			});
		}
	}
});