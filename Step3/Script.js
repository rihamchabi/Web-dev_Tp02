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

            $("#result").html(
                <div class="alert alert-info">
                    GPA: ${res.gpa.toFixed(2)} <br>
                    ${res.message}
                </div>
            );

        }
    });
});

});
