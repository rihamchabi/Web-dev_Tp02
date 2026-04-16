$(document).ready(function () {

$("#addCourse").click(function () {
    let row = $(".course-row").first().clone();
    row.find("input").val("");
    $("#courses").append(row);
});

$("#gpaForm").submit(function (e) {
    e.preventDefault();

    $.ajax({
        url: "calculate.php",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",

        success: function (res) {

            if (res.success) {
                $("#result").html(
                    "<div class='alert alert-info'>" +
                    res.message + "<br><br>" +
                    res.tableHtml +
                    "</div>"
                );
            } else {
                $("#result").html(
                    "<div class='alert alert-danger'>" +
                    res.message +
                    "</div>"
                );
            }
        }
    });
});

});
