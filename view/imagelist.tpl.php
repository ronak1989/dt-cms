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

if ($image_gallery == '') {
	include_once _CONST_VIEW_PATH . 'sidebar_menu.php';
}

?>
            <!-- /SIDEBARE MENU -->
            <!-- top navigation -->
            <?php
if ($image_gallery == '') {
	include_once _CONST_VIEW_PATH . 'top_nav.php';
}
?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                    <?php if ($image_gallery == '') {?>
                    <div class="page-title">

                        <div class="title_left">
                            <h3><?php echo self::$pageTitle;?></h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <div class='form-group'>
                                            <a class="btn btn-dark text-right" href="/image/new"><i class="fa fa-pencil"></i> Upload New Image </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php }
?>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                             <div class="x_panel">
                                <div class="modal fade" id="imageModal" role="dialog" aria-labelledby="imageModalBox" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p></p>
                                                <img src="#" class="img-responsive" style="margin: 0 auto;" />
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="x_title">
                                    <h2>Media gallery </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                        <div id="operation_status"></div>
                                    <div>
                                        <div id="image_toolbar" class="well srch_panel">
                                            <div class="x_title">
                                                <h2>Refine Search</h2>
                                                <ul class="nav navbar-right panel_toolbox ">
                                                    <li><a class="search_collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="row srch_content">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <input type='hidden' name='status' value="<?php echo $defaultParams['status'];?>">
                                                            <input name="image_name" class="form-control" type="text" placeholder="Search via Image Name">
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="input-prepend input-group">
                                                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                            <input type="text" name="modified_date" id="modified_date" class="form-control dtpicker" value="" placeholder='Search via News Date' />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <input name="image_keywords" class="form-control" type="text" placeholder="Search Image via Keywords" style="width:100%;">
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="image_search" type="submit" class="btn btn-default">SEARCH</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row">


                                        <div id="image_gallery">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div align="center">
                                        <button class="load_more" id="load_more_button">load More</button>
                                        <div class="animation_image" style="display:none;">Loading...</div>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <!-- <footer>
                    <div class="">
                        <p class="pull-right">
                            <span class="lead">Dalaltimes.com</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer> -->
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>
    </div>

<script src="<?php echo _CONST_JS_PATH;?>bootstrap.min.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>custom.js"></script>

<!-- datepicker -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>moment.min2.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>datepicker/daterangepicker.js"></script>
<!-- / datepicker -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>common.js"></script>

<script>
    var track_click = 0;
    var totalPages = 0;
    var offset = 0;
    var limit = 10;
    var processing = false;
    var img_gallery = "<?php echo $image_gallery;?>";
    function getImageSearchParams(){
        var params = {};
        params['order'] = 'desc';
        params['limit'] = limit;
        params['offset'] = offset;
        $('#image_toolbar').find('input[name], input[hidden]').each(function () {
            params[$(this).attr('name')] = $(this).val();
        });
        return params;
    }

    function loadImages(){
        processing = true;
        var params = getImageSearchParams();
        $.get('<?php echo $data_url;?>',params, function(data) {
            var image_data = $.parseJSON(data);
            var total = image_data['total'];
            totalPages = Math.ceil(total/limit);
            track_click++;
            offset = track_click*10;
            if(track_click >= totalPages)
            {
                //reached end of the page yet? disable load button
                $(".load_more").attr("disabled", "disabled");
            }
            var generateHtml = '';
            $.each( image_data['rows'], function( index, row ){
                generateHtml += imageFormatter(row);
            });
            $('#image_gallery').append(generateHtml);
            processing =false;
        }).fail(function(xhr, ajaxOptions, thrownError) {
            processing =false;
        });
    }
    $(function () {
        if(img_gallery=='1'){
            $('body').removeClass('nav-sm');
        }
        loadImages();
        $('.load_more').click(function(){
            if(processing==false)
                loadImages();
        });
        $("#image_search").click(function () {
            track_click = 0;
            totalPages = 0;
            offset = 0;
            limit = 10;
            processing = false;
            $('#image_gallery').empty();
            $(".load_more").removeAttr("disabled");
            loadImages();

        });
        $('.search_collapse-link').trigger('click');
        $('.dtpicker').daterangepicker({
            format: 'DD-MM-YYYY',
            /*endDate: '<?php echo date("jS F Y");?>',*/
            minDate: '<?php echo date("01-01-2013");?>',
            maxDate: '<?php echo date("d-m-Y");?>',
        }, function (start, end, label) {
                console.log(this);
                console.log(start.toISOString(), end.toISOString(), label);
            });

        $(document.body).on('click','.img_max',function() {
            $('#imageModal img').attr('src', $(this).attr('data-img-url'));
            if($(this).attr('data-story-headline')=='null'){
                $('#imageModal p').html('');
            }else{
                $('#imageModal p').html($(this).attr('data-story-headline'));
            }

            $('#imageModal').modal('show');
        });

        $(document.body).on('click','.approve_img',function() {
            var _this = this;
            var image_id = $(this).attr('data-img-id');
            $.post('<?php echo $approve_url;?>'+image_id, function(result) {
                if(result=='success'){
                    $(_this).closest('.col-md-55').remove();
                    $("#operation_status").append('<div role="alert" class="alert alert-success alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Image <strong>'+$(_this).attr('data-img-name')+'</strong> has been approved.</div>');
                }else{
                    $("#operation_status").append('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Error while approving the image '+$(_this).attr('data-img-name')+'. Please try again!!!</div>');
                }
            }).fail(function(xhr, ajaxOptions, thrownError) {

            });
        });

        $(document.body).on('click','.disapprove_img',function() {
            var _this = this;
            var image_id = $(this).attr('data-img-id');
            var confirm_status = confirm("Are you sure you want to Delete this image?");
            if(confirm_status==true){
                $.post('<?php echo $disapprove_url;?>'+image_id, function(result) {
                    if(result=='success'){
                        $(_this).closest('.col-md-55').remove();
                        $("#operation_status").append('<div role="alert" class="alert alert-success alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Image <strong>'+$(_this).attr('data-img-name')+'</strong> has been deleted from the system.</div>');
                    }else{
                        $("#operation_status").append('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Error while deleting the image '+$(_this).attr('data-img-name')+'. Please try again!!!</div>');
                    }
                }).fail(function(xhr, ajaxOptions, thrownError) {

                });
            }
        });

        $(document.body).on('click','.story_img',function() {
            window.parent.$("#image_id").val($(this).attr('data-img-id'));
            window.parent.$("#gallery_image_300").html("<img class='img-responsive' style='margin:0 auto;width:100%' src='"+$(this).attr('data-img-url')+"'/>");
            window.parent.$("#gallery_image_300").append('<button type="button" class="btn btn-danger" id="remove-image" onclick="removeImage();" style="width:100%;"><i class="fa fa-picture-o"></i> Remove Image</button>');
            window.parent.$("#imageGalleryModal").modal('hide');
        });

        $(document.body).on('click','.article_img',function() {
            window.parent.tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<img src="'+$(this).attr('data-img-url')+'" class="img-responsive" />');
            window.parent.$("#imageGalleryModal").modal('hide');
        });
        $('.search_collapse-link').trigger('click');
    });

    function operationFormatter(value, row, index) {

        return [
        '<div class="btn-group  btn-group-sm">',
            '<a class="edit btn btn-default" href="/news/editor/compose/'+row.autono+'" title="Edit">',
            '<i class="fa fa-pencil-square-o"></i> Edit',
            '</a>  ',
            '<a class="view btn btn-default" href="/news/preview/'+row.autono+'" title="Preview">',
            '<i class="fa fa-eye "></i> View',
            '</a> ',
            '<a class="remove btn btn-default" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash-o"></i> Delete',
            '</a>',
        '</div>'
        ].join('');
    }

    function imageFormatter(row) {
        var approved_img = '';
        var disapprove_img = '';
        var edit_img = '';
        var actions = '';
        if(row.news_autono==null){
            var ribbon_tag = '<div class="ribbon"><span>Image Bank</span></div>';
        }else{
            var ribbon_tag = '<div class="ribbon red"><span>Article Image</span></div>';
        }
        if(row.status=='inactive'){
            approved_img = '<div class="btn-group"><button class="btn btn-success btn-sm approve_img" data-img-id="'+row.image_id+'" data-img-name="'+row.image_name+'" type="button"><i class="fa fa-thumbs-o-up"></i> </button></div>';
            disapprove_img = '<div class="btn-group"><button class="btn btn-danger btn-sm disapprove_img" data-img-id="'+row.image_id+'" data-img-name="'+row.image_name+'" type="button"><i class="fa fa-thumbs-o-down"></i> </button></div>';
            edit_img = '<div class="btn-group"><a class="btn btn-danger btn-sm" href="/image/edit/'+row.image_id+'"><i class="fa fa-pencil-square-o"></i></a></div>';
            var actions = '<div class="col-xs-12 text-center">'+approved_img+'&nbsp;&nbsp;'+disapprove_img+'&nbsp;&nbsp;'+edit_img+'</div><br><br>';
        }
        if (img_gallery == '1') {
            story_img = '<div class="btn-group"><button class="btn btn-success btn-sm story_img" data-img-id="'+row.image_id+'" data-img-url="'+row.image_300+'" type="button"><i class="fa fa-picture-o"></i> Story </button></div>';
            article_img = '<div class="btn-group" ><button aria-expanded="true" type="button" class="btn btn-primary dropdown-toggle btn-sm " data-toggle="dropdown"><i class="fa fa-file-image-o"></i> Editor <span class="caret"></span></button><ul class="dropdown-menu" role="menu" style="width:100%"><li><a class="article_img" href="javascript:void(0);" data-img-url="'+row.image_1600+'"><i class="fa fa-file-image-o"></i> 1600x900 </a></li><li><a class="article_img" href="javascript:void(0);" data-img-url="'+row.image_1280+'"><i class="fa fa-file-image-o"></i> 1280x720 </a></li><li class="divider"></li><li><a class="article_img" href="javascript:void(0);" data-img-url="'+row.image_615+'"><i class="fa fa-file-image-o"></i> 615x346 </a></li><li><a class="article_img" href="javascript:void(0);" data-img-url="'+row.image_300+'"><i class="fa fa-file-image-o"></i> 300x169</a></li><li class="divider"></li><li><a class="article_img" href="javascript:void(0);" data-img-url="'+row.image_100+'"><i class="fa fa-file-image-o"></i> 100x56</a></li><li><a class="article_img" href="javascript:void(0);" data-img-url="'+row.image_77+'"><i class="fa fa-file-image-o"></i> 77x43 </a></li></ul></div>';
            var actions = '<div class="col-xs-12 text-center">'+story_img+'&nbsp;&nbsp;'+article_img+'</div><br><br>';
        }

        return [
        '<div class="col-md-55">',
            '<div class="thumbnail">',
                '<div class="image view view-first">',
                    '<img alt="image" src="'+row.image_300+'" style="width: 100%; display: block;">',
                    '<div class="mask">',
                        '<p>'+row.image_name+'</p>',
                        '<div class="tools tools-bottom">',
                            'Keywords',
                           '<p>'+row.image_keywords+'</p>',
                        '</div>',
                    '</div>',

                '</div>',
                '<div class="caption text-center">',
                    actions,
                    '<div class="col-xs-12">',
                        '<div class="btn-group" style="width:100%">',
                            '<button aria-expanded="true" type="button" class="btn btn-primary dropdown-toggle btn-sm " style="width:100%" data-toggle="dropdown">Different Size <span class="caret"></span>',
                            '</button>',
                            '<ul class="dropdown-menu" role="menu" style="width:100%">',
                                '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_1600+'" data-story-headline="'+row.headline+'"><i class="fa fa-file-image-o"></i> 1600x900 </a></li>',
                                '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_1280+'" data-story-headline="'+row.headline+'"><i class="fa fa-file-image-o"></i> 1280x720 </a></li>',
                                '<li class="divider"></li>',
                                '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_615+'" data-story-headline="'+row.headline+'"><i class="fa fa-file-image-o"></i> 615x346 </a></li>',
                                '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_300+'" data-story-headline="'+row.headline+'"><i class="fa fa-file-image-o"></i> 300x169</a></li>',
                                '<li class="divider"></li>',
                                '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_100+'" data-story-headline="'+row.headline+'"><i class="fa fa-file-image-o"></i> 100x56</a></li>',
                                '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_77+'" data-story-headline="'+row.headline+'"><i class="fa fa-file-image-o"></i> 77x43 </a></li>',
                            '</ul>',
                        '</div>',
                    '</div>',
                '</div>',

                '<div class="clearfix"></div>',

            '</div>',
            ribbon_tag,
        '</div>'

        ].join('');
    }

</script>
<style>
.well .col-xs-12 {padding: 0px;}
.well.profile_view{padding: 0px;}
.ribbon {
   position: absolute;
   right: 2px; top: -2px;
   z-index: 1;
   overflow: hidden;
   width: 100px; height: 100px;
   text-align: right;
}
.ribbon span {
   font-size: 10px;
   color: #fff;
   text-transform: uppercase;
   text-align: center;
   font-weight: bold; line-height: 20px;
   transform: rotate(45deg);
   width: 125px; display: block;
   background: #79A70A;
   background: linear-gradient(#9BC90D 0%, #79A70A 100%);
   box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
   position: absolute;
   top: 25px; right: -21px;
}
.ribbon span::before {
   content: '';
   position: absolute;
   left: 0px; top: 100%;
   z-index: -1;
   border-left: 3px solid #79A70A;
   border-right: 3px solid transparent;
   border-bottom: 3px solid transparent;
   border-top: 3px solid #79A70A;
}
.ribbon span::after {
   content: '';
   position: absolute;
   right: 0%; top: 100%;
   z-index: -1;
   border-right: 3px solid #79A70A;
   border-left: 3px solid transparent;
   border-bottom: 3px solid transparent;
   border-top: 3px solid #79A70A;
}
.red span {background: linear-gradient(#F70505 0%, #8F0808 100%);}
.red span::before {border-left-color: #8F0808; border-top-color: #8F0808;}
.red span::after {border-right-color: #8F0808; border-top-color: #8F0808;}

.blue span {background: linear-gradient(#2989d8 0%, #1e5799 100%);}
.blue span::before {border-left-color: #1e5799; border-top-color: #1e5799;}
.blue span::after {border-right-color: #1e5799; border-top-color: #1e5799;}

</style>
</body>
</html>

