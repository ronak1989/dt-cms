<!DOCTYPE html>
<htmlxmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" lang="">
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
            <?php foreach ($data['cover-story-details'] as $key => $value) {
	$class = ($key == 0) ? 'active' : '';
	$caption = strtoupper(($value['caption'] == '') ? $value['category_name'] : $value['caption']);
	?>
        <div class="item <?php echo $class; ?>">
          <img src="<?php echo $value['image_1600']; ?>" alt="<?php echo $value['image_name']; ?>">
          <a href="<?php echo $value['news_url']; ?>">
          <div class="rank-article">
            <span class="article-category"><?php echo $caption; ?></span>
            <h3><?php echo $value['headline']; ?></h3>
          </div>
          </a>
        </div>
<?php }
?>
      </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#mycar
      ousel" role="button" data-slide="next">
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
                	<a class="subovrimg" href="<?php echo $data['market-widget'][0]['category_url']; ?>">
                    	<span class="subsechead category-purple-bkgrnd " >Markets</span>
                    </a>
                  	<img style="cursor: pointer; width:100%;" src="<?php echo $data['market-widget'][0]['image_300']; ?>">
                    <div class="headovrimg">
                    	<a href="<?php echo $data['market-widget'][0]['news_url']; ?>" class="category-img-heading"><?php echo $data['market-widget'][0]['headline']; ?></a>
                     </div>
                 </div>
                <div class="news-category category-purple-bkgrnd visible-xs-block">
                    Markets
                    <span class="view-all"><a href="<?php echo $data['market-widget'][0]['category_url']; ?>">View All >></a></span>
                </div>
                <div id="category-news">
                    <ul>
                        <?php
unset($data['market-widget'][0]);
$total_articles = count($data['market-widget']);
foreach ($data['market-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class; ?>"><i class="fa fa-arrow-right"></i><a href="<?php echo $value['news_url']; ?>"><?php echo $value['headline']; ?></a></li>
<?php
}
?>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 category-blocks PL16">
                <div class="hidden-xs category-image">
                    <a class="subovrimg" href="<?php echo $data['economy-widget'][0]['category_url']; ?>">
                        <span class="subsechead category-yellow-bkgrnd">Economy</span>
                    </a>
                    <img style="cursor: pointer; width:100%;" src="<?php echo $data['economy-widget'][0]['image_300']; ?>">
                    <div class="headovrimg">
                        <a href="<?php echo $data['economy-widget'][0]['news_url']; ?>" class="category-img-heading"><?php echo $data['economy-widget'][0]['headline']; ?></a>
                     </div>
                 </div>
                <div class="news-category category-yellow-bkgrnd visible-xs-block">
                    Economy
                    <span class="view-all"><a href="<?php echo $data['economy-widget'][0]['category_url']; ?>">View All >></a></span>
                </div>
                <div id="category-news">
                    <ul>
        <?php
unset($data['economy-widget'][0]);
$total_articles = count($data['economy-widget']);
foreach ($data['economy-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
            <li class="<?php echo $li_class; ?>"><i class="fa fa-arrow-right"></i><a href="<?php echo $value['news_url']; ?>"><?php echo $value['headline']; ?></a></li>
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
                    <a class="subovrimg" href="<?php echo $data['corporate-widget'][0]['category_url']; ?>">
                        <span class="subsechead category-green-bkgrnd" >Corporates</span>
                    </a>
                    <img style="cursor: pointer; width:100%;" src="<?php echo $data['corporate-widget'][0]['image_300']; ?>">
                    <div class="headovrimg">
                        <a href="<?php echo $data['corporate-widget'][0]['news_url']; ?>" class="category-img-heading"><?php echo $data['corporate-widget'][0]['headline']; ?></a>
                     </div>
                 </div>
                <div class="news-category category-green-bkgrnd visible-xs-block">
                    Corporates
                    <span class="view-all"><a href="<?php echo $data['corporate-widget'][0]['category_url']; ?>">View All >></a></span>
                </div>
                <div id="category-news">
                    <ul>
                                                <?php
unset($data['corporate-widget'][0]);
$total_articles = count($data['corporate-widget']);
foreach ($data['corporate-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class; ?>"><i class="fa fa-arrow-right"></i><a href="<?php echo $value['news_url']; ?>"><?php echo $value['headline']; ?></a></li>
<?php
}
?>
                    </ul>
                </div>

            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 category-blocks PL16">
            	<div class="hidden-xs category-image">
                	<a class="subovrimg" href="<?php echo $data['investing-widget'][0]['category_url']; ?>">
                    	<span class="subsechead category-pink-bkgrnd">Investing</span>
                    </a>
                   	<img style="cursor: pointer; width:100%;" src="<?php echo $data['investing-widget'][0]['image_300']; ?>">
                    <div class="headovrimg">
                    	<a href="<?php echo $data['investing-widget'][0]['news_url']; ?>" class="category-img-heading"><?php echo $data['investing-widget'][0]['headline']; ?></a>
                     </div>
                 </div>
                <div class="news-category category-pink-bkgrnd visible-xs-block">
                    Investing
                    <span class="view-all"><a href="<?php echo $data['investing-widget'][0]['category_url']; ?>">View All >></a></span>
                </div>
                <div id="category-news">
                    <ul>
                                                <?php
unset($data['investing-widget'][0]);
$total_articles = count($data['investing-widget']);
foreach ($data['investing-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class; ?>"><i class="fa fa-arrow-right"></i><a href="<?php echo $value['news_url']; ?>"><?php echo $value['headline']; ?></a></li>
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
            Hot off the Press
        </div>
        <div id="press-news">
            <ul>
                <?php
$total_hot_stories = count($data['hot-of-the-press']) - 1;
foreach ($data['hot-of-the-press'] as $key => $value) {
	$li_class = ($total_hot_stories == $key) ? 'last' : '';

	?>
                <li class="<?php echo $li_class; ?>">
                    <a href="<?php echo $value['news_url']; ?>"><img src="<?php echo $value['image_77']; ?>" style="float:left;padding-right:10px" /><p><?php echo $value['headline']; ?></p></a>
                    <em style="float:right;font-size:0.7em;line-height:0em;"><?php echo $value['ago_date'] . ' ago'; ?></em>
                </li>
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
            <a href="<?php echo $data['forecaster'][0]['news_url']; ?>">
            	<div class="forecaster-img">
                	<img src="<?php echo $data['forecaster']['0']['image_300']; ?>" class="img-responsive" width="100%;">
                </div>
                <!-- <div class="forecaster-heading">
                	<?php echo $data['forecaster']['0']['headline']; ?>
                </div> -->
                <div class="forecaster-description">
                	<div>
                        <?php echo $data['forecaster']['0']['summary']; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>

        </div>
        <div style="clear:both"></div>
        <div class="ads-container">
            <a href="http://magazine.dalaltimes.com/" target="_blank" style="text-decoration: none;">
        	   <img src="<?php echo _CONST_IMAGE_URL; ?>magazine_promo.gif" class="img-responsive middle-align" >
            </a>
        </div>
        <div class="ads-container">
            <a href="http://ringthebell.dalaltimes.com/" target="_blank" style="text-decoration: none;">
        	<img src="<?php echo _CONST_IMAGE_URL; ?>rtb_promo.jpg" class="img-responsive middle-align" >
            </a>
        </div>
    </div>
</div>
<div style="clear:both"></div>
<div class="category-section">
	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16">
        <div class="hidden-xs category-image">
            <a class="subovrimg" href="<?php echo $data['news-widget'][0]['category_url']; ?>">
                <span class="subsechead category-blue-bkgrnd" >News</span>
            </a>
            <img style="cursor: pointer; width:100%;" src="<?php echo $data['news-widget'][0]['image_300']; ?>">
            <div class="headovrimg">
                <a href="<?php echo $data['news-widget'][0]['news_url']; ?>" class="category-img-heading"><?php echo $data['news-widget'][0]['headline']; ?></a>
             </div>
         </div>
        <div class="news-category category-blue-bkgrnd visible-xs-block">
            News
            <span class="view-all"><a href="<?php echo $data['news-widget'][0]['category_url']; ?>">View All >></a></span>
        </div>
        <div id="category-news">
            <ul>
                                        <?php
unset($data['news-widget'][0]);
$total_articles = count($data['news-widget']);
foreach ($data['news-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
<li class="<?php echo $li_class; ?>"><i class="fa fa-arrow-right"></i><a href="<?php echo $value['news_url']; ?>"><?php echo $value['headline']; ?></a></li>
<?php
}
?>
            </ul>
        </div>
    </div>
	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16">
    	<div class="category-image hidden-xs">
            <a class="subovrimg" href="<?php echo $data['earnings-widget'][0]['category_url']; ?>">
                <span class="subsechead category-orange-bkgrnd">Earnings</span>
            </a>
            <img style="cursor: pointer; width:100%;" src="<?php echo $data['earnings-widget'][0]['image_300']; ?>">
            <div class="headovrimg">
                <a href="<?php echo $data['earnings-widget'][0]['news_url']; ?>" class="category-img-heading"><?php echo $data['earnings-widget'][0]['headline']; ?></a>
             </div>
         </div>
        <div class="news-category category-orange-bkgrnd visible-xs-block">
            Earnings
            <span class="view-all"><a href="<?php echo $data['earnings-widget'][0]['category_url']; ?>">View All >></a></span>
        </div>
        <div id="category-news">
            <ul>
<?php
unset($data['earnings-widget'][0]);
$total_articles = count($data['earnings-widget']);
foreach ($data['earnings-widget'] as $key => $value) {
	$li_class = ($total_articles == $key) ? 'last' : '';
	?>
    <li class="<?php echo $li_class; ?>"><i class="fa fa-arrow-right"></i><a href="<?php echo $value['news_url']; ?>"><?php echo $value['headline']; ?></a></li>
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
            <a href="<?php echo $data['chart-of-the-day'][0]['news_url']; ?>">
            	<div class="chart-of-the-day-img">
                	<img src="<?php echo $data['chart-of-the-day']['0']['image_300']; ?>" class="img-responsive" width="100%;">
                </div>
                <div class="chart-of-the-day-headline">
                	<?php echo $data['chart-of-the-day']['0']['headline']; ?>
                </div>
                <div class="chart-of-the-day-desc">
                	<?php echo $data['chart-of-the-day']['0']['summary']; ?>
                </div>
            </a>
        </div>
    </div>
	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 PT16 PL16 PR16">
    	<div class="twitter-container">
            <a class="twitter-timeline"  href="https://twitter.com/dalaltimes" data-widget-id="658551591054766080">Tweets by @dalaltimes</a>
        </div>
    </div>
</div>
<div style="clear:both"></div>
<?php
include_once _CONST_VIEW_PATH . 'website_footer.php';
?>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
</div>
</body>
</html>
