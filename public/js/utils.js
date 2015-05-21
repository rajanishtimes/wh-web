var newsletter = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        };

        return true;
    },
    validate: function () {
        if (newsletter.check("email") == false) {
            return false;
        }
        $("#newsletterForm")[0].submit();
    }
}

$(document).ready(function () {
    $("#newsletterForm .alert").hide();
});
