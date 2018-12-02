window.moment = require('moment');

require('tempusdominus-bootstrap-4');


$(function () {
    $('#datetimepicker').datetimepicker();

    // End time Should be after start
    $('#datetimepicker-start').datetimepicker();
    $('#datetimepicker-end').datetimepicker({
        useCurrent: false
    });
    $("#datetimepicker-start").on("change.datetimepicker", function (e) {
        $('#datetimepicker-end').datetimepicker('minDate', e.date);
    });
    $("#datetimepicker-end").on("change.datetimepicker", function (e) {
        $('#datetimepicker-start').datetimepicker('maxDate', e.date);
    });
});