<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang=""><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once _CONST_VIEW_PATH . 'website_tags.php';
?>
</head>
<body id="top">
<div id="body-container">
<?php
include_once _CONST_VIEW_PATH . 'menu.php';
?>
<div id="news-section">
    <div id="news-block">
        <article id="article-<?php echo $data['article-details']['articleId'];?>" data-id=<?php echo $data['article-details']['articleId'];?>  class="article article-block first">
            <div id="breadcrumb-block">
                <ul class="breadcrumb">
                    <li><a href="<?php echo _CONST_WEB_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
                    <li><a href="<?php echo $data['article-details']['category_url'];?>"><?php echo $data['article-details']['category_name'];?></a></li>
                    <li class="active"><?php echo $data['article-details']['heading'];?></li>
                </ul>
            </div>
            <header>
                <h1><?php echo $data['article-details']['heading'];?></h1>
                <div class="byline">
                    <span class="article-source"><?php echo $data['article-details']['news_source_name'];?></span>
                    <span class="article-timestamp"><?php echo $data['article-details']['publish_date'];?></span>
                </div>
            </header>

            <figure class="article-image size-extra-large ">
                <picture>
                  <source srcset="<?php echo $data['article-details']['image_1600'];?>" media="(min-width: 1280px)">
                  <source srcset="<?php echo $data['article-details']['image_1280'];?>, <?php echo $data['article-details']['image_1600'];?> 2x" media="(min-width: 769px)">
                  <source srcset="<?php echo $data['article-details']['image_615'];?>, <?php echo $data['article-details']['image_1280'];?> 2x" media="(min-width: 450px)">
                  <img itemprop="image" srcset="<?php echo $data['article-details']['image_300'];?>" alt="" title="" class="img-responsive">
                </picture>
                <figcaption class="article-image-slug">
                    <span class="image-name"><i class="fa fa-camera fa-lg"></i> [IMAGE NAME]</span>
                    <span class="image-courtesy">Courtesy : [IMAGE COURTESY]</span>
                </figcaption>
            </figure>
            <div class="article-body">
                <div class="col-md-8 col-lg-7 col-lg-offset-2 article-content">
                    <div class="social-share-block">
                        <!-- Twitter -->
                        <a href="http://twitter.com/share?url=https://github.com/gschier/html-share-buttons&text=HMTL%20Share%20Buttons&via=GregorySchier" target="_blank" class="share-btn twitter">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <!-- Google Plus -->
                        <a href="https://plus.google.com/share?url=https://github.com/gschier/html-share-buttons" target="_blank" class="share-btn google-plus">
                            <i class="fa fa-google-plus"></i>
                        </a>

                        <!-- Facebook -->
                        <a href="http://www.facebook.com/sharer/sharer.php?u=https://github.com/gschier/html-share-buttons" target="_blank" class="share-btn facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <!-- LinkedIn -->
                        <a href="http://www.linkedin.com/shareArticle?url=https://github.com/gschier/html-share-buttons&title=HMTL%20Share%20Buttons&summary=HMTL%20Share%20Buttons&source=http://schier.co/blog/2014/10/22/pure-html-share-buttons.html" target="_blank" class="share-btn linkedin">
                            <i class="fa fa-linkedin"></i>
                        </a>

                        <!-- Email -->
                        <a href="mailto:?subject=HMTL%20Share%20Buttons&body=https://github.com/gschier/html-share-buttons" target="_blank" class="share-btn email">
                            <i class="fa fa-envelope"></i>
                        </a>
                    </div>
                    <div>
                        <?php echo $data['article-details']['news_content'];?>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 hidden-sm hidden-xs">
                    <div id="news-widget">
                        <div class="tabbable full-width-tabs">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#tab-one" data-toggle="tab">LATEST</a></li>
                                <li><a href="#tab-two" data-toggle="tab">TOP 10</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-one">
                                    <div class="news-widget">
                                        <ul>
                                            <?php
$total_latest_stories = count($data['news-widget']['latest']) - 1;
foreach ($data['news-widget']['latest'] as $key => $value) {
	$li_class = ($total_latest_stories == $key) ? 'last' : '';

	?>
                                          <li class="<?php echo $li_class;?>"><a href="<?php echo $value['news_url'];?>"><img src="<?php echo $value['image_77'];?>" style="float:left;padding-right:10px" /><p><?php echo $value['headline'];?></p></a></li>
                <?php }
?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-two">
                                    <div class="news-widget">
                                        <ul>
                                            <?php
$top_stories = count($data['news-widget']['top_10']) - 1;
foreach ($data['news-widget']['top_10'] as $key => $value) {
	$li_class = ($top_stories == $key) ? 'last' : '';

	?>
                                          <li class="<?php echo $li_class;?>"><a href="<?php echo $value['news_url'];?>"><img src="<?php echo $value['image_77'];?>" style="float:left;padding-right:10px" /><p><?php echo $value['headline'];?></p></a></li>
                <?php }
?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /tabbable -->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </article>
    </div>
</div>
<?php
include_once _CONST_VIEW_PATH . 'website_footer.php';
?>
</div>

<div id="c-mask" class="c-mask"></div><!-- /c-mask -->
<script src="<?php echo _CONST_JS_PATH;?>infinite_scroll.js"></script>
<!-- <script src="<?php echo _CONST_JS_PATH;?>jquery.history.js"></script> -->
<script>
var load_story = 0;
var windw = this;
var ARTICLE_LOADED = <?php echo $data['article-details']['articleId'];?>;
var DT_SS = <?php echo json_encode($data['suggested-stories'], JSON_FORCE_OBJECT);?>;
var DT_SS_LENGTH = Object.keys(DT_SS).length;

$('#news-block').cleverInfiniteScroll({
    contentsWrapperSelector: '#news-block',
    contentSelector: '.article-block',
    nextSelector: '#next',
    loadImage: 'ajax-loader.gif'
});

</script>
</body>
</html>
