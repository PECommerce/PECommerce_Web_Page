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

    $("#filter_election_list").click(function () {
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "elections?name=" + filter_name;
        window.location.href = url;

    });
    $("#filter_party_list").click(function () {
        var filter_election = $("#filter_party_election").val();
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "elections/parties?name=" + filter_name + "&election=" + filter_election;
        window.location.href = url;

    });
    $("#filter_member").click(function () {
        var filter_party = $("#filter_member_party").val();
        var filter_name = $("#filter_name").val();
        var filter_election = $("#filter_election").val();
        var url = $(this).data('url') + "elections/members?name=" + filter_name + "&party=" + filter_party + "&election=" + filter_election;
        window.location.href = url;

    });
    $("#filter_party_results").click(function () {
        var filter_election = $("#filter_party_election").val();
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "elections/partiesresult?name=" + filter_name + "&election=" + filter_election;
        window.location.href = url;

    });
    $("#filter_member_results").click(function () {
        var filter_party = $("#filter_party").val();
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "elections/memberresult?name=" + filter_name + "&party=" + filter_party;
        window.location.href = url;

    });
});


function updateElectionstatus(url) {
    $.get(url, successElectiondata);
}
function successElectiondata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateElectionstatus(\'' + BASEJSURL + 'elections/changeStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateElectionstatus(\'' + BASEJSURL + 'elections/changeStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
    //$("#myonoffswitch"+returnedData.id).removeProp("disabled");
}
$("#filter_election").change(function () {
    var val2 = $('#filter_election option:selected').val();
    var url = "getParties";

    $.ajax({
        type: 'POST',
        url: url,
        data: {'id': val2},
        success: function (data) {
            $('#partiesSelect').html(data);
        }
    });

});