<?php

/**
 * Implementation of drupal_add_js()
 */

drupal_add_js(drupal_get_path('module', 'nhmrc_video_player') . '/js/scripts.js');

/**
 * Implementation of drupal_add_css()
 */

drupal_add_css(drupal_get_path('module', 'nhmrc_video_player') .'/css/styles.css');

$args = arg();

$node_type = "dating_irl"; // can find this on the node type's "edit" screen in the Drupal admin section.

$nid = db_query("SELECT nid FROM {node} WHERE status = 1 AND type = :type", array(':type' => $node_type))->fetchCol();

$nid = $nid[0];

$datingirl = node_load($nid);
$datingirl = objectToArray($datingirl);
$count = count($datingirl['field_videos']['und']);
$datingirl_body = $datingirl['body']['und'][0]['safe_value'];
$fid = $datingirl['field_poster']['und'][0]['fid'];
$file = file_load($fid);
$uri = $file->uri;
if (count($datingirl['field_poster']['und']>0)) {
  $poster = file_create_url($uri);
}

for ($x = 0; $x <= $count-1; $x++) {
  $firstnid = $datingirl['field_videos']['und'][0]['target_id'];
  $nids[]=$datingirl['field_videos']['und'][$x]['target_id'];
  //echo $datingirl['field_videos']['und'][$x]['target_id'];
}

$node1 = node_load($firstnid);
$node1 = objectToArray($node1);


$title_1 = $node1['title'];
$title2_1 = $node1['field_title2']['und'][0]['value'];
$video_url_1 = $node1['field_irlvideo']['und'][0]['value'];
$video_length_1 = $node1['field_irl_video_length']['und'][0]['value'];
$body_1 = $node1['body']['und'][0]['safe_value'];

$fid_1 = $node1['field_irlvideo_thumbnail']['und'][0]['fid'];
$file_1 = file_load($fid_1);
$uri_1 = $file_1->uri1;
if (count($node1['field_irlvideo_thumbnail']['und']>0)) {
  $image_url_1 = file_create_url($uri_1);
}

$nodes = node_load_multiple($nids);
$x=0;

$host = $_SERVER['HTTP_HOST'];

if(isset($_SERVER['HTTPS'])) {
  $http = 'https://';
} else {
  $http = 'http://';
}

foreach ($nodes as $node) {


  $node = objectToArray($node);

  $nid=($node['nid']);

  $title = $node['title'];
  $title2 = $node['field_title2']['und'][0]['value'];
  $video_url = $node['field_irlvideo']['und'][0]['value'];
  $video_length = $node['field_irl_video_length']['und'][0]['value'];
  $body = $node['body']['und'][0]['safe_value'];

  $fid = $node['field_irlvideo_thumbnail']['und'][0]['fid'];
  $file = file_load($fid);
  $uri = $file->uri;
  if (count($node['field_irlvideo_thumbnail']['und']>0)) {
    $image_url = file_create_url($uri);
  }

  $image_alt = $node['field_irlvideo_thumbnail']['und'][0]['alt'];


  if ($node['nid']==$firstnid){
    $focus = 'focus';
  } else {
    $focus = '';
  }

  $playlist[] = [
    'nodeID' => $nid,
    'video_url' => $video_url,
    'curNum' => $x,
  ];



  $output .= <<<EOHTML
<div class="row video-list videoID"  data-id="$nid" data-url='$video_url' data-index="$x" >
    <div class="video-list-col-left">
        <div class="video-margin "  ><img src="$image_url" class="video-image $focus"></div>
    </div>
    <div class="video-list-col-right" >
        <div id="irl_video_title" class="video-text-bold">$title</div>
        <div id="irl_video_title2" class="video-text-normal">$title2</div>
        <div id="irl_video_length" class="video-text-normal">$video_length</div>
    </div>
</div>
EOHTML;
  $x++;
}
$playlist = json_encode($playlist);
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.7.3/video-js.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.7.3/video.min.js"></script>
<script src="/sites/all/modules/nhmrc_video_player/videojs/dist/Youtube.js"></script>


<!--https://github.com/videojs/video.js-->
<section style="min-height:auto;">
    <div class="row video-container-height">

        <div class="video-container-col-left" >
            <div class="video-container">

                <video
                        id="vid1"
                        class="video-js vjs-default-skin video-iframe"
                        controls
                        width="630"
                        height="318"
                >
                </video>

            </div>
        </div>


        <div class="video-container-col-right" style="position:relative;">
            <div id="dating_irl_div"><span id="dating_irl">Dating IRL</span>
                <span id="autoplay_text"> Autoplay </span> <span id="autoplayVal" style="font-weight:bold">(Yes)</span>
                <label class="switch" style="float:right">
                    <input type="checkbox" id="autoPlay" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="video-list-container" style="overflow-y: auto;" >
              <?php echo $output; ?>
            </div>
        </div>

    </div>
</section>

<section class="irl-video-container">
    <div class="irl-video-body" id="irl_video_body">
        <div class="col" id="results"><?php echo $datingirl_body; ?></div>
    </div>
</section>


<script>

  var vidURL = 'https://www.youtube.com/watch?v=<?php echo $video_url_1; ?>';
  var vgsPlayer;
  sessionStorage.setItem("curIndex", "0");
  var playlist = <?php echo $playlist; ?>;
  sessionStorage.setItem("default", '1');
  var firstNid = '<?php echo $firstnid; ?>';
  var poster = '<?php echo $poster; ?>';

  vgsPlayer = videojs('vid1');
  vgsPlayer.src({
    "type": "video/youtube",
    "src": vidURL
  });
  if (poster) vgsPlayer.poster(poster);

  vgsPlayer.on('ended', function() {
    var isChecked = jQuery('#autoPlay').prop('checked');

    if (isChecked===true) {
      onendedTODO(playlist);
    }

  });

  vgsPlayer.on('play', function() {

    if (sessionStorage.getItem("default")==='1') {
      do_ajax(firstNid);
    }

  });


  jQuery("#autoPlay").change(function(){
    var isChecked = jQuery('#autoPlay').prop('checked');

    if (isChecked===true) {
      jQuery("#autoplayVal").html('(Yes)');
    }
    if (isChecked===false) {
      jQuery("#autoplayVal").html('(No)');
    }

  });

  jQuery(".videoID").click(function(){

    var vidURL = jQuery(this).attr("data-url");
    var nid = jQuery(this).attr("data-id");
    var curIndex  = jQuery(this).attr("data-index");
    sessionStorage.setItem("curIndex", curIndex);
    jQuery(".focus").removeClass("focus");
    jQuery(this).find('.video-image').addClass('focus');

    if (sessionStorage.getItem("default")==='1') {
      vgsPlayer.play();
    }

    sessionStorage.setItem("default", '0');

    do_ajax(nid);

    vsgLoadVideo('https://www.youtube.com/watch?v='+vidURL);

  });




  function vsgLoadVideo(vidURL) {

    var playlist1 = <?php echo $playlist; ?>

    vgsPlayer.src({
      "type": "video/youtube",
      "src": vidURL
    });
    vgsPlayer.play();

  }

  function onendedTODO(playlist){

    var nextID = '';
    var nextURL = '';
    var nextindex = '';

    var count = sessionStorage.getItem("curIndex");


    nextindex = parseInt(count) + 1;
    sessionStorage.setItem("curIndex", nextindex);
    sessionStorage.setItem("default", '0');

    jQuery.each(playlist, function( i, obj ) {
      if (obj.curNum===nextindex){
        nextID = obj.nodeID;
        nextURL = obj.video_url;
        jQuery(".focus").removeClass("focus");
        jQuery('.video-list').eq( nextindex ).find('.video-image').addClass('focus');
        do_ajax(nextID);
        vsgLoadVideo('https://www.youtube.com/watch?v='+nextURL);
      }


    });





  }


  function do_ajax(nid) {


    jQuery.ajax({
      async: true,
      type: "POST",
      url: "/video_player/get_body/",
      data: {query: nid},
      cache: false,
      success: function (data) {
        jQuery("#results").html(data);
      }
    });

  }
</script>
