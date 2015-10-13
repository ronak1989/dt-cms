<!DOCTYPE html>
<html lang="en">
<?php
include_once _CONST_VIEW_PATH . 'header.php';
?>
<body class="nav-md">
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
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="form-group">
                                                    <div class="container" id="img-uploader">
                                                        <div class="row" id="img-modal">
                                                          <form class="img-form" action="/news/image/upload" enctype="multipart/form-data" method="post">
                                                              <div class="img-body">
                                                                <!-- Crop and preview -->
                                                                <div class="row">
                                                                  <div class="col-md-3">
                                                                    <!-- Upload image and data -->
                                                                    <div class="img-upload">
                                                                      <input type="hidden" name="img_type" value="resize">
                                                                      <input type="hidden" class="img-src" name="img_src">
                                                                      <input type="hidden" class="img-data" name="img_data">
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
                                        <div class="">
                                            <div class="x_panel">
                                                <div class="form-group">
                                                  <div class="container" id="resize-container" style="display:block">
                                                    <div class="row">
                                                      <h1>Resized Images</h1>
                                                    </div>
                                                    <div class="row text-left">
                                                      <div class="col-sm-6 MA10" id="crop-avatar-1280">
                                                        <!-- data-target="#avatar-modal" data-toggle="modal" -->
                                                        <div class="pdf-thumb-box avatar-view" >
                                                          <div class="pdf-thumb-box-overlay" style="left: 0px; opacity: 0.8; visibility: visible;width:100%;height:100%">
                                                              <i class="glyphicon glyphicon-eye-open"></i>1280x720
                                                          </div>
                                                          <img src="http://placehold.it/1280x720" id="img_1280" class="img-responsive" alt="">
                                                        </div>
                                                        <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                          <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                              <form class="avatar-form" action="/news/image/upload" enctype="multipart/form-data" method="post">
                                                                <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <div class="avatar-body">

                                                                    <!-- Upload image and data -->
                                                                    <div class="avatar-upload">
                                                                      <input type="hidden" class="avatar-image_id" name="avatar_image_id">
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
                                                            <img src="http://placehold.it/615x346" id="img_615" class="img-responsive"  alt="">
                                                          </div>
                                                                  <!-- Cropping modal -->
                                                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <form class="avatar-form" action="/news/image/upload" enctype="multipart/form-data" method="post">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                      <!-- Upload image and data -->
                                                                      <div class="avatar-upload">.
                                                                        <input type="hidden" class="avatar-image_id" name="avatar_image_id">
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
                                                            <img src="http://placehold.it/300x169" id="img_300" alt="">
                                                          </div>
                                                                  <!-- Cropping modal -->
                                                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <form class="avatar-form" action="/news/image/upload" enctype="multipart/form-data" method="post">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                      <!-- Upload image and data -->
                                                                      <div class="avatar-upload">
                                                                        <input type="hidden" class="avatar-image_id" name="avatar_image_id">
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
                                                            <img src="http://placehold.it/100x56" id="img_100" alt="">
                                                          </div>
                                                                  <!-- Cropping modal -->
                                                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <form class="avatar-form" action="/news/image/upload" enctype="multipart/form-data" method="post">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                      <!-- Upload image and data -->
                                                                      <div class="avatar-upload">
                                                                        <input type="hidden" class="avatar-image_id" name="avatar_image_id">
                                                                        <input type="hidden" class="avatar-width" name="avatar_width">
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
                                                            <img src="http://placehold.it/77x43" id="img_77" alt="">
                                                          </div>
                                                                  <!-- Cropping modal -->
                                                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <form class="avatar-form" action="/news/image/upload" enctype="multipart/form-data" method="post">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                      <!-- Upload image and data -->
                                                                      <div class="avatar-upload">
                                                                        <input type="hidden" class="avatar-image_id" name="avatar_image_id">
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
      $('#img_tags').tagsInput({
          width: 'auto'
      });
    });
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
</body>
</html>
