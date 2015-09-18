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
                                        <li><a class="btn btn-primary btn-xs" style="background-color: #1479b8" href='<?php echo $this->_data['url']['add'];?>'>Add New</a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                    <div>
                                        <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="' . $inputTypeParams['fieldType'] . '" id="' . $key . '" name="' . $key . '" value="' . $inputTypeParams['fieldValue'] . '" class="form-control col-md-7 col-xs-12" ' . $_validation . '>
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

</body>
</html>
