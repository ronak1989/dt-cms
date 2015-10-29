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
        <article id="article-<?php echo $data['article-details']['articleId'];?>" class="article article-block">
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
                    <div id="news-widget" style="background-color: #000;height:200px;">
                    [WIDGET]
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
<script>
var windw = this;
var header_height = $(".navigation").height();
$.fn.followTo = function ( ) {
    var $this = this,
        $window = $(windw),
        $top_position = $this.offset().top,
        $widgetHeight = $this.outerHeight(true),
        $articleContent = $('.article-content'),
        bumperPos = $articleContent.offset().top+$articleContent.outerHeight(true);
        setPosition = function(){
            if ($window.scrollTop()+header_height > $top_position && $window.scrollTop()+header_height+ $widgetHeight< bumperPos) {
                $this.addClass("stick");
                $this.css({'top':header_height+30});
            } else {
                $this.removeClass("stick");
                $this.css({'top':''});
            }
        };
    $(window).scroll(setPosition);
};

$('#news-widget').followTo();
</script>
</body>
</html>
