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
    generateArticlePage = function(_articleDetails){
      return [
      '<article id="article-'+_articleDetails.autono+'" class="article article-block">',
            '<header>',
                '<h1>'+_articleDetails.headline+'</h1>',
                '<div class="byline">',
                    '<span class="article-source"></span>',
                    '<span class="article-timestamp">'+_articleDetails.publish_date+'</span>',
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
                    '<span class="image-name"><i class="fa fa-camera fa-lg"></i> '+_articleDetails.image_name+'</span>',
                    '<span class="image-courtesy">Courtesy : [IMAGE COURTESY]</span>',
                '</figcaption>',
            '</figure>',
            '<div class="article-body">',
                '<div class="col-md-8 col-lg-7 col-lg-offset-2 article-content">',
                    '<div>',
                        _articleDetails.content,
                    '</div>',
                '</div>',
                '<div class="col-md-4 col-lg-3 hidden-sm hidden-xs">',
                    '<div id="news-widget" style="background-color: #000;height:200px;">',
                    '[WIDGET]',
                    '</div>',
                '</div>',
            '</div>',
            '<span class="hidden-title" style="display:none">' + _articleDetails.headline + '</span>',
            '<span class="hidden-url" style="display:none">' + _articleDetails.news_url + '</span>',
            '<div class="clearfix"></div>',
        '</article>'
        ].join('');
    },
    setTitleAndHistory = function(_title, _path) {
      // Set history
      history.pushState(null, _title, _path);
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
            $(settings.contentsWrapperSelector).append(generateArticlePage(res));
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
