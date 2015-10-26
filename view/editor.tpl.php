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
                                    <div class="modal fade" id="imageGalleryModal" role="dialog" aria-labelledby="imageGalleryModalBox" aria-hidden="true">
                                        <div class="modal-dialog" style="width:90%;height: 90%">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                  <iframe src="/image/gallery" width="100%" height="500px" ></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                    <form id="defaultForm" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left" action="/news/editor/savearticle">
                                        <input type="hidden" name="articleId" id="articleId" value="<?php echo $this->articleParams['articleId'];?>" />
                                        <input type="checkbox" name="publish" id="publish" value='true' <?php echo $this->articleParams['publish'];?> style="display: none;" />
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="form-group">
                                                    <label>Heading</label>
                                                    <input type="text" class="form-control" name="heading" name="heading" autocomplete="off" value="<?php echo $this->articleParams['heading'];?>" />
                                                    <span style="float:right;">Max 70 chars</span>
                                                </div>
                                                <div class="form-group">
                                                    <label>SMS Heading</label>
                                                    <input type="text" class="form-control" name="sms_heading" name="sms_heading" autocomplete="off" value="<?php echo $this->articleParams['sms_heading'];?>" />
                                                    <span style="float:right;">Max 70 chars</span>
                                                </div>

                                                <div class="form-group">
                                                    <label>Summary</label>
                                                    <textarea type="text" class="form-control" name="summary" id="summary" autocomplete="off"><?php echo $this->articleParams['summary'];?></textarea>
                                                    <span style="float:right;">Max 300 chars</span>
                                                </div>

                                                <div class="form-group">
                                                    <label>Story</label>
                                                    <textarea class="show-editor" name="news_content" style="width: 100%; overflow: hidden; word-wrap: break-word; resize: horizontal; height: 250px;"><?php echo $this->articleParams['news_content'];?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-default" type="button" onclick="addKeywords();"><i class="fa fa-plus-circle"></i> Add Keywords</button>
                                                    <button class="btn btn-default" type="button" onclick="addImageInsideEditor();"><i class="fa fa-file-image-o"></i> Add Images</button>
                                                </div>

                                            </div>
                                            <div class="x_panel">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <strong>Add Attachments</strong>
                                                    </div>
                                                    <div class="fileupload-buttonbar">
                                                        <div class="col-sm-12">
                                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                                            <span class="btn btn-success fileinput-button">
                                                                <i class="glyphicon glyphicon-plus"></i>
                                                                <span>Add files...</span>
                                                                <input type="file" name="files[]" multiple>
                                                            </span>
                                                            <button type="submit" class="btn btn-primary start">
                                                                <i class="glyphicon glyphicon-upload"></i>
                                                                <span>Start upload</span>
                                                            </button>
                                                            <button type="reset" class="btn btn-warning cancel">
                                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                                <span>Cancel upload</span>
                                                            </button>
                                                            <button type="button" class="btn btn-danger delete">
                                                                <i class="glyphicon glyphicon-trash"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                            <input type="checkbox" class="toggle">
                                                            <!-- The global file processing state -->
                                                            <span class="fileupload-process"></span>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </div>
                                                    <div class="fileupload-progress fade">
                                                        <!-- The global progress bar -->
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                        </div>
                                                        <!-- The extended global progress state -->
                                                        <div class="progress-extended">&nbsp;</div>
                                                    </div>
                                                    <!-- The table listing the files available for upload/download -->
                                                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="x_panel">
                                                <div class="form-group">
                                                    <label>Publish Date & Time</label>
                                                    <div class="input-prepend input-group">
                                                        <span class="add-on input-group-addon" id="pub_dt_icon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                        <input type="text" readonly="readonly" class="form-control date-picker" value="<?php echo date('d-m-Y H:i:s');?>" name="publish_date" id="publish_date" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Modified Date & Time</label>
                                                    <div class="input-prepend input-group">
                                                        <span class="add-on input-group-addon" id="mod_dt_icon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                        <input type="text" readonly="readonly" class="form-control date-picker" value="<?php echo date('d-m-Y H:i:s');?>" name="mod_date" id="mod_date" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Author Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $this->articleParams['author_name'];?>" name="author_name" readonly="readonly" />
                                                    <input type="hidden" name="author_id" value="<?php echo $this->articleParams['author_id'];?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Publisher Name <?php echo $this->articleParams['publisher_id'];?></label>
                                                    <input type="text" class="form-control" name="publisher_name" value="<?php echo $this->articleParams['publisher_name'];?>" readonly="readonly" />
                                                    <input type="hidden" name="publisher_id" value="<?php echo $this->articleParams['publisher_id'];?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select class="form-control" name="news_category" id="news_category">
                                                        <option value="">Please select News Category</option>
                                                        <?php foreach ($data['mainCategory'] as $key => $value) {
	if ($this->articleParams['news_category'] == $key) {
		echo '<option value="' . $key . '" selected>' . ucwords(strtolower($value)) . '</option>';
	} else {
		echo '<option value="' . $key . '" >' . ucwords(strtolower($value)) . '</option>';
	}

}
?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sub Category</label>
                                                    <select class="form-control" name="news_subcategory" id="news_subcategory">
                                                        <option value="">Please select News Sub Category</option>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label>Source</label>
                                                    <select class="form-control" name="news_source" id="news_source">
                                                        <option value="">Please select News Source</option>
                                                        <?php foreach ($data['newsSource'] as $key => $value) {
	if ($this->articleParams['news_source'] == $key) {
		echo '<option value="' . $key . '" selected>' . $value . '</option>';
	} else {
		echo '<option value="' . $key . '">' . $value . '</option>';
	}
}
?>
                                                    </select>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Keywords </label>
                                                    <input type="text" class="form-control" value="<?php echo $this->articleParams['keywords'];?>" name="keywords" id="keywords" />
                                                </div>
                                                <div class="form-group">
                                                     <select class="js-data-example-ajax" style="width:100%" name="related_story" id="related_story">
                                                     <?php
if (isset($this->articleParams['related_story'])) {
	echo '<option value="' . $this->articleParams['related_story'] . '" selected="selected" >' . $this->articleParams['related_heading'] . ' (Autono:' . $this->articleParams['related_story'] . ')</option>';
}
?>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="assign_to_production"><input type="checkbox" name="assign_to_production" id="assign_to_production" value='true' /> Assign to Production</label>
                                                </div>
                                                <div class="form-group ">
                                                    <input type="hidden" name="image_id" id="image_id" value="<?php echo $this->articleParams["image_id"];?>">
                                                    <button value="" type="button" class="btn btn-success" id="image_gallery" style="width:100%;"><i class="fa fa-picture-o"></i> <?php echo $imgGalleryText = $this->articleParams["image_id"] == "" ? 'Add Image' : 'Change Image';?></button>
                                                </div>
                                                <div class="form-group" id="gallery_image_300">
                                                <?php if ($this->articleParams["image_id"] != '') {?>
                                                <img src="<?php echo $this->articleParams["image_300"];?>" class="img-responsive" style="margin:0 auto;width:100%"/>
                                                <button type="button" class="btn btn-danger" id="remove-image" onclick="removeImage();" style="width:100%;"><i class="fa fa-picture-o"></i> Remove Image</button>
                                                <?php }
?>
                                                </div>
                                            </div>
                                            <div class="x_panel">
                                                <div class="col-sm-12 text-center">

                                                <?php
if ($this->articleParams['articleId'] != '') {
	echo '

                                                        <a href="/news/latest" class="btn btn-dark"><i class="fa fa-chevron-left"></i> Back </a>


                                                        <a href="/news/preview/' . $this->articleParams['articleId'] . '" class="btn btn-success"><i class="fa fa-eye  "></i> Preview </a>


                                                        <button type="submit" class="btn btn-primary" id="validateButton"><i class="fa fa-floppy-o"></i> Save </button>
';
} else {
	echo '

                                                        <a href="/news/latest" class="btn btn-dark"><i class="fa fa-chevron-left"></i> Back </a>

                                                        <button type="submit" class="btn btn-primary" id="validateButton"><i class="fa fa-floppy-o"></i> Save</button>
';

}
?>

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
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>/formvalidation/formValidation.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>/formvalidation/framework/bootstrap.js"></script>
<!-- Datepicker -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>jquery.datetimepicker.full.js"></script>
<!-- select2 -->
<script type="application/javascript" src="<?php echo _CONST_JS_PATH;?>select/select2.full.js"></script>

<!-- editor -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>tinymce/tinymce.min.js"></script>

<!-- Tag Inputs -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>tags/jquery.tagsinput.js"></script>


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
            {% if (!file.error) { %}
                <input type="hidden" name="uploaded_attachments[]" value="{%=file.fileId%}">
            {% } %}
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
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
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

<script type="text/javascript">
$('#keywords').tagsInput({
    'defaultText':'Keywords',
    'removeWithBackspace' : false,
    'width':'100%',
    'delimiter': ',',
    onChange:revalidateField
});

function revalidateField(){
    $('#defaultForm').formValidation('revalidateField', 'keywords');
}

function addKeywords(){
    var keyword = tinyMCE.activeEditor.selection.getContent({format : 'text'});
    if(!$('#keywords').tagExist(keyword)){
        $("#keywords").addTag(keyword);
    }
}

function removeImage(){
    $("#image_id").val('');
    $("#gallery_image_300").empty();
}

function formatRepo (repo) {
    if (repo.loading) return repo.text;

    var markup = '<div class="clearfix">' +
    '<div clas="col-sm-12">' +
    '<div class="clearfix">' +
    '<div class="col-sm-12">' + repo.headline + '</div>' +
    '</div>';


    markup += '</div></div>';

    return markup;
}

function formatRepoSelection (repo) {
    console.log(repo.headline);
    if(repo.id=='' || (typeof(repo.headline)=='undefined'))
        return repo.text;
    return '<strong>'+repo.headline+' (Autono '+repo.autono+')</strong>' || repo.text;
}



$(document).ready(function() {
    loadNewsSubcategories('<?php echo $this->articleParams["news_category"];?>','<?php echo $this->articleParams["news_subcategory"];?>','news_subcategory','id');
    $('#publish_date, #mod_date').datetimepicker({
      format:'d-m-Y H:i:s',
      lang:'en',
      defaultDate:'<?php echo date("d-m-Y H:i:s");?>',
      maxDate:'<?php echo date("d-m-Y");?>',
      step:1
    });

    $('#pub_dt_icon').click(function(){
        $('#publish_date').datetimepicker('show'); //support hide,show and destroy command
    });

    $('#mod_dt_icon').click(function(){
        $('#mod_date').datetimepicker('show'); //support hide,show and destroy command
    });




    $(".js-data-example-ajax").select2({
        placeholder: "Search Related Story",
        allowClear: true,
        id: function(e){return e.autono;},
      ajax: {
        url: "/news/search/story",
        dataType: 'json',
        delay: 250,

        data: function (params) {
          return {
            search: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data, page) {
          // parse the results into the format expected by Select2.
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data
          return {
            results: data.rows
          };
        },
        cache: true
      },
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      minimumInputLength: 1,
      templateResult: formatRepo, // omitted for brevity, see the source of this page
      templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    })
    .on("change", function() {
          // fired to the original element when the dropdown closes
          console.log("changed");
    })
    .on("select2:close", function() {
          // fired to the original element when the dropdown closes
          console.log("close");
    });

    $('#news_category').on('change', function(e){
        loadNewsSubcategories(this.value,'','news_subcategory','id');
    });

    $('#defaultForm').formValidation({
        message: 'This value is not valid',
        button: {
            selector: '#validateButton',
            disabled: 'disabled'
        },
//        live: 'disabled',
        icon: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        excluded:':disabled',
        fields: {
            heading: {
                message: 'Please provide appropriate Heading for the article',
                validators: {
                    notEmpty: {
                        message: 'Please provide appropriate Heading for the article'
                    },
                    stringLength:{
                        trim:true,
                        max:70,
                        message:'Article heading cant be more than 70 chars'
                    }

                }
            },
            sms_heading: {
                message: 'Please provide appropriate SMS Heading for the article',
                validators: {
                    notEmpty: {
                        message: 'Please provide appropriate SMS Heading for the article'
                    },
                    stringLength:{
                        trim:true,
                        max:70,
                        message:'Article\'s SMS Heading can\'t be more than 70 chars'
                    }
                }
            },
            summary: {
                message: 'Please provide short summary for the article',
                validators: {
                    notEmpty: {
                        message: 'Article needs to have short summary'
                    },
                    stringLength:{
                        trim:true,
                        max:300,
                        message:'Article\'s summary can\'t be more than 300 chars'
                    }
                }
            },
            news_content: {
                message: 'Please provide story for the article',
                validators: {
                    callback: {
                        message: 'Please provide story for the article',
                        callback: function (value, validator, $field) {
                            // Get the plain text without HTML
                            var text = tinyMCE.activeEditor.getContent({
                                format: 'text'
                            });

                            return text.length > 0;
                        }
                    }
                }
            },
            keywords: {
                message: 'Article need to have atleast one keyword',
                validators: {
                    callback: {
                        message: 'Article need to have atleast one keyword',
                        callback: function (value, validator, $field) {
                            var text = $('#keywords').val();
                            return text.length > 0;
                        }
                    }
                }
            },
            news_category: {
                message: 'Please select the News Category for the Article',
                validators: {
                    notEmpty: {
                        message: 'Article needs to belong to any one of the category',
                    },
                }
            },
            news_subcategory: {
                message: 'Please select the News Category for the Article',
                validators: {
                    notEmpty: {
                        message: 'Article needs to belong to any one of the category',
                    },
                }
            },
            news_source: {
                message: 'Please select the News Source for the Article',
                validators: {
                    notEmpty: {
                        message: 'Article needs to belong to any one of the source',
                    },
                }
            }


        }
    })
    .on('success.form.fv', function(e) {
        console.log('inside success');
    })
    .on('err.field.fv', function(e, data) {
        console.log(data.field, data.validator);
    });
});

tinymce.init({
    selector: "textarea.show-editor",
    theme: "modern",
    plugins: [
        "localautosave advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
    content_css : "<?php echo _CONST_JS_PATH;?>tinymce/skins/modified.css",
    toolbar1: "localautosave | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    toolbar2: "print preview media | forecolor backcolor emoticons | link image ",
    image_advtab: true,
     /*Excel copy-paste Utility :Starts*/
    paste_retain_style_properties : "all",
    paste_strip_class_attributes : "none",
   //paste_remove_spans : true,
  /*Excel copy-paste Utility :Ends*/
    setup: function(editor){
        editor.on('keyup', function(e) {
            $('#defaultForm').formValidation('revalidateField', 'news_content');
        });
    }
});
$('#image_gallery').click(function() {
    /*$('#imageModal img').attr('src', $(this).attr('data-img-url'));*/
    $('#imageGalleryModal').modal('show');
});
function addImageInsideEditor(){
    $('#imageGalleryModal').modal('show');
}
</script>
</body>
</html>
