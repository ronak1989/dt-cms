/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#defaultForm').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/news/upload_attachment'
    });

    // Enable iframe cross-domain access via redirect option:
    /*$('#defaultForm').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );*/

    // Load existing files:
    $('#defaultForm').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        type:'GET',
        url: $('#defaultForm').fileupload('option', 'url'),
        data: { articleId:$('#articleId').val()},
        dataType: 'json',
        context: $('#defaultForm')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        console.log(result);
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
});
