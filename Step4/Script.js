$(document).ready(function () {

    $("#addCourseBtn").click(function () {
        let row = $(".course-row").first().clone();
        row.find("input").val("");
        row.find("select").val("4");
        $("#courses").append(row);
    });

    $(document).on("click", ".delete-btn", function () {
        if ($(".course-row").length > 1) {
            $(this).closest(".course-row").remove();
        }
    });

    $("#gpaForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: "../calculate.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",

            success: function (res) {
                $("#result").html(
                    "<div class='alert alert-success'>" +
                    "GPA: " + res.gpa + "<br>" +
                    res.message +
                    "</div>"
                );
            },

            error: function () {
                $("#result").html("<div class='alert alert-danger'>Server Error</div>");
            }
        });

    });

});
