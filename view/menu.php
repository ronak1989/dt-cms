<div class="wsmenucontainer clearfix">
  <div class="wsmenucontent overlapblackbg menuclose"></div>
  <div class="wsmenuexpandermain slideRight">
    <a id="navToggle" class="animated-arrow slideLeft menuclose"><span></span></a>
    <a href="<?php echo _CONST_WEB_URL; ?>/homepage" class="smallogo"><img src="<?php echo _CONST_IMAGE_URL; ?>logo.png" alt=""></a>
    <a class="callusicon" id="c-button--search-mob" class="c-button"><span class="fa fa-search"></span></a>
  </div>
  <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  <section  class="navigation <?php echo $menuClass; ?>">
      <header style="padding:10px 0;">
        <div class="logo">
          <a href="<?php echo _CONST_WEB_URL; ?>/homepage">
            <!--[if gte IE 10]><!-->
            <!-- DT LOGO -->
              <img src="<?php echo _CONST_IMAGE_URL; ?>logo.png">
            <!-- /DT LOGO -->
          </a>
        </div>
        <div class="right">

            <a href="<?php echo _CONST_WEB_URL; ?>/latest-news"><i class="fa fa-bolt fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a>
            |
            <a href="javascript:void(0);" id="c-button--shareicons" class="c-button"><i class="fa fa-share-alt fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a>
            |
            <a href="javascript:void(0);" id="c-button--products-service" class="c-button"><i class="fa fa-briefcase fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a>
        </div>
        <div id="header-search-input"></div>
        <div class="left">
          <a href="javascript:void(0);" id="horizontal-nav-toggle"><i class="fa fa-bars fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a>
          |
          <a href="javascript:void(0);" id="c-button--search" class="c-button"><i class="fa fa-search fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a>

        </div>
          <div class="header-content bigmegamenu clearfix">
              <nav class="wsmenu slideLeft clearfix menuopen">
              <ul class="mobile-sub wsmenu-list">
                <li>
                  <a href="<?php echo _CONST_WEB_URL; ?>/homepage" class="active">Home</a>
                </li>
                <?php foreach ($menuUrl as $key => $value) {
	if (in_array(strtolower($value['name']), array("", 'budgets', 'mutual funds', 'chart of the day', 'the forecaster'))) {
		continue;
	}

	?>
                <span class="seperator">|</span>
                <li>
                  <a href="<?php echo $value['url']; ?>"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;<?php echo $value['name']; ?></a>
                </li>

                <?php
}
?>
              </ul>
            </nav>


          </div>
          <nav id="c-menu--search" class="c-menu c-menu--search">
            <!--  -->
            <div class="dark">
              <form method="get" action="/search" id="search">
                <input name="q" id="q" type="text" size="40" placeholder="Search..." />
                <label for="search-input"><i class="fa fa-search"></i></label>
                <button class="c-menu__close">X</button>
              </form>

            </div>
          </nav><!-- /c-menu search -->
          <nav id="c-menu--products-service" class="c-menu c-menu--products-service">
            <!--  -->
            <div class="share-prodcuts">
                <a href="http://dtx30.dalaltimes.com/" target="_blank">
                  DTX30
                </a>
                <a href="http://magazine.dalaltimes.com" target="_blank">
                  Dalal Times Magazine
                </a>
                <button class="c-menu__close">X</button>
            </div>
          </nav>
          <nav id="c-menu--shareicons" class="c-menu c-menu--shareicons">
            <!--  -->
            <div class="share-dark">
                <a href="https://www.facebook.com/dalaltimes" target="_blank">
                  <i class="fa fa-facebook-official "></i>
                </a>
                <a href="https://twitter.com/dalaltimes" target="_blank">
                  <i class="fa fa-twitter"></i>
                </a>
                <a href="https://in.pinterest.com/dalaltimes/" target="_blank">
                  <i class="fa fa-pinterest"></i>
                </a>
                <a href="https://www.linkedin.com/company/dalal-times" target="_blank">
                  <i class="fa fa-linkedin-square"></i>
                </a>
                <a href="https://plus.google.com/101688308367249815536/about/p/pub" target="_blank">
                  <i class="fa fa-google-plus-square"></i>
                </a>
                <button class="c-menu__close">X</button>
            </div>
          </nav><!-- /c-menu search -->
      </header>
  </section>
</div>
<div class="mobile-footerheader">
  <nav>
    <ul class="nav nav-justified">
      <li><a href="<?php echo _CONST_WEB_URL; ?>/latest-news"><i class="fa fa-bolt fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a></li>
      <li><a href="javascript:void(0);" id="c-button--shareicons-mob" class="c-button"><i class="fa fa-share-alt fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a></li>
      <li><a href="javascript:void(0);" id="c-button--products-service-mob" class="c-button"><i class="fa fa-briefcase fa-lg" style="color:#FFFFFF;padding: 0 10px;"></i></a></li>
    </ul>
  </nav>
</div>

