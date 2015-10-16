<!DOCTYPE html>
<html lang="en">
<?php
include_once _CONST_VIEW_PATH . 'header.php';
?>
<body class="nav-sm">
    <div class="container body">
        <div class="main_container">
            <!-- SIDEBARE MENU -->
            <?php
include_once _CONST_VIEW_PATH . 'sidebar_menu.php';
?>
            <!-- /SIDEBARE MENU -->
            <!-- top navigation -->
            <?php
include_once _CONST_VIEW_PATH . 'top_nav.php';
?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?php echo self::$pageTitle;?></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="" style="min-height:900px;">
                                <div class="x_title">
                                    <h2><?php echo self::$pageSubTitle;?></h2>
                                    <ul class="nav navbar-right panel_toolbox MT3">
                                        <!-- <li><a class="btn btn-primary btn-xs" style="background-color: #1479b8" href='<?php echo $this->_data['url']['add'];?>'>Add New</a>
                                        </li> -->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                    <form  method="POST" id="defaultForm" action="/news/editor/publisharticle">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h3><?php echo $this->articleParams['heading'];?></h3>
                                            <h4><em><?php echo $this->articleParams['summary'];?></em></h4>
                                            <div>
                                            Category : <strong><?php echo $data['mainCategory'][$this->articleParams['news_category']];?></strong>
                                            Sub-Category : <strong><?php echo $data['subCategory'][$this->articleParams['news_subcategory']];?></strong>
                                            Source : <strong><?php echo $data['newsSource'][$this->articleParams['news_source']];?></strong>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12 col-sm-12 news_content">
                                            <input type="hidden" name="articleId" id="articleId" value="<?php echo $this->articleParams['articleId'];?>" />
                                            <input type="checkbox" name="publish" id="publish" value='true' checked style="display: none;" />
                                            <!-- blockquote -->
                                            <?php echo $this->articleParams['news_content'];?>
                                            <br>
                                            <div class="form-group">
                                                    <div class="text-left">
                                                        <strong>Attachments</strong>
                                                    </div>
                                                    <!-- The table listing the files available for upload/download -->
                                                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                                </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <h4>Keywords</h4>
                                            <?php
$keyword_arr = explode(',', $this->articleParams['keywords']);
foreach ($keyword_arr as $key => $value) {
	echo '&nbsp;<span class="label label-danger FA15">' . $value . '</span>';

}
?>
                                        </div>
                                    </div>
                                    <div class="x_panel">
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <a class="btn btn-dark" href="/news/latest"><i class="fa fa-chevron-left"></i> Back </a>
                                                <a class="btn btn-dark" href="/news/editor/compose/<?php echo $this->articleParams['articleId'];?>"><i class="glyphicon glyphicon-edit"></i> Edit Article </a>
                                                <button id="validateButton" class="btn btn-primary text-right" type="submit"><i class="glyphicon glyphicon-transfer"></i> Publish Article</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>

<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>custom.js"></script>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
    </tr>
{% } %}
</script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>jquery.ui.widget.js"></script>
<script type="text/javascript" src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>fileupload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>fileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>fileupload/jquery.fileupload-process.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>fileupload/jquery.fileupload-validate.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>fileupload/jquery.fileupload-ui.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>fileupload/main.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>common.js"></script>


</body>
</html>
