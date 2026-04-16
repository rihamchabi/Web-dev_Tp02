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

            let color = "alert-info";

            if (res.gpa >= 3.7) color = "alert-success";
            else if (res.gpa >= 3.0) color = "alert-primary";
            else if (res.gpa >= 2.0) color = "alert-warning";
            else color = "alert-danger";

            $("#result").html(
                <div class="alert ${color}">
                ${res.message}
                </div>
            );

            let percent = (res.gpa / 4) * 100;

            $("#bar").css("width", percent + "%");
            $("#bar").text(res.gpa.toFixed(2));
        }
    });
});

});
