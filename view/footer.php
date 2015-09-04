<script src="<?php echo _CONST_JS_PATH;?>bootstrap.min.js"></script>

<!-- chart js -->
<script src="<?php echo _CONST_JS_PATH;?>chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo _CONST_JS_PATH;?>progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo _CONST_JS_PATH;?>icheck/icheck.min.js"></script>

<script src="<?php echo _CONST_JS_PATH;?>custom.js"></script>

<!-- moris js -->
<!-- <script src="<?php echo _CONST_JS_PATH;?>moris/raphael-min.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>moris/morris.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>moris/example.js"></script> -->
<!-- Datatables -->
<!-- <script src="<?php echo _CONST_JS_PATH;?>datatables/js/jquery.dataTables.js"></script> -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="<?php echo _CONST_JS_PATH;?>datatables/tools/js/dataTables.tableTools.js"></script>
<!-- multiselect -->
<script src="<?php echo _CONST_JS_PATH;?>jquery.multi-select.js"></script>
<!-- select2 -->
<script src="<?php echo _CONST_JS_PATH;?>select/select2.full.js"></script>
<!-- datepicker -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>moment.min2.js"></script>
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>datepicker/daterangepicker.js"></script>
<!-- / datepicker -->
<!-- editor -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>tinymce/tinymce.min.js"></script>
<!-- fileupload -->
<script type="text/javascript" src="<?php echo _CONST_JS_PATH;?>jquery.uploadfile.js"></script>
<!-- form validation -->
<script type="text/javascript">
 window.ParsleyExtend = {
  asyncValidators: {
    validatesitename: {
      fn: function (xhr) {
        window.ParsleyUI.removeError(this,'remote');
        window.ParsleyUI.removeError(this,'errorSiteName');
        if(xhr.status == '200'){
           return 200;
        }
        if(xhr.status == '404'){
           response = $.parseJSON(xhr.responseText);
           window.ParsleyUI.addError(this,'errorSiteName',response.error);
        }
      },
      url: '/api/validationField'
    }
  }
};
</script>
<script type="text/javascript" src="http://parsleyjs.org/dist/parsley.min.js"></script>
<script type="text/javascript" src="http://parsleyjs.org/dist/parsley.remote.min.js"></script>




<script>
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>Full name:</td>'+
                '<td>'+d.name+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Extension number:</td>'+
                '<td>'+d.extn+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Extra info:</td>'+
                '<td>And any further details here (images etc)...</td>'+
            '</tr>'+
        '</table>';
    }
    $(document).ready(function () {
        $('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });

    var asInitVals = new Array();
    $(document).ready(function () {
        var oTable = $('#site-details').DataTable({
            "oLanguage": {
                "sSearch": "Search all columns:"
            },
            "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            "sPaginationType": "full_numbers"
        });
        $('#site-details tbody').on( 'click', 'tr', function () {
            console.log(oTable.row());
        });

        $(".select2_single").select2({
            placeholder: "Select",
            allowClear: true
        });

        $(".selct_single_registration_template").select2({
          placeholder: "Please Select",
          allowClear: true
        });
    });
</script>
<!-- form validation -->
<script type="text/javascript">
    $(document).ready(function () {
        $.listen('parsley:field:validate', function () {
            validateFront();
        });
        $('#cms_users .btn-success').on('click', function () {
            $('#cms_users').parsley().validate();
            validateFront();
        });
        var validateFront = function () {
            if (true === $('#cms_users').parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        };
        /*if($("#site_url").length > 0) {
            $('#site_url').parsley().addAsyncValidator(
              'validateSitename', function (xhr) {
                   var siteName = $('#site_url').parsley();
                   window.ParsleyUI.removeError(siteName,'remote');
                   window.ParsleyUI.removeError(siteName,'errorSiteName');
                   if(xhr.status == '200'){
                       return 200;
                   }
                   if(xhr.status == '404'){
                       response = $.parseJSON(xhr.responseText);
                       window.ParsleyUI.addError(siteName,'errorSiteName',response.error);
                   }
              }, '/api/validationField'
            );
        }*/
        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').html($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').html($title);
            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });
        // Form confirm (yes/ok) handler, submits form
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
            $(this).data('form').submit();
        });
    });
</script>
<!-- /form validation -->
<!-- multiselect -->
<script>
    $(document).ready(function () {
        $('.multiselect').multiSelect();
    });
</script>
<!-- /multiselect -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.date-picker').daterangepicker({
            singleDatePicker: true,
            format: 'Do MMMM YYYY',
            /*endDate: '<?php echo date("jS F Y");?>',*/
            minDate: '<?php echo date("1st January 2013");?>',
            maxDate: '<?php echo date("jS F Y");?>',
            calender_style: "picker_4"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea.show-editor",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern imagetools"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
    var settings = {
        url: "/class/upload.php",
        dragDrop:false,
        multiple:false,
        fileName: "myfile",
        showDone:false,
        allowedTypes:"jpg,png,gif",
        returnType:"json",
         onSuccess:function(files,data,xhr,pd)
        {
           // alert((data));
           $("#"+pd.statusbar[0].id).parent().children(':first-child').hide();
           pd.filename.html('<img src="/uploads/'+data[0]['filename']+'">');
           pd.progressDiv.hide();
           $("#nifty_chart").val(data[0]['filename']);
           console.log(pd);
        },
        showDelete:true,
        deleteCallback: function(data,pd)
        {
            for(var i=0;i<data.length;i++)
            {
                $.post("class/delete.php",{op:"delete",name:data[i]},
                function(resp, textStatus, jqXHR)
                {
                    //Show Message
                    $("#status").append("<div>File Deleted</div>");
                });
             }
            $("#"+pd.statusbar[0].id).parent().children(':first-child').show();
            console.log($("."+pd.statusbar[0].className).parent().children(':first-child'));
            pd.statusbar.hide(); //You choice to hide/not.
        }
    }
    $("#chart_img").uploadFile(settings);
    settings.allowedTypes = "xls,xlsx";
    settings.onSuccess = function (files,data,xhr,pd){
        $("#"+pd.statusbar[0].id).parent().children(':first-child').hide();
        var uploadedFileName = data[0]['filename'];
        pd.filename.html('<iframe src="/api/filereader.php?filename='+encodeURIComponent(uploadedFileName)+'" width="100%" frameBorder="0"></iframe>');
        $("#buzzer_filepath").val(uploadedFileName);
        pd.progressDiv.hide();
        console.log(pd);
    }
    $("#csv_upload").uploadFile(settings);
});
</script>


