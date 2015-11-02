<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang=""><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once _CONST_VIEW_PATH . 'website_tags.php';
?>
</head>
<body id="top">
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
                    <div>
                        <?php echo $data['article-details']['news_content'];?>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 hidden-sm hidden-xs">
                    <div class="news-widget">
                        <div class="tabbable full-width-tabs">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#tab-one" data-toggle="tab">Tab 1</a></li>
                                <li><a href="#tab-two" data-toggle="tab">Tab 2</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-one">
                                    I'm in Tab 1.
                                </div>
                                <div class="tab-pane" id="tab-two">
                                    Howdy, I'm in Tab 2. Howdy, I'm in Tab 2. Howdy, I'm in Tab 2. Howdy, I'm in Tab 2.
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
<script src="<?php echo _CONST_JS_PATH;?>infinite_scroll.js"></script>
<!-- <script src="<?php echo _CONST_JS_PATH;?>jquery.history.js"></script> -->
<script>
var load_story = 0;
var windw = this;
var header_height = $(".navigation").height();
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
<style>
.full-width-tabs > ul.nav.nav-tabs {
    display: table;
    width: 100%;
    table-layout: fixed;
    border:0px;
    background-color: #000000;
}
.full-width-tabs > ul.nav.nav-tabs > li {
    float: none;
    display: table-cell;
    width:100%;
}
.full-width-tabs > ul.nav.nav-tabs > li > a,.full-width-tabs > ul.nav.nav-tabs > li > a:focus,.full-width-tabs > ul.nav.nav-tabs > li > a:hover {
    outline: none;
    text-align: center;
    border-radius: unset !important;
    color: #FFFFFF;
    margin-right:unset;

    border: none;
    background-color: inherit;
}

.full-width-tabs > ul.nav.nav-tabs > li.active > a {
    outline: none;
    border-bottom: 5px solid #cc0000;
    margin-right: 0;
}

</style>
</body>
</html>
