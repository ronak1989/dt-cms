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
                             <div class="x_panel">
                                <div class="x_title">
                                    <h2>Ranked News</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                    <div>
                                        <input type='hidden' name='rank_type' id='rank_type' value='<?php echo $rank_type;?>'>
                                        <table id="ranked_news" data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-url="<?php echo $rank_url;?>" data-pagination="true" data-side-pagination="server" data-method="get">
                                            <thead>
                                            <tr>
                                                <?php foreach ($this->rankColumnHeadings as $data_field => $col_dtls) {
	if (is_array($col_dtls)) {
		$data_table = '';
		$col_properties = '';
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
                                                            <?php echo $data['mainCategory'];?>
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
                                        <table id="published_news" data-toggle="table" data-query-params="published_news_queryParams"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-url="<?php echo $data_url;?>" data-pagination="true" data-side-pagination="server" data-method="get" data-sort-order='desc'>
                                            <thead>
                                            <tr>
                                                <?php
foreach ($this->columnHeadings as $data_field => $col_dtls) {
	if (is_array($col_dtls)) {
		$data_table = '';
		$col_properties = '';
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

<script src="<?php echo _CONST_JS_PATH;?>bootstrap.min.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>custom.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table-all.min.js"></script>
<!-- datepicker -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>moment.min2.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>datepicker/daterangepicker.js"></script>
<!-- / datepicker -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>common.js"></script>
<script>
    $('#unpublished_news_toolbar').find('[name=category_id]').on('change',function(e){
        var object = $('#unpublished_news_toolbar').find('[name=subcategory_id]');
        loadNewsSubcategories(this.value,'',object,'object');
    });

    $('#published_news_toolbar').find('[name=category_id]').on('change',function(e){
        var object = $('#published_news_toolbar').find('[name=subcategory_id]');
        loadNewsSubcategories(this.value,'',object,'object');
    });


    var $unpublished_news_table = $('#unpublished_news'),
        $nup_searh = $('#nup_search'),
        $published_news_table = $('#published_news'),
        $np_searh = $('#np_search');


    $(function () {
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
        $np_searh.click(function () {
            $published_news_table.bootstrapTable('refresh');
        });

        $nup_searh.click(function () {
            $unpublished_news_table.bootstrapTable('refresh');
        });
    });

    function unpublished_news_queryParams(params) {
        $('#unpublished_news_toolbar').find('input[name], input[hidden],select[name]').each(function () {
            params[$(this).attr('name')] = $(this).val();
        });
        return params;
    }

    function published_news_queryParams(params) {
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
        '</div>'
        ].join('');
    }

    function rankBox(value, row, index) {
        return [
            '<input type="text" name="updt_rank" maxlength="2" class="rank">',
        ].join('');
    }

    function rankCaption(value, row, index) {
        if(row.caption==''){
            caption = 'Add Caption';
        }else{
            caption = row.caption;
        }
        return [
            '<input type="text" name="rank_caption" value="'+row.caption+'" class="rank_caption" maxlength="45" style="display:none">',
            '<span class="rank_disp_caption">'+caption+'</span>',
        ].join('');
    }

    function rankActions(value, row, index) {
        return [
            '<a class="remove-rank btn btn-danger btn-xs" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash-o "></i> Remove',
            '</a> '
        ].join('');
    }

    window.operationEvents = {
/*        'click .edit': function (e, value, row, index) {
            alert('You click like action, row: ' + JSON.stringify(row));
        },
        'click .view': function (e, value, row, index) {
            alert('You click like action, row: ' + JSON.stringify(row));
        },*/
        'click .remove': function (e, value, row, index) {
            $(this).closest('table').bootstrapTable('remove', {
                field: 'autono',
                values: [row.autono]
            });
        },
        'click .remove-rank': function (e, value, row, index) {
            $.post('<?php echo $delete_url;?>',{
                rank_type: $('#rank_type').val(),
                rank_autono: row.autono,
                rank: row.rank
            },function(data, status){
                $('#ranked_news').bootstrapTable('remove', {
                    field: 'rank',
                    values: [row.rank]
                });
            });
        },
        'blur .rank': function (e, value, row, index) {
            var $ranked_val =parseInt($(this).val());
            if(isNaN($ranked_val)==false){
                if($ranked_val>15 || $ranked_val<1 || isInteger($ranked_val)==false){
                    $(this).val('');
                    alert('Cover Stories should be ranked in the range of 1 - 15 ');
                }else{
                    $(this).val($ranked_val);
                    $.post('<?php echo $update_url;?>',{
                        rank_type: $('#rank_type').val(),
                        rank_autono: row.autono,
                        rank: $ranked_val
                    },function(data, status){
                        $("#ranked_news").bootstrapTable('refresh');
                        console.log(status);
                        console.log(data);
                    });
                }
            }else{
                $(this).val('');
            }
        },
        'click .rank_disp_caption':function (e, value, row, index) {
            $(this).hide();
            $(this).prev().show();
            $(this).prev().val('');
            $(this).prev().focus();
        },
        'blur .rank_caption': function (e, value, row, index) {
            $caption_val = $.trim($(this).val());
            if($caption_val==''){
                $(this).hide();
                $(this).next().show();
            }else if(validateAlphanumeric($caption_val)){
                $(this).hide();
                if($caption_val == $(this).next().text()){
                    $(this).val('');
                    $(this).next().show();
                }else{
                    $(this).next().html($caption_val).show();
                    $.post('<?php echo $update_url;?>',{
                        rank_type: $('#rank_type').val(),
                        rank_autono: row.autono,
                        rank: row.rank,
                        rank_caption: $caption_val
                    },function(data, status){
                        console.log(status);
                        console.log(data);
                    });
                    alert('Caption has been updated for rank '+row.rank);
                }
            }else{
                alert('News Caption cannot contain special characters other than whitespace, question mark(?),At-the-rate(@), Ampersand (&), Hyphen (-), Left Parenthesis,  Right Parenthesis, Forward Slash(/), Backslash(\\), Comma (,), Apostrophe(\'), Semi-Colon(;), Excalmation (!), Hash(#),Dollar Sign($)' );
            }

            /*var $ranked_val =parseInt($(this).val());
            if(isNaN($ranked_val)==false){
                if($ranked_val>15 || $ranked_val<1 || isInteger($ranked_val)==false){
                    $(this).val('');
                    alert('Cover Stories should be ranked in the range of 1 - 15 ');
                }else{
                    $(this).val($ranked_val);
                    $.post('<?php echo $update_url;?>',{
                        rank_type: $('#rank_type').val(),
                        rank_autono: row.autono,
                        rank: $ranked_val
                    },function(data, status){
                        console.log(status);
                        console.log(data);
                    });
                }
            }else{
                $(this).val('');
            }*/
        }
    };

</script>
</body>
</html>
