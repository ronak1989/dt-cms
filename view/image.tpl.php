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
                                    <!-- <ul class="nav navbar-right panel_toolbox MT3">

                                    </ul> -->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel" id="upload_new">
                                                <div class="form-group">
                                                    <div class="container" id="img-uploader">
                                                        <div class="row" id="img-modal">
                                                          <form class="img-form" action="/image/upload" enctype="multipart/form-data" method="post">
                                                              <div class="img-body">
                                                                <!-- Crop and preview -->
                                                                <div class="row">
                                                                  <?php if ($data['type'] == 'article') {?>
                                                                  <div class="col-md-12">
                                                                    <h4><strong>Heading :</strong> <?php echo $this->articleParams['heading'];?></h4>
                                                                  </div>
                                                                  <?php }
?>
                                                                  <div class="col-md-3">
                                                                    <!-- Upload image and data -->
                                                                    <div class="img-upload">
                                                                      <input type="hidden" name="img_type" value="resize">
                                                                      <input type="hidden" class="img-src" name="img_src">
                                                                      <input type="hidden" class="img-data" name="img_data">
                                                                      <input type="hidden" name="news_autono" value="<?php echo $this->articleParams['articleId'];?>">
                                                                      <div class="form-group">
                                                                        <label>Local upload</label>
                                                                        <input type="file" class="img-input" id="imgInput" name="img_file">
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label >Image Name</label>
                                                                        <input id="img_name" name="img_name" type="text" class="form-control" value="" />
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label >Input Tags</label>
                                                                        <input id="img_tags" type="text" name="img_tags" class="tags form-control" value="" style="display: inline-block" />
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary btn-block img-save">Done</button>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-md-9">
                                                                    <div class="img-wrapper"></div>
                                                                    <em>The image needs to be of size 1600x900</em>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                          </form>
                                                          <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="resize-container">
                                            <div class="x_panel" >
                                                <div class="form-group">
                                                  <div class="container" >
                                                    <div class="row">
                                                      <h3>Edit Image Details</h3>
                                                    </div>
                                                    <div class="well srch_panel" id="edit_box">
                                                      <div id="operation_status"></div>
                                                      <div class="row srch_content" style="display: block;">
                                                          <div class="col-xs-6">
                                                              <div class="form-group">
                                                                Image Tags
                                                                <input id="img_id" type="hidden" name="img_id" value="<?php echo $imgDetails[0]['image_id'];?>" />
                                                                <input id="img_edit_tags" type="text" name="img_edit_tags" data-original-img-tags="<?php echo $imgDetails[0]['image_keywords'];?>" class="tags form-control" style="display: inline-block" value="<?php echo $imgDetails[0]['image_keywords'];?>" />

                                                              </div>
                                                          </div>
                                                          <div class="col-xs-6">
                                                              <div class="form-group">
                                                                Image Name
                                                                <input type="text" placeholder="" class="form-control" data-original-img-name="<?php echo $imgDetails[0]['image_name'];?>" name="img_edit_name" id="img_edit_name" value="<?php echo $imgDetails[0]['image_name'];?>">
                                                              </div>
                                                              <div class="form-group text-center">
                                                                  <button class="btn btn-default" type="button" onclick="getImageEditParams();" id="edit_details">Update Image Name & Keywords</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="x_panel" >
                                                <div class="form-group">
                                                  <div class="container" >
                                                    <div class="row">
                                                      <h1>Resized Images</h1>
                                                      <div class="title_right">
                                                          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
                                                              <ul class="nav navbar-right panel_toolbox">
                                                                  <li>
                                                                      <div class='form-group'>
                                                                          <a class="btn btn-dark text-right" href="/image/new"><i class="fa fa-pencil"></i> Upload New Image </a>
                                                                          <a class="btn btn-primary text-right" style="background-color: #1479b8" href="/image/pending-for-approval"><i class="fa fa-thumbs-up "></i> Approve Image </a>
                                                                      </div>
                                                                  </li>
                                                              </ul>
                                                          </div>
                                                      </div>
                                                    </div>
                                                    <div class="row text-left">
                                                      <div class="col-sm-6 MA10" id="crop-avatar-1280">
                                                        <!-- data-target="#avatar-modal" data-toggle="modal" -->
                                                        <div class="pdf-thumb-box avatar-view" >
                                                          <div class="pdf-thumb-box-overlay" style="left: 0px; opacity: 0.8; visibility: visible;width:100%;height:100%">
                                                              <i class="glyphicon glyphicon-eye-open"></i>1280x720
                                                          </div>
                                                          <img src="<?php echo $data['image_size'][1280];?>" id="img_1280" class="img-responsive" alt="">
                                                        </div>
                                                        <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                          <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                              <form class="avatar-form" action="/image/upload" enctype="multipart/form-data" method="post">
                                                                <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <div class="avatar-body">

                                                                    <!-- Upload image and data -->
                                                                    <div class="avatar-upload">
                                                                      <input type="hidden" class="avatar-image_id" name="avatar_image_id">
                                                                      <input type="hidden" class="avatar-image_width" name="avatar_image_width">
                                                                      <input type="hidden" class="avatar-src" name="avatar_src">
                                                                      <input type="hidden" class="avatar-data" name="avatar_data">
                                                                      <label for="avatarInput">Local upload</label>
                                                                      <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                                                    </div>

                                                                    <!-- Crop and preview -->
                                                                    <div class="row">
                                                                      <div class="col-md-9">
                                                                        <div class="avatar-wrapper"></div>
                                                                      </div>
                                                                      <div class="col-md-3">
                                                                        <div class="avatar-preview preview-lg"></div>
                                                                        <div>
                                                                          <button type="submit" class="btn btn-primary btn-block avatar-save">Crop</button>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <!-- <div class="modal-footer">
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div> -->
                                                              </form>
                                                            </div>
                                                          </div>
                                                        </div><!-- /.modal -->
                                                      </div>
                                                      <div class="col-sm-6 MA10">
                                                        <div id="crop-avatar-615">
                                                          <div class="pdf-thumb-box avatar-view">
                                                            <div class="pdf-thumb-box-overlay" style="left: 0px; opacity: 0.8; visibility: visible;width:100%;height:100%">
                                                                <i class="glyphicon glyphicon-eye-open"></i>615x346
                                                            </div>
                                                            <img src="<?php echo $data['image_size'][615];?>" id="img_615" class="img-responsive"  alt="">
                                                          </div>
                                                                  <!-- Cropping modal -->
                                                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <form class="avatar-form" action="/image/upload" enctype="multipart/form-data" method="post">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                      <!-- Upload image and data -->
                                                                      <div class="avatar-upload">.
                                                                        <input type="hidden" class="avatar-image_id" name="avatar_image_id">
                                                                        <input type="hidden" class="avatar-image_width" name="avatar_image_width">
                                                                        <input type="hidden" class="avatar-src" name="avatar_src">
                                                                        <input type="hidden" class="avatar-data" name="avatar_data">
                                                                        <label for="avatarInput">Local upload</label>
                                                                        <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                                                      </div>

                                                                      <!-- Crop and preview -->
                                                                      <div class="row">
                                                                        <div class="col-md-9">
                                                                          <div class="avatar-wrapper"></div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                          <div class="avatar-preview preview-lg"></div>
                                                                          <div>
                                                                            <button type="submit" class="btn btn-primary btn-block avatar-save">Crop</button>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <!-- <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                  </div> -->
                                                                </form>
                                                              </div>
                                                            </div>
                                                          </div><!-- /.modal -->
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row text-left">
                                                      <div class="col-sm-6 MA10">
                                                        <div class="" id="crop-avatar-300">
                                                          <div class="pdf-thumb-box avatar-view">
                                                            <div class="pdf-thumb-box-overlay" style="left: 0px; opacity: 0.8; visibility: visible;width:300px;height:169px">
                                                                <i class="glyphicon glyphicon-eye-open"></i>300x169
                                                            </div>
                                                            <img src="<?php echo $data['image_size'][300];?>" id="img_300" alt="">
                                                          </div>
                                                                  <!-- Cropping modal -->
                                                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <form class="avatar-form" action="/image/upload" enctype="multipart/form-data" method="post">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                      <!-- Upload image and data -->
                                                                      <div class="avatar-upload">
                                                                        <input type="hidden" class="avatar-image_id" name="avatar_image_id">
                                                                        <input type="hidden" class="avatar-image_width" name="avatar_image_width">
                                                                        <input type="hidden" class="avatar-src" name="avatar_src">
                                                                        <input type="hidden" class="avatar-data" name="avatar_data">
                                                                        <label for="avatarInput">Local upload</label>
                                                                        <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                                                      </div>

                                                                      <!-- Crop and preview -->
                                                                      <div class="row">
                                                                        <div class="col-md-9">
                                                                          <div class="avatar-wrapper"></div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                          <div class="avatar-preview preview-lg"></div>
                                                                          <div>
                                                                            <button type="submit" class="btn btn-primary btn-block avatar-save">Crop</button>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <!-- <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                  </div> -->
                                                                </form>
                                                              </div>
                                                            </div>
                                                          </div><!-- /.modal -->
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-3 MA10">
                                                        <div class="" id="crop-avatar-100">
                                                          <div class="pdf-thumb-box avatar-view">
                                                            <div class="pdf-thumb-box-overlay" style="left: 0px; opacity: 0.8; visibility: visible;width:100px;height:56px">
                                                                <i class="glyphicon glyphicon-eye-open"></i>100x56
                                                            </div>
                                                            <img src="<?php echo $data['image_size'][100];?>" id="img_100" alt="">
                                                          </div>
                                                                  <!-- Cropping modal -->
                                                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <form class="avatar-form" action="/image/upload" enctype="multipart/form-data" method="post">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                      <!-- Upload image and data -->
                                                                      <div class="avatar-upload">
                                                                        <input type="hidden" class="avatar-image_id" name="avatar_image_id">
                                                                        <input type="hidden" class="avatar-image_width" name="avatar_image_width">
                                                                        <input type="hidden" class="avatar-src" name="avatar_src">
                                                                        <input type="hidden" class="avatar-data" name="avatar_data">
                                                                        <label for="avatarInput">Local upload</label>
                                                                        <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                                                      </div>

                                                                      <!-- Crop and preview -->
                                                                      <div class="row">
                                                                        <div class="col-md-9">
                                                                          <div class="avatar-wrapper"></div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                          <div class="avatar-preview preview-lg"></div>
                                                                          <div>
                                                                            <button type="submit" class="btn btn-primary btn-block avatar-save">Crop</button>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <!-- <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                  </div> -->
                                                                </form>
                                                              </div>
                                                            </div>
                                                          </div><!-- /.modal -->
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-3 MA10">
                                                        <div class="" id="crop-avatar-77">
                                                          <div class="pdf-thumb-box avatar-view">
                                                            <div class="pdf-thumb-box-overlay pdf-thumb-box-overlay-small" style="left: 0px; opacity: 0.8; visibility: visible;width:77px;height:43px">
                                                                <i class="glyphicon glyphicon-eye-open"></i>77x43
                                                            </div>
                                                            <img src="<?php echo $data['image_size'][77];?>" id="img_77" alt="">
                                                          </div>
                                                                  <!-- Cropping modal -->
                                                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <form class="avatar-form" action="/image/upload" enctype="multipart/form-data" method="post">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                      <!-- Upload image and data -->
                                                                      <div class="avatar-upload">
                                                                        <input type="hidden" class="avatar-image_id" name="avatar_image_id">
                                                                        <input type="hidden" class="avatar-image_width" name="avatar_image_width">
                                                                        <input type="hidden" class="avatar-src" name="avatar_src">
                                                                        <input type="hidden" class="avatar-data" name="avatar_data">
                                                                        <label for="avatarInput">Local upload</label>
                                                                        <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                                                      </div>

                                                                      <!-- Crop and preview -->
                                                                      <div class="row">
                                                                        <div class="col-md-9">
                                                                          <div class="avatar-wrapper"></div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                          <div class="avatar-preview preview-lg"></div>
                                                                          <div>
                                                                            <button type="submit" class="btn btn-primary btn-block avatar-save">Crop</button>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <!-- <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                  </div> -->
                                                                </form>
                                                              </div>
                                                            </div>
                                                          </div><!-- /.modal -->
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>

                                                </div>
                                            </div>
                                        </div>
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
<script src="<?php echo _CONST_JS_PATH;?>/cropper/cropper.min.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>/cropper/main2.js" type="text/javascript"></script>

<!-- Tag Inputs -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>tags/jquery.tagsinput.js"></script>

<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>common.js"></script>

<script type="text/javascript">
    function onAddTag(tag) {
      alert("Added a tag: " + tag);
    }

    function onRemoveTag(tag) {
      alert("Removed a tag: " + tag);
    }

    function onChangeTag(input, tag) {
      alert("Changed a tag: " + tag);
    }

    $(function () {
      $('#img_tags, #img_edit_tags').tagsInput({
          'removeWithBackspace' : false,
          'width':'100%',
          'delimiter': ','
      });
    });
    function getImageEditParams(){
      var error = 0;
        if($('#img_edit_tags').val()==''){
          alert('Please provide keywords for the image');
          error = 1;
        }else if($('#img_edit_name').val()==''){
          alert('Image Name cannot be blank');
          error = 1;
        }
        if($('#img_edit_name').val()==$('#img_edit_name').attr('data-original-img-name') && $('#img_edit_tags').val()==$('#img_edit_tags').attr('data-original-img-tags')){
          alert('Please edit either Image Name or Keywords for updation');
          return false;
        }
        if(error==0){
          $("#edit_details").attr('disabled','true');
          var img_id = $("#img_id").val();
          $.post('/image/edit/'+img_id,{image_keywords:$('#img_edit_tags').val(),image_name:$('#img_edit_name').val()}, function(result) {
            $("#edit_details").removeAttr('disabled');
            if(result=='success'){
                $('#img_edit_name').attr('data-original-img-name',$('#img_edit_name').val());
                $('#img_edit_name').attr('data-original-img-tags',$('#img_edit_tags').val());
                $("#operation_status").html('<div role="alert" class="alert alert-success alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Image Name & keywords has been updated.</div>');
            }else{
                $("#operation_status").html('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Error while Updating the image name & keywords. Please try again!!!</div>');
            }

          }).fail(function(xhr, ajaxOptions, thrownError) {
            $("#operation_status").html('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Error while Updating the image name & keywords. Please try again!!!</div>');
            $("#edit_details").removeAttr('disabled');
          });
        }
    }
    $(document).ready(function(){
        $(".pdf-thumb-box").hover(function() {
            var imgWidth = $(this).children("img").width();
            var imgHeight = $(this).children("img").height();
            var negImgWidth = imgWidth - imgWidth - imgWidth;
            $(this).children(".pdf-thumb-box-overlay").animate({"left": negImgWidth}, 250);
        }, function() {
          var imgWidth = $(this).children("img").width();
          var imgHeight = $(this).children("img").height();
          var negImgWidth = imgWidth - imgWidth - imgWidth;

          $(this).children(".pdf-thumb-box-overlay").fadeTo(0, 0.8);

          $(this).css("width", (imgWidth)+"px");
          $(this).css("height", (imgHeight)+"px");


          $(this).children(".pdf-thumb-box-overlay").css("left", negImgWidth+"px");
          $(this).children(".pdf-thumb-box-overlay").css("visibility", "visible");

          $(this).children(".pdf-thumb-box-overlay").animate({"left": 0}, 250);
        });
      });
</script>
<?php if ($data['operation'] == 'new') {?>
<script>
$(function () {
  var ImgUploader = new ImageUploader($('#img-uploader'));
});
</script>
<?php } else {?>
<script>
$(function () {
  $('#upload_new').hide();
  $('#resize-container').show();
  var av_1280 =  new CropAvatar($('#crop-avatar-1280'),'<?php echo $imgDetails[0]['image_original'];?>',1280,<?php echo $imgDetails[0]['image_id'];?>);
  var av_615 =  new CropAvatar($('#crop-avatar-615'),'<?php echo $imgDetails[0]['image_original'];?>',1280,<?php echo $imgDetails[0]['image_id'];?>);
  var av_300 =  new CropAvatar($('#crop-avatar-300'),'<?php echo $imgDetails[0]['image_original'];?>',1280,<?php echo $imgDetails[0]['image_id'];?>);
  var av_100 =  new CropAvatar($('#crop-avatar-100'),'<?php echo $imgDetails[0]['image_original'];?>',1280,<?php echo $imgDetails[0]['image_id'];?>);
  var av_77 =  new CropAvatar($('#crop-avatar-77'),'<?php echo $imgDetails[0]['image_original'];?>',1280,<?php echo $imgDetails[0]['image_id'];?>);
});
</script>
<?php }
?>
</body>
</html>
