$(document).on('click', 'td a.res_update', function () {
    if (confirm("Are you want to change status?"))
    {
        return true;
    } else
    {
        return false;
    }
});

$(document).on('click', 'td div ul li a.res_del', function () {
    if (confirm("Are you sure to delete it?"))
    {
        return true;
    } else
    {
        return false;
    }
});

// add
$(document).ready(function () {
    $("#videowidgetform").submit(function () {
        if ($("#field_category").val() == "") {
            alert("Please select category");
            return false;
        } else if (CKEDITOR.instances["details"].getData() == "") {
            alert("Please add description");
            return false;
        }
    })
    $("#budgetitemform").submit(function () {
        if ($("#field_category").val() == "") {
            alert("Please select category");
            return false;
        }
    })
    $("#abhiabhiform").submit(function () {
        if ($("#field_category").val() == "") {
            alert("Please select category");
            return false;
        }
    })

    $("#filter_budgetitem_list").click(function () {
        var filter_name = $("#filter_name").val();
        var filter_category = $("#field_filter_category").val();
        var filter_category_name = $("#field_category_filter_name").val();
        var url = $(this).data('url') + "common?name=" + filter_name;
        if (filter_category)
            url += "&category=" + filter_category + "&catname=" + filter_category_name;
        window.location.href = url;

    });
    $("#filter_samagam_list").click(function () {
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "common/samagam_event?name=" + filter_name;
        window.location.href = url;

    });

    $("#filter_videowidget_list").click(function () {
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "common/videowidget?name=" + filter_name;
        window.location.href = url;

    });
    $("#filter_abhiabhi_list").click(function () {
        var filter_name = $("#filter_name").val();
        var filter_category = $("#field_filter_category").val();
        var filter_category_name = $("#field_category_filter_name").val();
        var url = $(this).data('url') + "common/abhiabhi?name=" + filter_name;
        if (filter_category)
            url += "&category=" + filter_category + "&catname=" + filter_category_name;

        window.location.href = url;

    });

    //txtsortinput
    $(".txtsortinput").on('blur', function () {
        var url = $(this).data("url");
        var id = $(this).attr("lang");
        var itemreport = "";
        if ($("#up_" + id).is(':checked')) {
            itemreport = $("#up_" + id).val();
        }
        if ($("#down_" + id).is(':checked')) {
            itemreport = $("#down_" + id).val();
        }
        callAjaxApi(url, id, itemreport, $(this).attr("value"));
    });
    $(".chkItemReport").on('click', function () {
        var url = $(this).data("url");
        var arrid = $(this).attr("id");
        var arr = arrid.split("_");
        var id = arr[1];
        if ($(this).is(':checked'))
            var itemreport = $(this).attr("value");
        else
            var itemreport = '';

        if (itemreport == "up") {
            $("#down_" + id).prop("checked", false);
            $('span', $('#uniform-down_' + id)).removeClass("checked");
        }
        if (itemreport == "down") {
            $("#up_" + id).prop("checked", false);
            $('span', $('#uniform-up_' + id)).removeClass("checked");
        }
        callAjaxApi(url, id, itemreport, $("#sortorder-" + id).attr("value"));
    })
    defaultfillcat(1349092, "बजट 2020");

});
function defaultfillcat(tid, name)
{
    if ($('#field_category').val() == "" && window.location.href.lastIndexOf('abhiabhi_add') > 0) {
        var cname = '<a href="#" onclick="return false;" class="select2-choice" tabindex="-1">   <span>' + name + '</span><abbr class="select2-search-choice-close" style="display:none;"></abbr>   <div><b></b></div></a>';
        $('#s2id_field_category_name').html(cname);
        $('#field_category').val(tid);
    }
}
function callAjaxApi(url, id, itemreport, itemsort) {

    $(".loading_" + id).html('<i class="fa fa-spinner fa-spin" style="font-size: 25px; left:50%;top:50%;z-index: 100000;color:#000;"></i>');
    $.ajax({
        url: url + 'common/budgetreportupdate',
        type: 'POST',
        data: {bid: id, itemreport: itemreport, itemsort: itemsort},
        cache: false,
        success: function (data, textStatus, jqXHR) {
            $(".loading_" + id).html($(".loading_" + id).parent().attr("id"));

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('ERRORS: ' + textStatus);
        }
    });
}


function updateBudgetitemStatus(url) {
    $.get(url, successBudgetdata);
}
function successBudgetdata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateBudgetitemStatus(\'' + BASEJSURL + 'common/changeStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateBudgetitemStatus(\'' + BASEJSURL + 'common/changeStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
}

function updateVideowidgetstatus(url) {
    $.get(url, successVideodata);
}
function successVideodata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateVideowidgetstatus(\'' + BASEJSURL + 'common/changeVideowidgetStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateVideowidgetstatus(\'' + BASEJSURL + 'common/changeVideowidgetStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
}

function updateAbhiabhiitemStatus(url) {
    $.get(url, successAbhiabhidata);
}
function successAbhiabhidata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateAbhiabhiitemStatus(\'' + BASEJSURL + 'common/changeStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateAbhiabhiitemStatus(\'' + BASEJSURL + 'common/changeStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
}