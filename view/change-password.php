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
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                    <div>
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <form id="defaultForm" method="post" class="form-horizontal" action="/revise-password">
                                                                        <?php if (isset($_SESSION['error']['changepassword']) && !empty($_SESSION['error']['changepassword'])) {
	foreach ($_SESSION['error']['changepassword'] as $key => $value) {
		echo '<div role="alert" class="alert alert-danger alert-dismissible fade in">
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
                            </button>
                            ' . $value . '
                        </div>';
		unset($_SESSION['error']['changepassword'][$key]);
	}

}
?>
<?php if (isset($_SESSION['success']['changepassword']) && !empty($_SESSION['success']['changepassword'])) {
	foreach ($_SESSION['success']['changepassword'] as $key => $value) {
		echo '<div role="alert" class="alert alert-success alert-dismissible fade in">
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
                            </button>
                            ' . $value . '
                        </div>';
		unset($_SESSION['success']['changepassword'][$key]);
	}

}
?>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Current Password</label>
                                                    <div class="col-lg-5">
                                                        <input type="password" class="form-control" name="oldpassword" name="oldpassword" autocomplete="off" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">New Password</label>
                                                    <div class="col-lg-5">
                                                        <input type="password" class="form-control" name="newpassword" id="newpassword" autocomplete="off" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Confirm New Password</label>
                                                    <div class="col-lg-5">
                                                        <input type="password" class="form-control" name="confirmnewpassword" id="confirmnewpassword" />
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
    $('#defaultForm').formValidation({
        message: 'This value is not valid',
//        live: 'disabled',
        icon: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            oldpassword: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and can\'t be empty'
                    }
                }
            },
            newpassword: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and can\'t be empty'
                    },
                    stringLength:{
                        message: 'Your new password should atleast be 8 characters long',
                        min: 8
                    }
                }
            },
            confirmnewpassword: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and can\'t be empty'
                    },
                    identical: {
                        field: 'newpassword',
                        message: 'The password and its confirm are not the same'
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
