<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang=""><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sedna - A Free HTML5/CSS3 website by Peter Finlan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo _CONST_CSS_PATH;?>styles.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo _CONST_CSS_PATH;?>queries.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- <link rel="canonical" href="/items?page=3" /> -->
    <?php if ($data['next_url'] != '') {?>
    <link rel="next" href="<?php echo $data['next_url']?>"/>
    <?php }
?>
    <?php if ($data['prev_url'] != '') {?>
    <link rel="prev" href="<?php echo $data['prev_url']?>"/>
    <?php }
?>
    <script src="<?php echo _CONST_JS_PATH;?>modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body id="top">
<div class="wsmenucontainer clearfix">
  <div class="wsmenucontent overlapblackbg menuclose"></div>
  <div class="wsmenuexpandermain slideRight">
    <a id="navToggle" class="animated-arrow slideLeft menuclose"><span></span></a>
    <a href="" class="smallogo"><img src="<?php echo _CONST_IMAGE_URL;?>logo.png" alt=""></a>
    <a class="callusicon" href="tel:123456789"><span class="fa fa-phone"></span></a>
  </div>


<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section class="navigation">
        <header>
          <div class="logo">
            <a>
              <!--[if gte IE 10]><!-->
              <!-- DT LOGO -->
                <img src="<?php echo _CONST_IMAGE_URL;?>logo.png">
              <!-- /DT LOGO -->
            </a>
          </div>
          <div class="right">
              <i class="fa fa-user fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i>
              |
              <i class="fa fa-bolt fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i>
              |
              <i class="fa fa-share-alt fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i>
              |
              <i class="fa fa-ellipsis-h fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i>
          </div>
          <div id="header-search-input"></div>
          <div class="left">
            <a href="javascript:void(0);" id="horizontal-nav-toggle"><i class="fa fa-bars fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a>
            |
            <a href=""><i class="fa fa-search fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a>
          </div>
            <div class="header-content bigmegamenu clearfix">
                <nav class="wsmenu slideLeft clearfix menuopen">
                <ul class="mobile-sub wsmenu-list">
                  <li>
                    <a href="./Sedna - A Free HTML5_CSS3 website by Peter Finlan_files/Sedna - A Free HTML5_CSS3 website by Peter Finlan.html" class="active">Home</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Market</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Economy</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Wisdom</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Funds</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Investing</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Business</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;DT FORECASTER</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Chart of the Day</a>
                  </li>
                  <span class="seperator">|</span>
                  <li>
                    <span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href=""><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Gallery</a>
                  </li>
                </ul>
              </nav>
            </div>
        </header>
    </section>
	<section>
        <div id="mycarousel" class="carousel slide" data-ride="carousel">
          <!-- Wrapper for slides -->
          <div id="hp-rank" class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="<?php echo $data['categoryDetails']['rows'][0]['image_1600'];?>" alt="<?php echo $data['categoryDetails']['rows'][0]['image_name'];?>">
              <div class="rank-article">
                <span class="article-category"><?php echo strtoupper($data['categoryDetails']['rows'][0]['category_name']);?></span>
                <h3><?php echo $data['categoryDetails']['rows'][0]['headline'];?></h3>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>
<div class="category-section"  style="">
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 PT16 PL16 PR16">
    	<div class="col-xs-12">
            <div class="cateogry-list-title category-purple-bkgrnd">
                <strong>All <?php echo $data['categoryName'];?> NEWS</strong>
            </div>
            <div class="scrollingcontent" data-url="<?php echo $data['current_url'];?>">
            <ol class="stories-list">
<?php
unset($data['categoryDetails']['rows'][0]);
foreach ($data['categoryDetails']['rows'] as $key => $value) {
	?>
                <li class="stories-list-element">
                    <a title="<?php echo $value['headline'];?>" class="story-link" href="">
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
                                <!-- <div class="author" itemprop="author">Poonam Agarwal</div> -->
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
        <div class="hot-press">
            Hot of the Press
        </div>
        <div id="press-news">
            <ul>

            </ul>
        </div>
    </div>

</div>
<div style="clear:both"></div>
<footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <div class="copyright">
            <p><a href="#">About Us</a> | <a href="#">Products and Services</a> | <a href="#">Careers</a> | <a href="#">Sitemap</a> | <a href="#">Feedback</a></p>
            <p><a href="#">Contact Us</a> | <a href="#">Archive</a> | <a href="#">Blog / Opinion</a> | <a href="#">Disclaimer</a> | <a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a> | <a href="#">Grievance Redressal Policy</a></p>
            <p class="footer-company-trademark">&copy; <span>Dalaltimes.com</span> 2015, all right reserved</p>
          </div>
        </div>
      </div>
    </div>
</footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo _CONST_JS_PATH;?>scripts.js"></script>
    <!--<script src="./Sedna - A Free HTML5_CSS3 website by Peter Finlan_files/classie.js"></script>-->

     <!--Main Menu File-->
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo _CONST_CSS_PATH;?>webslidemenu.css">
    <script type="text/javascript" language="javascript" src="<?php echo _CONST_JS_PATH;?>webslidemenu.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo _CONST_JS_PATH;?>infinitescroll.js"></script>
    <!--Main Menu File-->
    <script>
        initPaginator();
        next_data_url = '<?php echo $data["next_data_url"]?>';
        prev_data_url = '<?php echo $data["prev_data_url"]?>';
        primeCache();
    </script>
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
    color: #555555;
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
    padding: 0 0 0.625em 0
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
    padding: 0
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
}

</style>
</body>
</html>
