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

    $("#filter_boardresult_list").click(function () {
        var filter_boardresult = $("#filter_boardresult").val();
        var filter_name = $("#filter_name").val();
        var filter_url = $("#filter_url").val();
        var url = $(this).data('url') + "boardresult?name=" + filter_name + "&url=" + filter_url + "&parent=" + filter_boardresult;
        window.location.href = url;

    });
    //$('#field_parent').select2('data', null);
});

function updateBoardresultstatus(url) {
    $.get(url, successBoardResultdata);
}
function successBoardResultdata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateBoardresultstatus(\'' + BASEJSURL + 'boardresult/changeStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateBoardresultstatus(\'' + BASEJSURL + 'boardresult/changeStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
    //$("#myonoffswitch"+returnedData.id).removeProp("disabled");
}