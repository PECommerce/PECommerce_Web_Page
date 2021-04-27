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

$(document).on('click', '#btnSave', function () {
    var values = $("input[name='field_image[]']")
              .map(function(){return $(this).val();}).get();
      
      
    if($("#field_title").val() == ""){
        alert("Please enter title.");
        return false;
    } 
    else if($("#field_url_text").val() == ""){
        alert("Please enter url text.");
        return false;
    } 
    else if($("#field_story").val() == ""){
        alert("Please upload zip file.");
        return false;
    } 
    else if(values == ""){
        alert("Please upload a image");
        return false;
    }
});

$(document).on('click', '#btnUpdate', function () {
    if($("#field_title").val() == ""){
        alert("Please enter title.");
        return false;
    } 
});

// add
$(document).ready(function () {

    /*$("#filter_ampstories_list").click(function () {
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "ampstories?title=" + filter_name;
        window.location.href = url;

    });*/
     $("#filter_ampstories_list").click(function () {
        var filter_site = $("#filter_site").val();
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "ampstories?title=" + filter_name + "&site=" + filter_site;
        window.location.href = url;

    });

});


function updateAmpstorieStatus(url) {
    $.get(url, successampstoriesdata);
}
function successampstoriesdata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateAmpstorieStatus(\'' + BASEJSURL + 'ampstories/changeStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateAmpstorieStatus(\'' + BASEJSURL + 'ampstories/changeStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
}
