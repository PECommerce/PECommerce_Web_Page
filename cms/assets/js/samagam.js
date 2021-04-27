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

    $("#filter_speaker").click(function () {
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "samagam?name=" + filter_name;
        window.location.href = url;

    });
});

function updateSpeakerstatus(url) {
    $.get(url, successSpeakerdata);
}
function successSpeakerdata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateSpeakerstatus(\'' + BASEJSURL + 'samagam/changeStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateSpeakerstatus(\'' + BASEJSURL + 'samagam/changeStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
}
function updateBudgetitemStatus(url) {
    $.get(url, successBudgetdata);
}
function successBudgetdata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateBudgetitemStatus(\'' + BASEJSURL + 'samagam/changeStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateBudgetitemStatus(\'' + BASEJSURL + 'samagam/changeStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
}

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
function callAjaxApi(url, id, itemreport, itemsort) {

    $(".loading_" + id).html('<i class="fa fa-spinner fa-spin" style="font-size: 25px; left:50%;top:50%;z-index: 100000;color:#000;"></i>');
    $.ajax({
        url: url + 'samagam/samagamreportupdate',
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
   $("#filter_samagam_list").click(function () {
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "samagam/event_list?name=" + filter_name;
        window.location.href = url;

    });