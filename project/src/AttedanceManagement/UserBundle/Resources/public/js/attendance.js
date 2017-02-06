var Attendance = (function() {
    'use strict';

    var datepicker_conf = function() {
        $('.datepicker').datetimepicker({
            format: 'DD-MM-YYYY HH:mm'
        });
    }

    var submit_attendance = function(elm) {
        var absentDate = $(elm).parent('td').siblings('td').children('input[name="date_absent"]').val();
        var sessionOne = $(elm).parent('td').siblings('td').children('input[name="session_one"]:checked');
        var sessionTwo = $(elm).parent('td').siblings('td').children('input[name="session_two"]:checked');

        if (sessionOne.val() === undefined) {
            sessionOne = 0;
        } else {
            sessionOne = 1;
        }

        if (sessionTwo.val() === undefined) {
            sessionTwo = 0;
        } else {
            sessionTwo = 1;
        }

        var url = $('table').attr('data-save-route');
        var studentId = $(elm).parent('td').siblings('td').children('input').attr('data-id');
        var subject = get_parameter_by_name('attendance_filter_form[subject]');
        var classGroup = get_parameter_by_name('attendance_filter_form[classGroup]');
        if (subject == null || classGroup == null) {
            $('#subject-group-msg').removeClass('hide')

            return false;
        }

        $.ajax({
            url : url,
            method: 'POST',
            data: {
                'date': absentDate,
                'session_one' : sessionOne,
                'session_two' : sessionTwo,
                'subject' : subject,
                'class_group' : classGroup,
                'student' : studentId
            },
            success: function(data) {
                console.log(data.msg);
                window.location.reload();
            },
            error: function(request, status, error) {
                console.log(request.responseText);
            }
         });
    }

    var get_parameter_by_name = function(name, url) {
        if (!url) url = decodeURIComponent(window.location.href);
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';

        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    return {
        datepicker_conf : datepicker_conf,
        submit_attendance : submit_attendance,
    }
}());

document.addEventListener('DOMContentLoaded', function() {
    Attendance.datepicker_conf();
}, false);

