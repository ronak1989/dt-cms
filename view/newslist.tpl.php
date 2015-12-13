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
                <div>
                    <?php if (isset($_SESSION['error']['newspublish']) && !empty($_SESSION['error']['newspublish'])) {
	echo '<div class="clearfix"></div>';
	foreach ($_SESSION['error']['newspublish'] as $key => $value) {

		echo '<div role="alert" class="alert alert-danger alert-dismissible fade in">
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
                            </button>
                            ' . $value . '
                        </div>';
		unset($_SESSION['error']['newspublish'][$key]);
	}

}
?>
<?php if (isset($_SESSION['success']['newspublish']) && !empty($_SESSION['success']['newspublish'])) {
	echo '<div class="clearfix"></div>';
	foreach ($_SESSION['success']['newspublish'] as $key => $value) {
		echo '<div role="alert" class="alert alert-success alert-dismissible fade in">
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
                            </button>
                            ' . $value . '
                        </div>';
		unset($_SESSION['success']['newspublish'][$key]);
	}

}
?>
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?php echo self::$pageTitle; ?></h3>
                        </div>
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <div class='form-group'>
                                            <a class="btn btn-dark text-right" href="/news/editor/compose"><i class="fa fa-pencil"></i> Compose </a>
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
                                <div class="x_title">
                                    <h2>UN-Published News</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                    <div>
                                        <div id="unpublished_news_toolbar" class="well srch_panel">
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
                                                        <input type='hidden' name='publish' value="0">
                                                        <input name="autono" class="form-control" type="text" placeholder="Search via Autono">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="headline" class="form-control" type="text" placeholder="Search via Headline" style="width:100%;">
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
                                                        <select name="category_id" id="category_id" class="form-control search_category">
                                                            <?php echo $data['mainCategory']; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="subcategory_id" class="form-control">
                                                            <option value="">Please select Sub Category to Search</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="nup_search" type="submit" class="btn btn-default">SEARCH</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <table id="unpublished_news" data-row-style="format_background" data-toggle="table" data-query-params="unpublished_news_queryParams"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-url="<?php echo $data_url; ?>" data-pagination="true" data-side-pagination="server" data-method="get" data-sort-order='desc'>
                                            <thead>
                                            <tr>
                                                <?php foreach ($this->columnHeadings as $data_field => $col_dtls) {
	if (is_array($col_dtls)) {
		$data_table = '';
		foreach ($col_dtls as $key => $value) {
			$col_properties .= " " . $key . '="' . $value . '"';
		}
		echo '<th data-field="' . $data_field . '" ' . $col_properties . ' ></th>';
	} else {
		echo '<th data-field="' . $data_field . '">' . $col_dtls . '</th>';
	}
}

?>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                             <div class="x_panel">
                                <div class="x_title">
                                    <h2>Published News</h2>
                                    <ul class="nav navbar-right panel_toolbox ">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                    <div>
                                        <div id="published_news_toolbar" class="well srch_panel">
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
                                                        <input type='hidden' name='publish' value="1">
                                                        <input name="autono" class="form-control" type="text" placeholder="Search via Autono">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="headline" class="form-control" type="text" placeholder="Search via Headline" style="width:100%;">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-prepend input-group">
                                                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                            <input type="text" name="modified_date" id="np_modified_date"  class="form-control dtpicker" value="" placeholder='Search via News Date' />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <select name="category_id" class="form-control">
                                                            <?php echo $data['mainCategory']; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="subcategory_id" class="form-control">
                                                            <option value="">Please select Sub Category to Search</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="np_search" type="submit" class="btn btn-default">SEARCH</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="published_news" data-row-style="format_background" data-toggle="table" data-query-params="published_news_queryParams"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-url="<?php echo $data_url; ?>" data-pagination="true" data-side-pagination="server" data-method="get" data-sort-order='desc'>
                                            <thead>
                                            <tr>
                                                <?php foreach ($this->columnHeadings as $data_field => $col_dtls) {
	if (is_array($col_dtls)) {
		$data_table = '';
		foreach ($col_dtls as $key => $value) {
			$col_properties .= " " . $key . '="' . $value . '"';
		}
		echo '<th data-field="' . $data_field . '" ' . $col_properties . ' ></th>';
	} else {
		echo '<th data-field="' . $data_field . '">' . $col_dtls . '</th>';
	}
}

?>
                                            </tr>
                                            </thead>
                                        </table>
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

<script src="<?php echo _CONST_JS_PATH; ?>bootstrap.min.js"></script>
<script src="<?php echo _CONST_JS_PATH; ?>nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo _CONST_JS_PATH; ?>custom.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table-all.min.js"></script>
<!-- datepicker -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH; ?>moment.min2.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH; ?>datepicker/daterangepicker.js"></script>
<!-- / datepicker -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH; ?>common.js"></script>

<script>
    $('#unpublished_news_toolbar').find('[name=category_id]').on('change',function(e){
        var object = $('#unpublished_news_toolbar').find('[name=subcategory_id]');
        loadNewsSubcategories(this.value,'',object,'object');
    });

    $('#published_news_toolbar').find('[name=category_id]').on('change',function(e){
        var object = $('#published_news_toolbar').find('[name=subcategory_id]');
        loadNewsSubcategories(this.value,'',object,'object');
    });

    var $nup_offset = 0;
    var $nup_limit = 10;
    var $np_offset = 0;
    var $np_limit = 10;
    var $np_searched_clicked = false;
    var $nup_searched_clicked = false;

    var $ranked_news_table = $('#unpublished_news'),
        $nup_searh = $('#nup_search'),
        $published_news_table = $('#published_news'),
        $np_searh = $('#np_search');


    $(function () {
        $('.search_collapse-link').trigger('click');
        $('.dtpicker').daterangepicker({
            format: 'DD-MM-YYYY',
            /*endDate: '<?php echo date("jS F Y"); ?>',*/
            minDate: '<?php echo date("01-01-2013"); ?>',
            maxDate: '<?php echo date("d-m-Y"); ?>',
        }, function (start, end, label) {
                console.log(this);
                console.log(start.toISOString(), end.toISOString(), label);
            });
        $np_searh.click(function () {
            $np_searched_clicked = true;
            $published_news_table.bootstrapTable('refresh');
        });

        $nup_searh.click(function () {
            $nup_searched_clicked = true;
            $ranked_news_table.bootstrapTable('refresh');
        });
    });

    function unpublished_news_queryParams(params) {
        if($nup_searched_clicked==true){
            $nup_searched_clicked = false;
            params['offset'] = 0;
        }
        $('#unpublished_news_toolbar').find('input[name], input[hidden],select[name]').each(function () {
            params[$(this).attr('name')] = $(this).val();
        });
        return params;
    }

    function published_news_queryParams(params) {
        if($np_searched_clicked==true){
            $np_searched_clicked = false;
            params['offset'] = 0;
        }
        $('#published_news_toolbar').find('input[name], input[hidden],select[name]').each(function () {
            params[$(this).attr('name')] = $(this).val();
        });
        return params;
    }

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

    function format_background(row,index){
        console.log(index);
        console.log(row);
        if(row.assign_to_production=="1"){
        return {
            classes: 'success'
        };
        }else{
                return '';
        }
    }

    window.operationEvents = {
/*        'click .edit': function (e, value, row, index) {
            alert('You click like action, row: ' + JSON.stringify(row));
        },*/
/*        'click .view': function (e, value, row, index) {
            alert('You click like action, row: ' + JSON.stringify(row));
        },*/
        'click .remove': function (e, value, row, index) {
            var _this = this;
            $.post('<?php echo $delete_url; ?>',{
                articleId: row.autono,
            },function(data, status){
                $(_this).closest('table').bootstrapTable('remove', {
                    field: 'autono',
                    values: [row.autono]
                });
                console.log(status);
                console.log(data);
            });
        }
    };

</script>
</body>
</html>
/