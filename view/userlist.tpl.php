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
                                <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Delete Parmanently</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure about this ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                    <div id="toolbar">
                                        <div class="form-inline" role="form">
                                             <div class="form-group">
                                                <input name="partner_code" class="form-control" type="text" placeholder="Search via Partner Code">
                                            </div>
                                            <div class="form-group">
                                                <input name="user_id" class="form-control" type="text" placeholder="Search via User ID">
                                            </div>
                                            <button id="ok" type="submit" class="btn btn-default">OK</button>
                                        </div>
                                    </div>
                                    <table id="table" data-toggle="table" data-query-params="queryParams"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-url="<?php echo $data_url;?>" data-pagination="true" data-side-pagination="server" data-method="get" data-sort-order='desc'>
                                        <thead>
                                        <tr>
                                            <?php foreach ($this->columnHeadings as $data_field => $col_heading): ?>
                                                <th data-field="<?php echo $data_field;?>"><?php echo $col_heading;?></th>
                                            <?php endforeach?>
                                        </tr>
                                        </thead>
                                    </table>
                                    </div>
                                    <!-- <table id="table"
                                       data-toggle="table"
                                       data-url="<?php echo $data_url;?>"
                                       data-height="400"
                                       data-side-pagination="server"
                                       data-pagination="true"
                                       data-page-list="[5, 10, 20, 50, 100, 200]"
                                       data-search="true">
                                    <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="id">ID</th>
                                        <th data-field="name">Item Name</th>
                                        <th data-field="price">Item Price</th>
                                    </tr>
                                    </thead>
                                </table> -->
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table-all.min.js"></script>
<script>
    var $table = $('#table'),
        $ok = $('#ok');

    $(function () {
        $ok.click(function () {
            $table.bootstrapTable('refresh');
        });
    });

     function queryParams(params) {
        $('#toolbar').find('input[name]').each(function () {
            params[$(this).attr('name')] = $(this).val();
        });

        return params;
    }


</script>
</body>
</html>
