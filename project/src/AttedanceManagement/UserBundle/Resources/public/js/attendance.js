var Attendance = (function() {
    'use strict';

    var datepicker_conf = function() {
        $('.datepicker').datetimepicker({
            format: 'DD-MM-YYYY HH:mm'
        });
    }

    return {
        datepicker_conf : datepicker_conf,
    }
}());

document.addEventListener('DOMContentLoaded', function() {
    Attendance.datepicker_conf();
}, false);

