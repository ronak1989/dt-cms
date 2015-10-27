
// js file

var next_data_url; // replaced when loading more
var prev_data_url; // replaced when loading more
var next_data_cache;
var prev_data_cache;
var last_scroll = 0;
var is_loading = 0; // simple lock to prevent loading when loading
var hide_on_load = false; // ID that can be hidden when content has been loaded
function detailsFormatter(row){
  return [
      '<li class="stories-list-element">',
          '<a title="'+row.headline+'" class="story-link" href="">',
              '<figure >',
                '<img alt="'+row.headline+'" src="'+row.image_300+'" class="img-responsive">',
              '</figure>',
              '<div  class="content">',
                  '<h5 class="section">',
                      row.sub_category_name,
                  '</h5>',
                  '<h3>',
                      row.headline,
                  '</h3>',
                  '<div class="byline">',
                      '<div class="timestamp">'+row.news_source+' | '+row.modified_date+'</div>',
                      '<div class="clearfix"></div>',
                  '</div>',
                  '<div class="summary">',
                      row.summary,
                  '</div>',
                  '<br>',
              '</div>',
          '</a>',
      '</li>'
        ].join('');
}
function loadFollowing() {
  if (next_data_url=="") {
    console.log('inside empty next');
  } else {
    is_loading = 1; // note: this will break when the server doesn't respond
    function showFollowing(data) {
      var categoryData = JSON.parse(data.categoryDetails);
      generateHtml = '';
      $.each( categoryData['rows'], function( index, row ){
          generateHtml += detailsFormatter(row);
      });
      generateHtml = '<div class="scrollingcontent" data-url="'+data.current_url+'"><ol class="stories-list">'+generateHtml+'</ol></div>';
      $('.scrollingcontent:last').after(generateHtml);
      next_data_url = data.next_data_url;
      next_data_cache = false;
      $.getJSON(next_data_url, function(preview_data) {
        console.log('222');
        next_data_cache = preview_data;
      });
    }
    if (next_data_cache) {
      showFollowing(next_data_cache);
      is_loading = 0;
    } else {
      $.getJSON(next_data_url, function(data) {
        console.log('333');
        showFollowing(data);
        is_loading = 0;
      });
    }
  }
};

function loadPrevious() {
  if (prev_data_url=="") {
  } else {
    is_loading = 1; // note: this will break when the server doesn't respond
    function showPrevious(data) {
      var categoryData = JSON.parse(data.categoryDetails);
      generateHtml = '';
      $.each(categoryData['rows'], function( index, row ){
          generateHtml += detailsFormatter(row);
      });
      generateHtml = '<div class="scrollingcontent" data-url="'+data.current_url+'"><ol class="stories-list">'+generateHtml+'</ol></div>';
      $('.scrollingcontent:first').before(generateHtml);
      item_height = $(".scrollingcontent:first").height();
      window.scrollTo(0, $(window).scrollTop()+item_height); // adjust scroll
      prev_data_url = data.prev_data_url;
      prev_data_cache = false;
      $.getJSON(prev_data_url, function(preview_data) {
        prev_data_cache = preview_data;
      });
      if (hide_on_load) {
        $(hide_on_load).hide();
        hide_on_load = false;
      }
    }
    if (prev_data_cache) {
      showPrevious(prev_data_cache);
      is_loading = 0;
    } else {
      $.getJSON(prev_data_url, function(data) {
        console.log('555');
        showPrevious(data);
        is_loading = 0;
      });
    }
  }
};

function mostlyVisible(element) {
  // if ca 25% of element is visible
  var scroll_pos = $(window).scrollTop();
  var window_height = $(window).height();
  var el_top = $(element).offset().top;
  var el_height = $(element).height();
  var el_bottom = el_top + el_height;
  return ((el_bottom - el_height*0.25 > scroll_pos) &&
          (el_top < (scroll_pos+0.5*window_height)));
}

function initPaginator() {
  $(window).scroll(function() {

    // handle scroll events to update content
    var scroll_pos = $(window).scrollTop();
    if (scroll_pos >= 0.9*($(document).height() - $(window).height())) {
      if (is_loading==0){
        console.log('next_data_url => '+next_data_url); // replaced when loading more
        console.log('prev_data_url => '+prev_data_url); // replaced when loading more
        loadFollowing();
      }
    }
    /*console.log(0.9*$("#mycarousel").height());*/
    if (scroll_pos <= 0.9*$("#mycarousel").height()) {
      if (is_loading==0){
        console.log('next_data_url => '+next_data_url); // replaced when loading more
        console.log('prev_data_url => '+prev_data_url); // replaced when loading more
        loadPrevious();
      }
    }
    // Adjust the URL based on the top item shown
    // for reasonable amounts of items
    if (Math.abs(scroll_pos - last_scroll)>$(window).height()*0.1) {
      last_scroll = scroll_pos;
      $(".scrollingcontent").each(function(index) {
        if (mostlyVisible(this)) {
          history.replaceState(null, null, $(this).attr("data-url"));
          return(false);
        }
      });
    }
  });
  $(document).ready(function () {
    // if we have enough room, load the next batch
    if ($(window).height()>($("#mycarousel").height()+$(".scrollingcontent").height())) {
      if (next_data_url!="") {
        console.log('next_data_url => '+next_data_url); // replaced when loading more
        console.log('prev_data_url => '+prev_data_url); // replaced when loading more
        loadFollowing();
      } else {
        /*var filler = document.createElement("div");
        filler.id = "filler";
        filler.style.height = ($(window).height() -
        $(".scrollingcontent").height())+ "px";
        $(".scrollingcontent").after(filler);
        hide_on_load = "filler";*/
      }
    }
    // scroll down to hide empty room
    head_height = $(".navigation").height();
    /*nav_height = $(".navigation").height();*/
    window.scrollTo(0, head_height);
  });
}

function primeCache() {
  $.getJSON(prev_data_url, function(data) { prev_data_cache=data;        console.log('next_data_url => '+next_data_url); // replaced when loading more
        console.log('prev_data_url => '+prev_data_url); // replaced when loading more
 } );
  $.getJSON(next_data_url, function(data) { next_data_cache=data;        console.log('next_data_url => '+next_data_url); // replaced when loading more
        console.log('prev_data_url => '+prev_data_url); // replaced when loading more
 } );
}

