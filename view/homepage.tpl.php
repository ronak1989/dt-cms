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
    <script src="<?php echo _CONST_JS_PATH;?>modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body id="top">
<div class="wsmenucontainer clearfix mrginleft">
  <div class="wsmenucontent overlapblackbg menuopen"></div>
  <div class="wsmenuexpandermain slideRight">
    <a id="navToggle" class="animated-arrow slideLeft menuopen"><span></span></a>
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
            <?php foreach ($data['cover-story-details'] as $key => $value) {
	$class = ($key == 0) ? 'active' : '';
	$caption = strtoupper(($value['caption'] == '') ? $value['category_name'] : $value['caption']);
	?>
            <div class="item <?php echo $class;?>">
              <img src="<?php echo $value['image_1600'];?>" alt="<?php echo $value['image_name'];?>">
              <div class="rank-article">
                <span class="article-category"><?php echo $caption;?></span>
                <h3><?php echo $value['headline'];?></h3>
              </div>
            </div>
<?php }
?>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </section>
</div>
<div class="category-section">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 PT16">
    	<div class="col-xs-12">
		    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 category-blocks PL16">
            	<div class="hidden-xs category-image">
                	<a class="subovrimg" href="">
                    	<span class="subsechead category-purple-bkgrnd " >Markets</span>
                    </a>
                    <a href="">
                    	<img style="cursor: pointer; width:100%;" src="<?php echo $data['market-widget'][0]['image_300'];?>">
                    </a>
                    <div class="headovrimg">
                    	<a href="" class="category-img-heading"><?php echo $data['market-widget'][0]['headline'];?></a>
                     </div>
                 </div>
                <div class="news-category category-purple-bkgrnd visible-xs-block">
                    Markets
                    <span class="view-all">View All >></span>
                </div>
                <div id="category-news">
                    <ul>
                        <?php
unset($data['market-widget'][0]);
$total_articles = count($data['market-widget']);
foreach ($data['market-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class;?>"><i class="fa fa-arrow-right"></i><a href="#"><?php echo $value['headline'];?></a></li>
<?php
}
?>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 category-blocks PL16">
            	<div class="hidden-xs category-image">
                	<a class="subovrimg" href="">
                    	<span class="subsechead category-green-bkgrnd" >Corporates</span>
                    </a>
                    <a href="">
                    	<img style="cursor: pointer; width:100%;" src="<?php echo $data['corporate-widget'][0]['image_300'];?>">
                    </a>
                    <div class="headovrimg">
                    	<a href="" class="category-img-heading"><?php echo $data['corporate-widget'][0]['headline'];?></a>
                     </div>
                 </div>
                <div class="news-category category-green-bkgrnd visible-xs-block">
                    Corporates
                    <span class="view-all">View All >></span>
                </div>
                <div id="category-news">
                    <ul>
                                                <?php
unset($data['corporate-widget'][0]);
$total_articles = count($data['corporate-widget']);
foreach ($data['corporate-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class;?>"><i class="fa fa-arrow-right"></i><a href="#"><?php echo $value['headline'];?></a></li>
<?php
}
?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
	        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 category-blocks PL16">
            	<div class="hidden-xs category-image">
                	<a class="subovrimg" href="">
                    	<span class="subsechead category-blue-bkgrnd" >News</span>
                    </a>
                    <a href="">
                    	<img style="cursor: pointer; width:100%;" src="<?php echo $data['news-widget'][0]['image_300'];?>">
                    </a>
                    <div class="headovrimg">
                    	<a href="" class="category-img-heading"><?php echo $data['news-widget'][0]['headline'];?></a>
                     </div>
                 </div>
                <div class="news-category category-blue-bkgrnd visible-xs-block">
                    News
                    <span class="view-all">View All >></span>
                </div>
                <div id="category-news">
                    <ul>
                                                <?php
unset($data['news-widget'][0]);
$total_articles = count($data['news-widget']);
foreach ($data['news-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class;?>"><i class="fa fa-arrow-right"></i><a href="#"><?php echo $value['headline'];?></a></li>
<?php
}
?>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 category-blocks PL16">
            	<div class="hidden-xs category-image">
                	<a class="subovrimg" href="">
                    	<span class="subsechead category-pink-bkgrnd">Investing</span>
                    </a>
                    <a href="">
                    	<img style="cursor: pointer; width:100%;" src="<?php echo $data['investing-widget'][0]['image_300'];?>">
                    </a>
                    <div class="headovrimg">
                    	<a href="" class="category-img-heading"><?php echo $data['investing-widget'][0]['headline'];?></a>
                     </div>
                 </div>
                <div class="news-category category-pink-bkgrnd visible-xs-block">
                    Investing
                    <span class="view-all">View All >></span>
                </div>
                <div id="category-news">
                    <ul>
                                                <?php
unset($data['investing-widget'][0]);
$total_articles = count($data['investing-widget']);
foreach ($data['investing-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class;?>"><i class="fa fa-arrow-right"></i><a href="#"><?php echo $value['headline'];?></a></li>
<?php
}
?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16">
        <div class="hot-press">
            Hot of the Press
        </div>
        <div id="press-news">
            <ul>
                <?php
$total_hot_stories = count($data['hot-of-the-press']) - 1;
foreach ($data['hot-of-the-press'] as $key => $value) {
	$li_class = ($total_hot_stories == $key) ? 'last' : '';

	?>
                <li class="<?php echo $li_class;?>"><img src="<?php echo $value['image_77'];?>" style="float:left;padding-right:10px" /><p><?php echo $value['headline'];?></p></li>
                <?php }
?>
            </ul>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16 PR16">
        <div>
             <div class="forecaster-block">
                The Forecaster
            </div>
        	<div class="forecaster-img">
            	<img src="<?php echo $data['forecaster']['0']['image_300'];?>" class="img-responsive" width="100%;">
            </div>
            <div class="forecaster-heading">
            	<?php echo $data['forecaster']['0']['headline'];?>
            </div>
            <div class="forecaster-description">
            	<?php echo $data['forecaster']['0']['summary'];?>
            </div>
            <span style="float:right">Read More</span>
        </div>
        <div style="clear:both"></div>
        <div class="ads-container">
        	<img src="http://placehold.it/300x250" class="img-responsive middle-align" >
        </div>
        <div class="ads-container">
        	<img src="http://placehold.it/300x150" class="img-responsive middle-align" >
        </div>
    </div>
</div>
<div style="clear:both"></div>
<div class="category-section">
	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16">
    	<div class="category-image hidden-xs">
            <a class="subovrimg" href="">
                <span class="subsechead category-orange-bkgrnd">Earnings</span>
            </a>
            <a href="">
                <img style="cursor: pointer; width:100%;" src="<?php echo $data['earnings-widget'][0]['image_300'];?>">
            </a>
            <div class="headovrimg">
                <a href="" class="category-img-heading"><?php echo $data['earnings-widget'][0]['headline'];?></a>
             </div>
         </div>
    	<div class="news-category category-orange-bkgrnd visible-xs-block">
            Earnings
            <span class="view-all">View All >></span>
        </div>
        <div id="category-news">
            <ul>
<?php
unset($data['earnings-widget'][0]);
$total_articles = count($data['earnings-widget']);
foreach ($data['earnings-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class;?>"><i class="fa fa-arrow-right"></i><a href="#"><?php echo $value['headline'];?></a></li>
<?php
}
?>
            </ul>
        </div>
    </div>
	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16">
    	<div class="hidden-xs category-image">
            <a class="subovrimg" href="">
                <span class="subsechead category-yellow-bkgrnd">Economy</span>
            </a>
            <a href="">
                <img style="cursor: pointer; width:100%;" src="<?php echo $data['economy-widget'][0]['image_300'];?>">
            </a>
            <div class="headovrimg">
                <a href="" class="category-img-heading"><?php echo $data['economy-widget'][0]['headline'];?></a>
             </div>
         </div>
    	<div class="news-category category-yellow-bkgrnd visible-xs-block">
            Economy
            <span class="view-all">View All >></span>
        </div>
        <div id="category-news">
            <ul>
<?php
unset($data['economy-widget'][0]);
$total_articles = count($data['economy-widget']);
foreach ($data['economy-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class;?>"><i class="fa fa-arrow-right"></i><a href="#"><?php echo $value['headline'];?></a></li>
<?php
}
?>
            </ul>
        </div>
    </div>
	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16">
    	<div id="chart-of-the-day-container">
             <div class="chart-of-the-day-title">
                Chart of the Day
            </div>
        	<div class="chart-of-the-day-img">
            	<img src="<?php echo $data['chart-of-the-day']['0']['image_300'];?>" class="img-responsive" width="100%;">
            </div>
            <div class="chart-of-the-day-headline">
            	<?php echo $data['chart-of-the-day']['0']['headline'];?>
            </div>
            <div class="chart-of-the-day-desc">
            	<?php echo $data['chart-of-the-day']['0']['summary'];?>
            </div>
        </div>
    </div>
	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16 PR16">
    	<div class="twitter-container">
            <a class="twitter-timeline"  href="https://twitter.com/dalaltimes" data-widget-id="658551591054766080" height="400">Tweets by @dalaltimes</a>
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
    <!--Main Menu File-->
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

</body>
</html>
