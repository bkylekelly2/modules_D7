<?php

$hostname = gethostname();
if ($hostname=='zeus'){
    $variable = 'default';
} else {
    $variable = 'globalchange';
}

$node_type = "featured_indicators"; // can find this on the node type's "edit" screen in the Drupal admin section.

$nid = db_query("SELECT nid FROM {node} WHERE type = :type", array(':type' => $node_type))->fetchCol();
$nodeID = $nid[0];
$catalog = "/browse/indicators";
$node = node_load_multiple($nid);

$image_caption = 'Long-term observations provide evidence of warming in the climate system and the effects of increasing atmospheric greenhouse gas concentrations. This figure shows several climate-relevant indicators of change based on data collected across the United States. (NCA4 Ch. 01b)';

if ( is_object( $node[$nodeID] ) ) {
    $node = get_object_vars($node[$nodeID]);
}

for ($x = 0; $x <= (count($node['field_featured_indicator']['und'])-1); $x++) {
    $featured_indicators [] = $node['field_featured_indicator']['und'][$x]['target_id'];
}

foreach ($featured_indicators as $nid) {
    $node = node_load($nid);

    if ( is_object( $node ) ) {
        $node = get_object_vars($node);
    }

    $title[]=$node['title'];
    $fid = $node['field_indicator_card']['und'][0]['fid'];
    $file = file_load($fid);
    $uri = $file->uri;
    if (count($node['field_indicator_card']['und']>0)) {
        $image_url[] = file_create_url($uri);
    }
    $tagline[] = $node['field_headline']['und'][0]['value'];
    $alias[] = "browse/indicator-details/".$nid;
    $image_alt = $node['field_indicator_image']['und'][0]['alt'];
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $("a[href^="#").on("click", function( e ) {

    e.preventDefault();

    $("body, html").animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 600);

    });
</script>

<link rel="stylesheet" href="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/css/styles.css" />

<div class="outer" style="margin-top:30px;">
        <div id='' class='gc_landing_page_bread_crumb' >

            <div class="">
                <nav class="breadcrumb" role="navigation"><h2 class="breadcrumb__title">You are here</h2>
                    <ul class="breadcrumb__list">
                        <li class="breadcrumb__item">
                            <a href="/explore">Browse &amp; Find</a>
                        </li>
                        <li class="breadcrumb__item">
                            <a href="/explore/indicators">USGCRP Indicator Platform</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

                <div class="contextual-links-region pane pane--service-links-service-links-not-node">
                    <h2 class="pane__title">Share</h2>
                    <div class="pane__content">
                        <div class="service-links"><a href="http://www.facebook.com/sharer.php?u=http%3A//bit.ly/2z2ML9u&amp;t=" title="Share on Facebook" class="service-links-facebook" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/facebook.png" alt="Facebook logo" /></a> <a href="http://twitter.com/share?url=http%3A//bit.ly/2z2ML9u&amp;text=" title="Share this on Twitter" class="service-links-globalchange-twitter" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/twitter.png" alt="Twitter logo" /></a> <a href="https://plus.google.com/share?url=http%3A//bit.ly/2z2ML9u" title="Share this on Google+" class="service-links-google-plus" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/google_plus.png" alt="Google+ logo" /></a> <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A//bit.ly/2z2ML9u&amp;title=&amp;summary=&amp;source=GlobalChange.gov" title="Submit this post on LinkedIn" class="service-links-globalchange-linkedin" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/linkedin.png" alt="LinkedIn logo" /></a> <a href="http://reddit.com/submit?url=http%3A//bit.ly/2z2ML9u&amp;title=" title="Submit this post on reddit.com" class="service-links-globalchange-reddit" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/reddit.png" alt="Reddit logo" /></a>
                        </div>
                    </div>
                </div>

            <div class="padding-top"></div>
            <div class="gc_landing_page_heading" ><h2>USGCRP Indicator Platform</h2></div>


    <div class="gc_indicator_landing_page_hero show_when_stacked"><img src="/sites/<?php echo $variable; ?>/modules/custom/globalchange_indicator_main/images/glacier-490x294.png"></div>


    <div class="two_column_row two_column_row_top">
            <div class="two_column">
                <div class="">The indicator platform is an interagency collaboration that leverages efforts from across the USGCRP agencies and highlights key climate information in the form of indicators that:</div>

                <ul>
                    <li>Provides foundational science in support of USGCRP  sustained assessment including the National Climate Assessment</li>
                    <li>Showcases examples from Federal agency-specific indicator efforts </li>
                    <li>Connects Federal agency research and science to USGCRP priorities </li>
                </ul>

            </div>
            <div class="two_column" >
                <div class="gc_indicator_landing_page_hero show_when_not_stacked"><img src="/sites/<?php echo $variable; ?>/modules/custom/globalchange_indicator_main/images/glacier-490x294.png"></div>
            </div>
        </div>

        <div class="pane pane--globalchange-general-custom-pane ">
            <div class="pane__content">
                <div id="features-jump-links" class="negative_top">

                    <div class="jump-link jump-link-label">JUMP TO →</div>
                    <div class="jump-link"><a href="#indicators_of_change">Indicators of Change</a></div>
                    <div class="jump-link"><a href="#explore_usgcrp_indicators">USGCRP Indicators</a></div>
                    <div class="jump-link"><a href="#federal_indicators">Federal Indicators of Change</a></div>
                </div>

            </div>

        </div>

        <div class="margin-top" id="indicators_of_change">
            <div ><h3>Indicators of Change</h3></div>
        </div>

        <div class="two_column_row " >
            <div class="two_column ">
                <div class="">Climate indicators show trends over time in key aspects of our environment including:</div>

                <ul>
                    <li><a href="/browse/indicators/indicator-annual-greenhouse-gas-index">Greenhouse gas levels in the atmosphere</a></li>
                    <li><a href="/browse/indicators/indicator-global-surface-temperatures">Temperatures across land and sea</a></li>
                    <li><a href="/browse/indicators/indicator-arctic-sea-ice-extent">Extent of Arctic sea ice</a></li>
                </ul>

            </div>
            <div class="two_column " >
                <div class="">Indicators based on long-term, consistently collected data can be used to:</div>

                <ul>
                    <li>Understand how our climate and environmental conditions are changing</li>
                    <li>Consider and assess risks and vulnerabilities</li>
                    <li>Help us prepare, take action, and improve resilience to the impacts of climate change</li>
                </ul>
            </div>
        </div>


        <div id="learn_about_climate_change_heading" class=""><h4>Learn About Trends in Climate Change</h4></div>


        <div class="centered_interactive_map" id="centered_interactive_map" >

                <img id="" class="img" src="/sites/<?php echo $variable; ?>/modules/custom/globalchange_indicator_main/images/IndicatorsInteractive.png"  alt="Climate Change Indicators in the US" />
                <div id="" class=""></div>
                <div id="interactive_map_caption_div" class="text" >
                    <p><span id="caption_text">Source: </span><span style="text-decoration:underline;" id="caption_text" >Fourth National Climate Assessment (NCA4)</span></p>
                </div>

                <div id="image_caption_div" style="">
                    <div id="" class="text ">
                        <p><span id="caption_text" ><?php echo $image_caption;?></span></p>
                    </div>
                </div>

        </div>

</div>



    <div class="gc_explore_indicators" id="explore_usgcrp_indicators" >


        <div class="explore_indicators_heading">Explore USGCRP Indicators</div>

        <div id="featured_indicators" class="padding-top">

            <div class="three_column_row">
                <div class="three_column" >
                    <a href="/<?php echo $alias[0]; ?>" class="darken">
                        <div class="container gc_image_small" >
                            <img src="<?php echo $image_url[0]; ?>" alt="<?php echo $image_alt[0]; ?>"  >
                            <div class="centered"><div class="gc_image_title_small"><?php echo $title[0]; ?></div>
                                <div class="gc_image_tagline_small"><?php echo $tagline[0]; ?></div></div>
                        </div>
                    </a>
                </div>
                <div class="three_column" >
                    <a href="/<?php echo $alias[1]; ?>" class="darken">
                        <div class="container gc_image_small">
                            <img  src="<?php echo $image_url[1]; ?>" alt="<?php echo $image_alt[1]; ?>"  >
                            <div class="centered"><div class="gc_image_title_small"><?php echo $title[1]; ?></div>
                                <div class="gc_image_tagline_small"><?php echo $tagline[1]; ?></div></div>
                        </div>
                    </a>
                </div>
                <div class="three_column" >
                    <a href="/<?php echo $alias[2]; ?>" class="darken">
                        <div class="container gc_image_small">
                            <img src="<?php echo $image_url[2]; ?>" alt="<?php echo $image_alt[2]; ?>"  >
                            <div class="centered"><div class="gc_image_title_small"><?php echo $title[2]; ?></div>
                                <div class="gc_image_tagline_small"><?php echo $tagline[2]; ?></div></div>
                        </div>
                    </a>
                </div>


            </div>


                <p><a href="<?php echo $catalog; ?>"><button class="button">View All</button></a></p>
            </div>


        </div>


    </div>


<div class="gc_selected_indicators" id="federal_indicators" >
    <div class="selected_indicators_heading" style=""><h2 class="padding-top">Selected Federal Climate-Related Indicators</h2></div>
    <div class="selected_indicators_text">Learn more about climate change indicator research at USGCRP agencies.</div>
    <div class="gc_selected_indicators_wrapper">
        <div class="row1 margin-top-30">
            <div class="column1 left1 ">
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.epa.gov/climate-indicators" target="_blank"><img class="gc_selected_indicators_image" src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/epa.png" alt="Climate Change Indicators in the US" ></a>
                    </div>
                    <div class="column right ">
                        <div class="selected_indicators_heading2"><a href="https://www.epa.gov/climate-indicators" target="_blank">Climate Change Indicators in the US</a></div>
                        <div class="selected_indicators_text2">EPA partners with more than 40 data contributors from various sources to compile a key set of climate change indicators.</div>
                    </div>
                </div>
            </div>
            <div class="column1 right1 "  >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.arctic.noaa.gov/report-card" target="_blank"><img class="gc_selected_indicators_image"  src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/noaa.png" alt="NOAA's Arctic Report Card" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://www.arctic.noaa.gov/report-card" target="_blank">NOAA's Arctic Report Card</a></div>
                        <div class="selected_indicators_text2">The Arctic Report Card is a timely and peer-reviewed source for environmental information on the current state of the Arctic environmental system.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row1">
            <div class="column1 left1 "  >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.ncdc.noaa.gov/sotc/" target="_blank"><img class="gc_selected_indicators_image" src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/noaa.png" alt="NOAA's State of the Climate" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://www.ncdc.noaa.gov/sotc/" target="_blank">NOAA's State of the Climate</a></div>
                        <div class="selected_indicators_text2">The State of the Climate is a collection of monthly summaries recapping climate-related occurrences on both a global and national scale.</div>
                    </div>
                </div>
            </div>
            <div class="column1 right1 " >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.cdc.gov/nceh/tracking/" target="_blank"><img class="gc_selected_indicators_image"  src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/cdc.jpeg" alt="CDC's Environmental Public Health Tracking Program" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://www.cdc.gov/nceh/tracking/" target="_blank">CDC's Environmental Public Health Tracking Program</a></div>
                        <div class="selected_indicators_text2">The Arctic Report Card is a timely and peer-reviewed source for environmental information on the current state of the Arctic environmental system.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row1">
            <div class="column1 left1 " >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://climate.nasa.gov/vital-signs/carbon-dioxide/" target="_blank"><img class="gc_selected_indicators_image"  src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/nasa.png" alt="NASA's Vital Signs" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://climate.nasa.gov/vital-signs/carbon-dioxide/" target="_blank">NASA's Vital Signs</a></div>
                        <div class="selected_indicators_text2">Explore vital signs of global climate change and global warming, such as Carbon Dioxide, Global Temperature, and Arctic Sea Ice Minimum.</div>
                    </div>
                </div>
            </div>
            <div class="column1 right1 " >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.usanpn.org/usa-national-phenology-network" target="_blank"><img class="gc_selected_indicators_image"  src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/phenology.png" alt="Natioanl Phenology Network" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://www.usanpn.org/usa-national-phenology-network" target="_blank">National Phenology Network</a></div>
                        <div class="selected_indicators_text2">This award-winning network collects, stores, and shares seasonal natural phenomena and cyclical data and information.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="two_column_row" id="two_column_row_bottom">
    <div class="two_column col_left bottom_row_height">
    <div class="selected_usgrp_products">
        <div ><h4 style="color:#fff;">Selected USGRP Products</h4></div>
        <ul class="selected_usgrp_products_ul">
            <li><a href="https://nca2014.globalchange.gov/" target="_blank" style="color:#fff">National Climate Assessment</a></li>
            <li><a href="https://www.globalchange.gov/sites/globalchange/files/USGCRP%20indicators_March2018-FINAL_Newsletter%20Version_23May18.pdf" target="_blank" style="color:#fff">USGRCP Indicators Fact Sheet</a> </li>
            <li><a href="https://science2017.globalchange.gov/" target="_blank" style="color:#fff">Climate Science Special Report</a> </li>
        </ul>
    </div>
</div>
<div class="two_column col_right bottom_row_height" >
    <div class="selected_usgrp_products">
        <div><h4 style="color:#fff;">Indicator Announcements and Opportunities</h4></div>
        <ul class="selected_usgrp_products_ul">
            <li class="selected_usgrp_products_text">Upcoming Workshop on Social Indicators  </li>
            <li class="selected_usgrp_products_text">Arctic Observing Network</li>
            <li class="selected_usgrp_products_text">NOAA Funding Opportunities for Developing Indicators (FY19 NOAA/CPO/MAPP) </li>
        </ul>
    </div>
</div>
</div>
