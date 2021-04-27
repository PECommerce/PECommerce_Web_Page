
$(document).ready(function () {
    $("#sidebar").prop("style", "position:absolute;height:" + (window.innerHeight - 70) + "px;overflow: -moz-scrollbars-vertical;overflow-y:scroll;overflow-x: hidden;");
    $('#field_publishdate').datetimepicker();
    $('#field_start').datetimepicker();
    $('#expirydate').datetimepicker();
    $("#reset_cat").on('click', function () {
        $('#field_filter_category').val("");
        $("#field_category_filter_name").val("");
    });
    //$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    $('input[type=checkbox],input[type=radio]').not('.onoffswitch-checkbox').uniform();

    $('select').select2();
    $('.datepicker').datepicker();
});