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
                                                <img src="#" class="img-responsive" />
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
                                        <div id="status"></div>
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
            $('#imageModal').modal('show');
        });
        $(document.body).on('click','.approve_img',function() {
            var _this = this;
            var image_id = $(this).attr('data-img-id');
            $.post('<?php echo $approve_url;?>'+image_id, function(result) {
                if(result=='success'){
                    $(_this).closest('.col-md-55').remove();
                    $("#status").append('<div role="alert" class="alert alert-success alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Image <strong>'+$(_this).attr('data-img-name')+'</strong> has been approved.</div>');
                }else{
                    $("#status").append('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Error while approving the image '+$(_this).attr('data-img-name')+'. Please try again!!!</div>');
                }
            }).fail(function(xhr, ajaxOptions, thrownError) {

            });
        });
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
        if(row.status=='inactive'){
            approved_img = '<div class="btn-group"><button class="btn btn-dark btn-sm approve_img" data-img-id="'+row.image_id+'" data-img-name="'+row.image_name+'" type="button"><i class="fa fa-thumbs-o-up"></i> Approve</button></div>';

        }
        return [
        '<div class="col-md-55">',
            '<div class="thumbnail">',
                '<div class="image view view-first">',
                    '<img alt="image" src="'+row.image_300+'" style="width: 100%; display: block;">',
                    '<div class="mask">',
                        '<p>'+row.image_name+'</p>',
                        '<div class="tools tools-bottom">',
                            '<a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_615+'"><i class="fa fa-link"></i></a>',
                           ,
                        '</div>',
                    '</div>',
                '</div>',
                '<div class="caption text-center">',
                '<div class="btn-group">',

                '<button aria-expanded="true" type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">Different Size <span class="caret"></span>',
                '</button>',
                '<ul class="dropdown-menu" role="menu">',
                    '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_1600+'"><i class="fa fa-file-image-o"></i> 1600x900 </a></li>',
                    '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_1280+'"><i class="fa fa-file-image-o"></i> 1280x720 </a></li>',
                    '<li class="divider"></li>',
                    '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_615+'"><i class="fa fa-file-image-o"></i> 615x346 </a></li>',
                    '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_300+'"><i class="fa fa-file-image-o"></i> 300x169</a></li>',
                    '<li class="divider"></li>',
                    '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_100+'"><i class="fa fa-file-image-o"></i> 100x56</a></li>',
                    '<li><a class="img_max" href="javascript:void(0);" data-img-url="'+row.image_77+'"><i class="fa fa-file-image-o"></i> 77x43 </a></li>',

                '</ul>',
                '</div>',
                '&nbsp;&nbsp;',
                 approved_img,
                '</div>',

            '</div>',

        '</div>'
        /*'<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 animated fadeInDown">',
            '<div class="well profile_view">',
                '<div class="col-xs-12">',
                    '<div class="col-xs-12" style="background-image:url('+row.image_300+');height:169px;background-position: center center;background-repeat: no-repeat;background-size: cover;">',
                    '</div>',
                '</div>',
                '<div class="col-xs-12 bottom text-center">',
                    '<div class="col-xs-12 emphasis">',
                        '<button class="btn btn-success btn-xs" type="button"> <i class="fa fa-file-image-o"></i>77x43 </button>',
                        '<button class="btn btn-success btn-xs" type="button"> <i class="fa fa-file-image-o"></i> 100x56</button>',
                        '<button class="btn btn-success btn-xs" type="button"> <i class="fa fa-file-image-o"></i> 300x169</button>',
                        '<button class="btn btn-success btn-xs" type="button"> <i class="fa fa-file-image-o"></i> 615x346</button>',
                        '<button class="btn btn-success btn-xs" type="button"> <i class="fa fa-file-image-o"></i>1280x720 </button>',
                        '<button class="btn btn-success btn-xs" type="button"> <i class="fa fa-file-image-o"></i>1600x900 </button>',
                        '<button class="btn btn-success btn-xs" type="button"> <i class="fa fa-file-image-o"></i> </button>',
                    '</div>',
                '</div>',
            '</div>',
        '</div>'*/
        ].join('');
    }

</script>
<style>
.well .col-xs-12 {padding: 0px;}
.well.profile_view{padding: 0px;}
</style>
</body>
</html>

