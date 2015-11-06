function loadNewsSubcategories(category, selected_subcategory, populateId, type){
    if(category!=''){
        $.ajax({
            url: '/news/editor/loadsubcategories',
            dataType: 'json',
            type: 'post',
            data: {category_id:category},
            success: function( response, textStatus, jQxhr ){
                console.log(response.length);
                var options = '';
                var cnt =0;
                $.each(response, function(subCatId,subCatName) {
                    cnt++;
                    if(selected_subcategory==subCatId){
                        options += '<option value="'+subCatId+'" selected>'+subCatName+'</option>';
                    }else{
                        options += '<option value="'+subCatId+'">'+subCatName+'</option>';
                    }
                });
                if(cnt==0){
                    options = '<option value="0">Please select News Sub Category</option>';
                }else{
                    options = '<option value="">Please select News Sub Category</option>'+options;
                }
                switch(type){
                    case 'object':
                        populateId.html(options);
                        break;
                    case 'id':
                        $('#'+populateId).html(options);
                    case 'class':
                        $('.'+populateId).html(options);
                    case 'name':
                        $('[name='+populateId+']').html(options);
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    }
}


function isInteger(x) {
    return Math.round(x) === x;
}

function validateAlphanumeric(str){
    var filter = /^[\w\?\@\&\-\(\)\/\,\(\)\'\!\#\$\ \.\/]+$/;

    if (filter.test(str)) {
        return true;
    }
    else {
        return false;
    }
}
