<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang=""><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once _CONST_VIEW_PATH . 'website_tags.php';
?>
</head>
<body id="top">
<div id="body-container">
<?php
include_once _CONST_VIEW_PATH . 'menu.php';
?>
<div id="search-section">
    <div class="clearfix"></div>
    <div id="search-block">
        <div id='cse' style='width: 100%;'>Loading</div>
    </div>
    <div class="clearfix"></div>
</div>
<?php
include_once _CONST_VIEW_PATH . 'website_footer.php';
?>
</div>
<script src='//www.google.com/jsapi' type='text/javascript'></script>
<script type='text/javascript'>
google.load('search', '1', {language: 'en', style: google.loader.themes.V2_DEFAULT});
google.setOnLoadCallback(function() {
  var customSearchOptions = {};
  var orderByOptions = {};
  orderByOptions['keys'] = [{label: 'Relevance', key: ''} , {label: 'Date', key: 'date'}];
  customSearchOptions['enableOrderBy'] = true;
  customSearchOptions['orderByOptions'] = orderByOptions;
  var customSearchControl =   new google.search.CustomSearchControl('002478022497790968145:m7231jpvxsm', customSearchOptions);
  customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
  var options = new google.search.DrawOptions();
  options.enableSearchResultsOnly();
  customSearchControl.draw('cse', options);
  function parseParamsFromUrl() {
    var params = {};
    var parts = window.location.search.substr(1).split('&');
    for (var i = 0; i < parts.length; i++) {
      var keyValuePair = parts[i].split('=');
      var key = decodeURIComponent(keyValuePair[0]);
      params[key] = keyValuePair[1] ?
          decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
          keyValuePair[1];
    }
    return params;
  }
  var urlParams = parseParamsFromUrl();
  var queryParamName = 'q';
  if (urlParams[queryParamName]) {
    customSearchControl.execute(urlParams[queryParamName]);
  }
}, true);
</script>



<style>
.cse .gsc-control-cse,
.gsc-control-cse {
  font-family: 'Roboto', sans-serif;
  background-color: #FFFFFF;
  border: 1px solid #dae0e5;
}
.gsc-selected-option-container{
    width: 80px !important;
}
.gsc-option-menu{
    top:28px !important;
}
.cse .gsc-tabHeader.gsc-tabhActive, .gsc-tabHeader.gsc-tabhActive, .cse .gsc-tabHeader.gsc-tabhInactive, .gsc-tabHeader.gsc-tabhInactive{
    height:26px;
}
.gsc-control-cse, .gsc-control-cse .gsc-table-result{
    font-size:1em;
}

.cse .gsc-webResult.gsc-result, .gsc-webResult.gsc-result, .gsc-imageResult-classic, .gsc-imageResult-column{
    margin: 15px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 20px;
}
.cse .gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link, .cse .gs-webResult.gs-result a.gs-title:link b, .gs-webResult.gs-result a.gs-title:link b, .cse .gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited, .cse .gs-webResult.gs-result a.gs-title:visited b, .gs-webResult.gs-result a.gs-title:visited b, .cse .gs-webResult.gs-result a.gs-title:hover, .gs-webResult.gs-result a.gs-title:hover, .cse .gs-webResult.gs-result a.gs-title:hover b, .gs-webResult.gs-result a.gs-title:hover b, .cse .gs-webResult.gs-result a.gs-title:active, .gs-webResult.gs-result a.gs-title:active, .cse .gs-webResult.gs-result a.gs-title:active b, .gs-webResult.gs-result a.gs-title:active b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b, .gs-imageResult a.gs-title:hover, .gs-imageResult a.gs-title:hover b, .gs-imageResult a.gs-title:active, .gs-imageResult a.gs-title:active b, .cse .gsc-cursor-page, .gsc-cursor-page, .cse a.gsc-trailing-more-results:link, a.gsc-trailing-more-results:link, .cse .gs-spelling a, .gs-spelling a{
    color:#000000;
    font-size: 20px;
    font-weight: 700;

}
.gsc-table-cell-snippet-close, .gs-promotion-text-cell{
    padding:10px;
}
.cse .gs-webResult .gs-snippet, .gs-webResult .gs-snippet, .gs-fileFormatType, .gs-imageResult .gs-snippet{
    color:#000;
    font-size: 15px;
}
.gsc-thumbnail{
    display: none;
}
/*.gsc-table-cell-thumbnail, .gs-promotion-image-cell{
    display: none;
}*/
/* Do no display the count of search results */
.gsc-result-info {
     display: none;
}

/* Hide the Google branding in search results */
.gcsc-branding {
    display: none;
}

/* Hide the thumbnail images in search results */
.form .gsc-thumbnail {
    display: none;
}

/* Hide the snippets in Google search results */
.gs-snippet {

}

/* Change the font size of the title of search results */
.gs-title a {
    font-size: 14px;
}

/* Change the font size of snippets inside search results */
.gs-snippet {
    font-size: 12px;
}

/* Google Custom Search highlights matching words in bold, toggle that */
.gs-title b, .gs-snippet b {
    font-weight: normal;
}

/* Do no display the URL of web pages in search results */
.gsc-url-top, .gsc-url-bottom {
    display: none;
}

.gsc-result .gs-title{
    height:unset;
}

</style>
</body>
</html>
