function loadNewsSubcategories(category, selected_subcategory, populateId, type){
    if(category!=''){
        $.ajax({
            url: '/news/editor/loadsubcategories',
            dataType: 'json',
            type: 'post',
            data: {category_id:category},
            success: function( response, textStatus, jQxhr ){
                var options = '<option value="">Please select News Sub Category</option>';
                $.each(response, function(subCatId,subCatName) {
                    if(selected_subcategory==subCatId){
                        options += '<option value="'+subCatId+'" selected>'+subCatName+'</option>';
                    }else{
                        options += '<option value="'+subCatId+'">'+subCatName+'</option>';
                    }
                });
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
