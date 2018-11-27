<?php

$hostname = gethostname();
if ($hostname=='zeus'){
    $variable = 'default';
} else {
    $variable = 'globalchange';
}


$node_type = "indicator"; // can find this on the node type's "edit" screen in the Drupal admin section.

$nids = db_query("SELECT nid FROM {node} WHERE status = 1 AND type = :type order by title ASC", array(':type' => $node_type))->fetchCol();

$nodes = node_load_multiple($nids);

$output = '<div class="section group">';
$count = 0;



foreach ($nodes as $node) {
    $node = gc_objectToArray($node);
    //$alias = drupal_get_path_alias('node/'.$node['nid']);
    $alias = 'browse/indicator-details/'.$node['nid'];

    $title = $node['title'];
    $tagline = $node['field_headline']['und'][0]['value'];


    $fid = $node['field_indicator_card']['und'][0]['fid'];
    $file = file_load($fid);
    $uri = $file->uri;
    if (count($node['field_indicator_card']['und']>0)) {
        $image_url = file_create_url($uri);
    }

    $image_alt = $node['field_indicator_image']['und'][0]['alt'];


        $output .= '
            <div class="catalog_column">
            <a href="/' . $alias . '" class="darken" >
                <div class="container gc_image_large">
                    <img src="' . $image_url . '" alt="' . $image_alt . '" style="" >
                          <div class="centered">
                          <div class="gc_image_title_large">' . $title . '</div>                           
                          <div class="gc_image_tagline_large">' . $tagline . '</div>
                          </div>
            </div>
            </a>
            </div>
            ';

$tagline = '';
$count ++;
}

?>

<link rel="stylesheet" href="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/css/styles.css" />

    <div class="region-content">
        <div class="outer">

                <div class="">
                    <nav class="breadcrumb" role="navigation">
                        <h2 class="breadcrumb__title">You are here</h2>
                        <ul class="breadcrumb__list">
                            <li class="breadcrumb__item">
                                <a href="/browse">Browse &amp; Find</a>
                            </li>
                            <li class="breadcrumb__item">
                                <a href="/browse/indicators">USGCRP Indicators</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div id="" class="">
                     <div class="">
                            <div class="contextual-links-region pane pane--service-links-service-links-not-node">
                                <h2 class="pane__title">Share</h2>
                                <div class="pane__content">
                                    <div class="service-links"><a href="http://www.facebook.com/sharer.php?u=http%3A//bit.ly/2z2ML9u&amp;t=" title="Share on Facebook" class="service-links-facebook" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/facebook.png" alt="Facebook logo" /></a> <a href="http://twitter.com/share?url=http%3A//bit.ly/2z2ML9u&amp;text=" title="Share this on Twitter" class="service-links-globalchange-twitter" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/twitter.png" alt="Twitter logo" /></a> <a href="https://plus.google.com/share?url=http%3A//bit.ly/2z2ML9u" title="Share this on Google+" class="service-links-google-plus" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/google_plus.png" alt="Google+ logo" /></a> <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A//bit.ly/2z2ML9u&amp;title=&amp;summary=&amp;source=GlobalChange.gov" title="Submit this post on LinkedIn" class="service-links-globalchange-linkedin" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/linkedin.png" alt="LinkedIn logo" /></a> <a href="http://reddit.com/submit?url=http%3A//bit.ly/2z2ML9u&amp;title=" title="Submit this post on reddit.com" class="service-links-globalchange-reddit" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/reddit.png" alt="Reddit logo" /></a>
                                    </div>
                                </div>
                            </div>
                     </div>
                </div>

            <div class="padding-top"></div>

                <div class="row">
                    <div class=""><h2>USGCRP Indicators</h2></div>
                </div>

                <div class="row center1 usgcrp_indicators_text">
                    Indicators are observations or calculations that can be used to track conditions and trends. Indicators related to climate—which may be physical, ecological, or societal—can be used to understand how environmental conditions are changing, assess risks and vulnerabilities, and help inform resiliency and planning for climate impacts.
                </div>

                <hr>

                <div style="text-align:center">

                    <div class="catalog_column_row">

                        <?php echo $output; ?>

                    </div>

                </div>
        </div>
    </div>


<div class="two_column_row">
    <div class="two_column col_left bottom_row_height">
        <div class="selected_usgrp_products">
            <div><h4 style="color:#fff;">Selected USGRP Products</h4></div>
            <ul class="selected_usgrp_products_ul">
                <li><a href="https://nca2014.globalchange.gov/" target="_blank" style="color:#fff">National Climate Assessment</a></li>
                <li><a href="https://www.globalchange.gov/sites/globalchange/files/USGCRP%20indicators_March2018-FINAL_Newsletter%20Version_23May18.pdf" target="_blank" style="color:#fff">USGRCP Indicators Fact Sheet</a> </li>
                <li><a href="https://science2017.globalchange.gov/" target="_blank" style="color:#fff">Climate Science Special Report</a> </li>
            </ul>
            </div>
        </div>
        <div class="two_column col_right bottom_row_height" >
        <div class="selected_usgrp_products">
            <div ><h4 style="color:#fff;">Indicator Announcements and Opportunities</h4></div>
            <ul class="selected_usgrp_products_ul">
                <li class="selected_usgrp_products_text">Upcoming Workshop on Social Indicators  </li>
                <li class="selected_usgrp_products_text">Arctic Observing Network</li>
                <li class="selected_usgrp_products_text">NOAA Funding Opportunities for Developing Indicators (FY19 NOAA/CPO/MAPP) </li>
            </ul>
        </div>
        </div>
</div>