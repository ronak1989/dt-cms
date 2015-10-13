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
                            <div class="x_panel" style="min-height:900px;">
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
                                    <div>
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <form id="defaultForm" method="post" class="form-horizontal" action="target.php">
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Name</label>
                                                    <div class="col-lg-5">
                                                        <select class="js-data-example-ajax" style="width:100%">
                                                          <option value="-1" selected="selected">Please Search for User ID</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Name</label>
                                                    <div class="col-lg-5">
                                                        <input type="text" class="form-control" name="username" name="username" autocomplete="off" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Email address</label>
                                                    <div class="col-lg-5">
                                                        <input type="text" class="form-control" name="relatedstory" id="relatedstory" autocomplete="off" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Mobile Number</label>
                                                    <div class="col-lg-5">
                                                        <input type="text" class="form-control" name="mobileno" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
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
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>/formvalidation/formValidation.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>/formvalidation/framework/bootstrap.js"></script>
<!-- select2 -->
<script type="application/javascript" src="<?php echo _CONST_JS_PATH;?>select/select2.full.js"></script>
<script type="text/javascript">
function formatRepo (repo) {
    if (repo.loading) return repo.text;

    var markup = '<div class="clearfix">' +
    '<div clas="col-sm-10">' +
    '<div class="clearfix">' +
    '<div class="col-sm-12">' + repo.user_id + '</div>' +
    '</div>';


    markup += '</div></div>';

    return markup;
}

function formatRepoSelection (repo) {
    console.log(repo);
return repo.user_id || repo.text;
}

$(document).ready(function() {

    $(".js-data-example-ajax").select2({
     placeholder: "Select",
        allowClear: true,
      ajax: {
        url: "http://local.cms.dalaltimes.com/get-magazine-subscriber/list",
        dataType: 'json',
        delay: 250,

        data: function (params) {
          return {
            user_id: params.term, // search term
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
      minimumInputLength: 3,
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
    $('#defaultForm').formValidation({
        message: 'This value is not valid',
//        live: 'disabled',
        icon: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and can\'t be empty'
                    },
                    regexp: {
                        message: 'The user name can only contain the Alphabets, spaces',
                        regexp: /^[A-Za-z\s]+$/
                    }
                }
            },
            user_id: {
                threshold:3,
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
                    regexp: {
                            regexp: /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/,
                            message: 'The value is not a valid email address'
                        },
                    remote: {
                        type: 'POST',
                        url: '/api/input-validate/',
                        name:'search',
                        data:{
                            t:'user',
                            f:'userid',
                            return_type:'json'
                        },
                        message: 'The Email ID Already exists in the system',
                    }
                }
            },
            mobileno: {
                validators: {
                    digits: {
                        message: 'The field can contain only digits'
                    },
                    stringLength:{
                        trim:true,
                        max:12,
                        min:10,
                        message:'Please enter valid mobileno'
                    }
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
</script>
</body>
</html>
