require('jquery-countdown');

function dynamicCountdown(object, finalDate) {
    object.countdown(finalDate, function (event) {

        var format = '%M:%S';
        if (event.offset.hours > 0) {
            format = '%H:' + format;
        }
        if (event.offset.totalDays > 0) {
            format = '%-d day%!d ' + format;
        }
        if (event.offset.weeks > 0) {
            format = '%-w week%!w ' + format;
        }

        object.html(event.strftime(format));

    });
}


$(document).ready(function () {
    // Until a specific date
    // <div data-countdown="2020/12/07 4:00:00"></div>
    $('[data-countdown]').each(function () {
        var $this = $(this), finalDate = $(this).data('countdown');
        dynamicCountdown($this, finalDate);
    });

    // For some defined seconds
    // <div data-countdown-for="120"></div>
    $('[data-countdown-for]').each(function () {
        var $this = $(this);
        var forSeconds = parseInt($(this).data('countdown-for'));
        var finalDate = new Date(Date.now() + (1000 * forSeconds));
        dynamicCountdown($this, finalDate);
    });
});