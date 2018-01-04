var video = document.getElementById("video-player");
var vsource = document.createElement('vsource');
var vid= document.getElementById("video-player");
var video_stream= document.getElementById("video-player");

var canplaymp4 = video.canPlayType("video/mp4");
var canplayhls = video.canPlayType("application/x-mpegURL");
var canplaywebm = video.canPlayType("video/webm");

//var src_m4v = "";
var src_hls = "http://zeus.collectiveradio.com/ts/playlist.m3u8";
var src_webm = "http://apollo.collectiveradio.com:8000/live_video";

var type_m4v = "video/mp4";
var type_hls = "application/x-mpegURL";
var type_webm = "video/webm";

function srcVideo(){
vsource.setAttribute('src', '');
vid.appendChild(vsource);
vid.load();
	

if (canplaywebm=="maybe"){
vsource.setAttribute('src', src_webm);
vtype.setAttribute('type', type_webm);
}
	

if (canplayhls=="maybe"){
vsource.setAttribute('src', src_hls);
vtype.setAttribute('type', type_hls);
}
	
	
vid.appendChild(vsource);
vid.appendChild(vtype);
vid.load();
}

window.onbeforeunload = function(){
	if ( (video) && (!video.paused) ) {
		return 'Are you sure you want to leave?';
	}
};

video_stream.addEventListener('pause', srcVideo, false);