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
  <section class="navigation <?php echo $menuClass;?>">
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
                  <a href="<?php echo _CONST_WEB_URL;?>/homepage" class="active">Home</a>
                </li>
                <?php foreach ($menuUrl as $key => $value) {
	?>
                <span class="seperator">|</span>
                <li>
                  <a href="<?php echo $value['url'];?>"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;<?php echo $value['name'];?></a>
                </li>

                <?php
}
?>
              </ul>
            </nav>
          </div>
      </header>
  </section>
</div>
