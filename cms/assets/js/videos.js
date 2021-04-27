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
    $("#filter_video_list").click(function () {
        var filter_name = $("#filter_name").val();
        var url = $(this).data('url') + "videos?name=" + filter_name;
        window.location.href = url;
    });
    $(document).on('click', '#copy_embed_code', function () {
        var divdata = '<iframe frameborder="0" width="480" height="270" src="https://www.dailymotion.com/embed/video/' + $(this).prop("lang") + '" allowfullscreen allow="autoplay"></iframe>';
        $("#pollwidgetdata").text(divdata);
        $("#pollLabel").html($(this).text());
        $(".copypollwidgetdata").attr("data-clipboard-text", divdata);
        $('#myPollModal').modal('show');

    })
    $(document).on('click', '#copy_embed_code_yt', function () {
        var divdata = '<iframe frameborder="0" width="480" height="270" src="https://www.youtube.com/embed/' + $(this).prop("lang") + '" allowfullscreen allow="autoplay"></iframe>';
        $("#pollwidgetdata").text(divdata);
        $("#pollLabel").html($(this).text());
        $(".copypollwidgetdata").attr("data-clipboard-text", divdata);
        $('#myPollModal').modal('show');

    })
    $(document).on('click', '#copy_yt_url', function () {
        var divdata = 'https://www.youtube.com/watch?v=' + $(this).prop("lang");
        $("#pollwidgetdata").text(divdata);
        $("#pollLabel").html($(this).text());
        $(".copypollwidgetdata").attr("data-clipboard-text", divdata);
        $('#myPollModal').modal('show');

    })
    $(document).on('click', '#copy_dm_url', function () {
        var divdata = 'https://www.dailymotion.com/video/' + $(this).prop("lang");
        $("#pollwidgetdata").text(divdata);
        $("#pollLabel").html($(this).text());
        $(".copypollwidgetdata").attr("data-clipboard-text", divdata);
        $('#myPollModal').modal('show');

    })
    $(document).on('click', '.play_yt_video', function () {
        var divdata = '<iframe width="480" height="270" src="https://www.youtube.com/embed/' + $(this).prop("lang") + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        $(".playwidgetdata").html(divdata);
        $('#playVideoModal').modal('show');

    })

    $(document).on('click', '.play_dm_video', function () {
        var divdata = '<iframe width="480" height="270" src="https://www.dailymotion.com/embed/video/' + $(this).prop("lang") + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        $(".playwidgetdata").html(divdata);
        $('#playVideoModal').modal('show');

    })
    $(document).on('click', '.copypollwidgetdata', function () {
        copyToClipboard('pollwidgetdata');
    })
});

function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    document.execCommand("Copy");
    //alert("Copied the text: " + copyText.value);

}
function updateVideostatus(url) {
    $.get(url, successVideodata);
}
function successVideodata(res) {
    var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateVideostatus(\'' + BASEJSURL + 'videos/changeStatus/0/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateVideostatus(\'' + BASEJSURL + 'videos/changeStatus/1/' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
}