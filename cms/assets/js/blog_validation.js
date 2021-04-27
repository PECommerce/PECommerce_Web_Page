$("#newsform").submit(function (event) {
    $(".btn-primary").attr("disabled", true);
    setTimeout(function () {
        timeoutSubmit();
    }, 10000);
    var bodydata = 'details';
    if ($("#field_category").val() == "") {
        $(".field_category").html($(".field_category").html() + "please choose primary Category").show().fadeOut(20000);
        $('html, body').animate({
            scrollTop: ($(".field_category").offset().top) - 50
        }, 1000);
        return false;
    } else if ($("#field_liveblog_title_hn").val() == "") {
        $("#field_liveblog_title_hn").parent().after('<div class="alert alert-danger alert-dismissable title span11">please fill title hindi<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#field_liveblog_title_hn").offset().top) - 50
        }, 1000);
        return false;
    } else if ($("#field_liveblog_title_en").val() == "") {
        $("#field_liveblog_title_en").parent().after('<div class="alert alert-danger alert-dismissable title span11">URL text value required for news<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#field_liveblog_title_en").offset().top) - 50
        }, 1000);
        return false;
    } else if (!validtextcheck($("#field_liveblog_title_en").val()) && $("#field_liveblog_title_en").val() != '') {
        $("#field_liveblog_title_en").parent().after('<div class="alert alert-danger alert-dismissable title span11">Invalid URL text<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#field_liveblog_title_en").offset().top) - 50
        }, 1000);
        return false;
    } else if ($("#field_meta_title").val() == "") {
        $("#field_meta_title").parent().after('<div class="alert alert-danger alert-dismissable title span11">Meta title required<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#field_meta_title").offset().top) - 50
        }, 1000);
        return false;
    } else if ($("#field_meta_title").val() != "" && countUtf8Bytes($("#field_meta_title").val()) >= 90) {
        $("#field_meta_title").parent().after('<div class="alert alert-danger alert-dismissable title span11">Meta title allow a maximum 90 number of characters<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#field_meta_title").offset().top) - 50
        }, 1000);
        return false;
    } else if ($("#field_meta_description").val() == "") {
        $("#field_meta_description").parent().after('<div class="alert alert-danger alert-dismissable title span11">Meta description required<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#field_meta_description").offset().top) - 50
        }, 1000);
        return false;
    } else if ($("#field_meta_description").val() != "" && countUtf8Bytes($("#field_meta_description").val()) >= 200) {
        $("#field_meta_description").parent().after('<div class="alert alert-danger alert-dismissable title span11">Meta description allow a maximum 200 number of characters<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#field_meta_description").offset().top) - 50
        }, 1000);
        return false;
    } else if ($("#field_meta_keywords").val() == "") {
        $("#field_meta_keywords").parent().after('<div class="alert alert-danger alert-dismissable title span11">Meta keywords required<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#field_meta_keywords").offset().top) - 50
        }, 1000);
        return false;
    }
    /*else if($("#field_authors").val() == null || $("#field_authors").val() == ""){
     $("#field_authors").parent().after('<div class="alert alert-danger alert-dismissable title span11">Author required<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
     $('html, body').animate({
     scrollTop: ($("#field_authors").offset().top)-50
     }, 1000);
     return false;
     } */
    else if (CKEDITOR.instances[bodydata].getData() == "")
    {
        $("#cke_details").parent().after('<div class="alert alert-danger alert-dismissable title span11">Add Some text in details<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#cke_details").offset().top) - 50
        }, 1000);
        return false;
    } else if ($('#photo_container').html() == "")
    {
        $("#photo_container").parent().after('<div class="alert alert-danger alert-dismissable title span11">Add Media<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div></div>');
        $('html, body').animate({
            scrollTop: ($("#photo_container").offset().top) - 50
        }, 1000);
        return false;
    } else
        return true;

    event.preventDefault();
});
function countUtf8Bytes(str) {
    var chars = (str.match(/[\uD800-\uDBFF][\uDC00-\uDFFF]|[^]/g) || []).length;
    return chars;
}
function validtextcheck(str) {
    var letters = /^[0-9a-zA-Z_:\- \/]+$/;
    if (str.match(letters)) {
        return true;
    }
    return false;
}
function timeoutSubmit() {
    $(".btn-primary").attr("disabled", false);
}