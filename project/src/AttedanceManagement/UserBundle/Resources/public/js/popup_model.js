var DeleteConfirmDialog = (function() {
    "use strict";
    var show_delete_confirm_dialog = function(elem) {
        var action = $(elem).attr('action');

        $('#modal-delete-action').modal('show');
        $('#confirm-delete').attr('href', action);
    };
    return {
        show_delete_confirm_dialog : show_delete_confirm_dialog
    };
}());
