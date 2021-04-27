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
    if (confirm("Are you sure to Unpublish it?"))
    {
        return true;
    } else
    {
        return false;
    }
});

// add
$(document).ready(function () {

    $("#filter_poll_list").click(function () {
        var filter_boardresult = $("#filter_poll").val();
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "poll?name=" + filter_name;
        window.location.href = url;

    });
    //$('#field_parent').select2('data', null);
});

function updatePollstatus(url) {
    $.get(url, successPolldata);
}
function successPolldata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updatePollstatus(\'' + BASEJSURL + 'poll/updateStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updatePollstatus(\'' + BASEJSURL + 'poll/updateStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
    //$("#myonoffswitch"+returnedData.id).removeProp("disabled");
}