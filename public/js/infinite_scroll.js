/**
 * jquery.clever-infinite-scroll.js
 * Working with jQuery 2.1.4
*/
/* global define, require, history, window, document, location  */
(function(root, factory){
  "use strict";
  if (typeof define === "function" && define.amd) {
    define(["jquery"], factory);
  } else if (typeof exports === "object") {
    factory(require("jquery"));
  } else {
    factory(root.jQuery);
  }
})(this, function($) {
  "use strict";
  /**
   * Elements it reffers. Each page must has those selectors.
   * The structure must be same as article1.html
   * #contentsWrapper, .content, #next
  */
  $.fn.cleverInfiniteScroll = function(options) {
    /**
     * Settings
    */
    var windowHeight = (typeof window.outerHeight !== "undefined") ? Math.max(window.outerHeight, $(window).height()) : $(window).height(),
    defaults = {
      contentsWrapperSelector: "#contentsWrapper",
      contentSelector: ".content",
      nextSelector: "#next",
      loadImage: "",
      offset: windowHeight,
    }, settings = $.extend(defaults, options);

    /**
     * Private methods
    */
    var generateHiddenSpans = function(_title, _path) {
      return "<span class='hidden-title' style='display:none'>" + _title + "</span><span class='hidden-url' style='display:none'>" + _path + "</span>";
    },
    $active_article = null,
    generateSocialButtons = function(_heading,_summary,_url){
      return [
        '<div class="social-share-block">',
          '<ul>',
              '<li>',
                  '<a href="http://twitter.com/share?url='+_url+'&text='+_heading+'&via=dalaltimes" target="_blank" class="share-btn twitter">',
                      '<i class="fa fa-twitter"></i>',
                  '</a>',
              '</li>',
              '<li>',
                  '<a href="https://plus.google.com/share?url='+_url+'" target="_blank" class="share-btn google-plus">',
                      '<i class="fa fa-google-plus"></i>',
                  '</a>',
              '</li>',
              '<li>',
                  '<a href="http://www.facebook.com/sharer/sharer.php?u='+_url+'" target="_blank" class="share-btn facebook">',
                      '<i class="fa fa-facebook"></i>',
                  '</a>',
              '</li>',
              '<li>',
                  '<a href="http://www.linkedin.com/shareArticle?url='+_url+'&title='+_heading+'&summary='+_summary+'&source='+_CONST_WEB_URL+'" target="_blank" class="share-btn linkedin">',
                      '<i class="fa fa-linkedin"></i>',
                  '</a>',
              '</li>',
              '<li>',
                  '<a href="mailto:?subject='+_heading+'&body='+_summary+' <br> <a href=\''+_url+'\'>Click here to read more</a>" target="_blank" class="share-btn email">',
                      '<i class="fa fa-envelope"></i>',
                  '</a>',
              '</li>',
          '</ul>',
      '</div>'
    ].join('');
    },
    generateRelatedStoryBlock = function(_details){
      return[
        '<div class="col-xs-12 col-sm-6 col-md-6 PL16 PR16">',
          '<a href="'+_details.news_url+'">',
              '<div class="relatedarticle-img">',
                  '<img width="100%;" class="img-responsive" src="'+_CONST_WEB_URL + _details.image_300+'">',
              '</div>',
              '<div class="relatedarticle-description">',
                  '<div>',
                      _details.headline,
                  '</div>',
                  '<div class="clearfix"></div>',
              '</div>',
          '</a>',
        '</div>'
      ].join('');
    },
    generateArticlePage = function(_articleDetails,_newsWidget){
      var social_buttons = generateSocialButtons(encodeURIComponent(_articleDetails.headline),encodeURIComponent(_articleDetails.summary),encodeURIComponent(_articleDetails.news_url));
      _newsWidget = _newsWidget.replace("tab-two", 'rhs-'+_articleDetails.autono+'-two');
      _newsWidget = _newsWidget.replace("tab-one", 'rhs-'+_articleDetails.autono+'-one');
      _newsWidget = _newsWidget.replace("tab-one", 'rhs-'+_articleDetails.autono+'-one');
      _newsWidget = _newsWidget.replace("tab-two", 'rhs-'+_articleDetails.autono+'-two');
      var leftcol = '';
      var rightcol = '';
      var img_courtesy = '';
      if(_articleDetails['related-news']['left-col']!=null){
        leftcol = generateRelatedStoryBlock(_articleDetails['related-news']['left-col']);
      }
      if(_articleDetails['related-news']['right-col']!=null){
        rightcol = generateRelatedStoryBlock(_articleDetails['related-news']['right-col']);
      }

      if(_articleDetails['image_courtesy']!=null && _articleDetails['image_courtesy']!=''){
        img_courtesy = '<span class="image-courtesy">Courtesy :'+_articleDetails['image_courtesy']+' </span>';
      }
      return [
      '<article id="article-'+_articleDetails.autono+'" class="article article-block">',
            '<header>',
                '<h1>'+_articleDetails.headline+'</h1>',
                '<div class="byline">',
                    '<span class="article-source">'+_articleDetails.news_source_name+'</span>',
                    '<span class="article-timestamp">'+_articleDetails.disp_date+'</span>',
                '</div>',
            '</header>',
            '<figure class="article-image size-extra-large ">',
                '<picture>',
                    '<source srcset="'+_articleDetails.image_1600+'" media="(min-width: 1280px)">',
                    '<source srcset="'+_articleDetails.image_1280+', '+_articleDetails.image_1600+' 2x" media="(min-width: 769px)">',
                    '<source srcset="'+_articleDetails.image_615+', '+_articleDetails.image_1280+' 2x" media="(min-width: 450px)">',
                    '<img itemprop="image" srcset="'+_articleDetails.image_300+'" alt="" title="" class="img-responsive">',
                '</picture>',
                '<figcaption class="article-image-slug">',
                    img_courtesy,
                '</figcaption>',
            '</figure>',
            '<div class="article-body">',
                '<div class="col-md-8 col-lg-7 col-lg-offset-2 article-content">',
                    social_buttons,
                    '<div>',
                        _articleDetails.content,
                    '</div>',
                    social_buttons,
                    '<div class="related-story">',
                        '<div class="col-xs-12">',
                            leftcol,
                            rightcol,
                        '</div>',
                    '</div>',
                '</div>',
                '<div class="col-md-4 col-lg-3 hidden-sm hidden-xs">',
                    '<div class="news-widget">',
                    _newsWidget,
                    '</div>',
                '</div>',
            '</div>',
            '<span class="hidden-title" style="display:none">' + _articleDetails.headline + '</span>',
            '<span class="hidden-url" style="display:none">' + _articleDetails.news_url + '</span>',
            '<div class="clearfix"></div>',
        '</article>'
        ].join('');
    },
    $newsWidget = null,
    $widgetPos = {'top_position':0,'widget_height':0,'bumperPos':0,'widget_block':null},
    widgetFollow = function (active_article) {
      var widget_block = active_article.find('.news-widget');
      $widgetPos.top_position =  widget_block.offset().top,
      $widgetPos.widget_height = widget_block.outerHeight(true),
      $widgetPos.bumperPos = active_article.find('.article-content').offset().top+active_article.find('.article-content').outerHeight(true);
      $widgetPos.widget_block = widget_block;
    },
    setTitleAndHistory = function(_title, _path) {
      // Set history
      history.replaceState(null, _title, _path);
      // Set title
      $("title").html(_title);
    },
    changeTitleAndURL = function(_value) {
      // value is an element of a content user is seeing
      // Get title and path of the article page from hidden span elements
      var title = $(_value).children(".hidden-title:first").text(),
        path = $(_value).children(".hidden-url:first").text();
      if($("title").text() !== title) {
        // If it has changed
        $(settings.contentSelector).removeClass("active");
        $(_value).addClass("active");
        /*$active_article = $(_value);
        widgetFollow($(_value));*/
        setTitleAndHistory(title, path);
      }
    };

    /**
     * Initialize
    */
    // Get current page's title and URL.
    var title = $("title").text(),
      path = $(location).attr("href"),
      documentHeight = $(document).height(),
      threshold = settings.offset,
      $contents = $(settings.contentSelector);
    // Set hidden span elements and history
    $(settings.contentSelector + ":last").append(generateHiddenSpans(title, path));
    $(settings.contentSelector).addClass("active");
    $newsWidget = $(settings.contentSelector).find('#news-widget').html();
    /*$active_article = $(settings.contentSelector);*/
    /*widgetFollow($(settings.contentSelector));*/
    /*setTitleAndHistory(title, path);*/

    /**
     * scroll
    */
    var lastScroll = 0, currentScroll;
    $(window).scroll(function() {
      // Detect where you are
      window.clearTimeout($.data("this", "scrollTimer"));
      $.data(this, "scrollTimer", window.setTimeout(function() {
        // Get current scroll position
        currentScroll = $(window).scrollTop();


        // Detect whether it's scrolling up or down by comparing current scroll location and last scroll location
        if(currentScroll > lastScroll) {
          // If it's scrolling down
          $contents.each(function(key, value) {
            if($(value).offset().top + $(value).height() > currentScroll) {
              // Change title and URL
              changeTitleAndURL(value);
              // Quit each loop
              return false;
            }
          });
        } else if(currentScroll < lastScroll) {
          // If it's scrolling up
          $contents.each(function(key, value) {
            if($(value).offset().top + $(value).height() - windowHeight / 2 > currentScroll) {
              // Change title and URL
              changeTitleAndURL(value);
              // Quit each loop
              return false;
            }
          });
        } else {
          // When currentScroll == lastScroll, it does not do anything because it has not been scrolled.
        }
        // Renew last scroll position
        lastScroll = currentScroll;
      }, 200));
      /*if($(window).scrollTop() + header_height > $widgetPos.top_position && $(window).scrollTop()+header_height+ $widgetPos.widget_height< $widgetPos.bumperPos){
        $widgetPos.widget_block.addClass("stick");
        $widgetPos.widget_block.css({'top':header_height+30});
      }else{
        $widgetPos.widget_block.removeClass("stick");
        $widgetPos.widget_block.css({'top':''});
      }*/
      if($(window).scrollTop() + windowHeight + threshold >= documentHeight) {
        // If scrolling close to the bottom
        if(load_story < DT_SS_LENGTH) {
          var res = DT_SS[load_story];
          console.log(res.autono);
          if(res.autono==ARTICLE_LOADED){
            console.log("333");
            load_story++;
            var cntr = load_story;
            res = DT_SS[cntr];
            console.log(cntr);
          }

          if(typeof(res)!='undefined'){
            // If the page has link, call ajax
            $(settings.contentsWrapperSelector).append('<div class="spinner"><div class="rect1 "></div>&nbsp;<div class="rect2 "></div>&nbsp;<div class="rect3 "></div>&nbsp;<div class="rect4 "></div>&nbsp;<div class="rect5 "></div>&nbsp;</div>');
            $(settings.contentsWrapperSelector).append(generateArticlePage(res,$newsWidget));
            documentHeight = $(document).height();
            $contents = $(settings.contentSelector);
            $(".spinner").remove();
            load_story++;
          }
        }
      }
    }); //scroll

    return (this);
  }; //$.fn.cleverInfiniteScroll
});
