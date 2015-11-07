<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" lang="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once _CONST_VIEW_PATH . 'website_tags.php';
?>
</head>
<body id="top">
<div id="body-container">
<?php
include_once _CONST_VIEW_PATH . 'menu.php';
?>
<div style="margin:0;padding:0">
    <section>
        <div id="mycarousel" class="carousel slide" data-ride="carousel">
          <!-- Wrapper for slides -->
          <div id="hp-rank" class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="<?php echo $data['categoryDetails']['rows'][0]['image_1600'];?>" alt="<?php echo $data['categoryDetails']['rows'][0]['image_name'];?>">
              <a href="<?php echo $data['categoryDetails']['rows'][0]['news_url'];?>">
              <div class="rank-article">
                <span class="article-category"><?php echo strtoupper($data['categoryDetails']['rows'][0]['category_name']);?></span>
                <h3><?php echo $data['categoryDetails']['rows'][0]['headline'];?></h3>
              </div>
              </a>
            </div>
          </div>
        </div>
    </section>
</div>
<div class="category-section"  style="">
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 PT16 PL16 PR16">
        <div class="col-xs-12">
            <div class="cateogry-list-title <?php echo $data['background_color_cls'];?>">
                <strong>All <?php echo $data['categoryName'];?> NEWS</strong>
            </div>

            <div class="scrollingcontent" data-url="<?php echo $data['current_url'];?>">

            <ol class="stories-list">
<?php
unset($data['categoryDetails']['rows'][0]);
foreach ($data['categoryDetails']['rows'] as $key => $value) {
	?>
                <li class="stories-list-element">
                    <a title="<?php echo $value['headline'];?>" class="story-link" href="<?php echo $value['news_url'];?>">
                        <figure >
                          <img alt="<?php echo $value['headline'];?>" src="<?php echo $value['image_300'];?>" class="img-responsive">
                        </figure>
                        <div  class="content">
                            <h5 class="section">
                                <?php echo $value['sub_category_name'];?>
                            </h5>
                            <h3>
                                <?php echo $value['headline'];?>
                            </h3>
                            <div class="byline">
                                <div class="timestamp"><?php echo $value['news_source'];?> | <?php echo $value['modified_date'];?></div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="summary">
                                <?php echo $value['summary'];?>
                            </div>
                            <br>
                        </div>
                    </a>
                </li>
<?php
}
?>
            </ol>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 PT16 PL16 PR16">
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
<div style="clear:both"></div>
<?php
include_once _CONST_VIEW_PATH . 'website_footer.php';
?>
    <script type="text/javascript" language="javascript" src="<?php echo _CONST_JS_PATH;?>infinitescroll.js"></script>
    <!--Main Menu File-->
    <script>
        spinner_class = '<?php echo $data["background_color_cls"];?>';
        initPaginator();
        next_data_url = '<?php echo $data["next_data_url"]?>';
        prev_data_url = '<?php echo $data["prev_data_url"]?>';

        primeCache();
    </script>
</div>
</div>
<style>
.stories-list {
    margin: 0
}

.stories-list {
    margin: 0 0 1.5em 0;
    padding: 0
}

.stories-list-element {
    position: relative;
    list-style: none;
    background: white;
    overflow: hidden;
    clear: both;
    margin: 0.75em 0;
    padding: 40% 0 0.25em 0;
    -webkit-box-shadow: 0 5px 5px rgba(153, 153, 153, 0.5);
    -moz-box-shadow: 0 5px 5px rgba(153, 153, 153, 0.5);
    box-shadow: 0 5px 5px rgba(153, 153, 153, 0.5);
    border-bottom: 1px solid;
}

@media (min-width: 750px) {
    .stories-list-element {
        min-height: 9.375em;
        padding: 0 0 0 16.625em;
        box-shadow: none
    }
}
.stories-list-element a,
.stories-list-element a:active,
.stories-list-element a:focus {
    color: #000000;
    text-decoration: none;
    padding-bottom: 10px;
}


.stories-list-element figure {
    position: absolute;
    display: block;
    top: 0;
    left: 0;
    width: 100%;
    padding: 40% 0 0 0;
    overflow: hidden
}
@media (min-width: 750px) {
    .stories-list-element figure {
        width: 16.625em;
        height: 100%;
        bottom: 0;
        padding: 0
    }
}
.stories-list-element img {
    display: block;
    position: absolute;
    top: 0;
    width: 100%;
    left: 50%;
    -webkit-transform: translate(-50%, 0);
    -moz-transform: translate(-50%, 0);
    transform: translate(-50%, 0)
}
@media (min-width: 750px) {
    .stories-list-element img {
        height: auto;
        width: 100%;
        max-width: none
    }
}
.stories-list-element .content {
    padding: 0 0.75em;

}
@media (min-width: 750px) {
    .stories-list-element .content {
        padding: 0 1.25em;
        min-height: 10.375em;
    }
}
.stories-list-element h5.section {
    font-size: 0.75em;
    padding: 0 0 0.625em 0;
    font-weight: 700;
}
@media (min-width: 750px) {
    .stories-list-element h5.section {
        padding: 0 0 1em 0
    }
}
.stories-list-element h3 {
    font-size: 0.875em;
    line-height: 1.85714em;
    font-weight: 400;
    padding: 0;
    color:#000000;
}
@media (min-width: 750px) {
    .stories-list-element h3 {
        font-size: 1em;
        line-height: 1.25em;
        /*height: 2.0625em*/
    }
}
@media (min-width: 800px) {
    .stories-list-element h3 {
        font-size: 1.125em;
        line-height: 1.3em;
        /*height: 2.0625em*/
    }
}
@media (min-width: 1200px) {
    .stories-list-element h3 {
        line-height: 1.5em
    }
}
.stories-list-element .byline {
    font-size: 0.75em;
    color: #999999;
    line-height: 2.5em;
    display: none
}
@media (min-width: 750px) {
    .stories-list-element .byline {
        display: block
    }
}
.stories-list-element .byline .author {
    float: left;
    font-weight: 700;
    font-style: italic;
    font-size: 12px
}
.stories-list-element .byline .timestamp {
    float: left;
}
.stories-list-element .summary {
    margin-top: 0.66667em;
    font-weight: normal;
}

</style>
</body>
</html>
