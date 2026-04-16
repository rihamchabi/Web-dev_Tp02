$(document).ready(function () {

    // ➕ Add row
    $("#addCourse").click(function () {

        let row = $(".course-row").first().clone();

        row.find("input").val("");

        $("#courses").append(row);
    });

    // 🧹 Remove row (click right click button)
    $(document).on("click", ".remove", function () {
        if ($(".course-row").length > 1) {
            $(this).closest(".course-row").remove();
        }
    });

    // 📩 Submit
    $("#gpaForm").submit(function (e) {
        e.preventDefault();

        let valid = true;

        $("input[name='course[]']").each(function () {
            if ($(this).val().trim() === "") valid = false;
        });

        $("input[name='credits[]']").each(function () {
            if ($(this).val() <= 0) valid = false;
        });

        if (!valid) {
            $("#result").html(
                <div class="alert alert-warning">
                Please enter valid data
                </div>
            );
            return;
        }

        $.ajax({
            url: "calculate.php",
            type: "POST",
            data: $("#gpaForm").serialize(),
            dataType: "json",

            success: function (res) {

                let alertClass = "alert-info";

                if (res.gpa >= 3.7) alertClass = "alert-success";
                else if (res.gpa >= 3.0) alertClass = "alert-primary";
                else if (res.gpa >= 2.0) alertClass = "alert-warning";
                else alertClass = "alert-danger";

                $("#result").html(
                    <div class="alert ${alertClass}">
                        ${res.message}
                    </div>
                    ${res.tableHtml}
                );
            },

            error: function () {
                $("#result").html(
                    <div class="alert alert-danger">Server error</div>
                );
            }
        });

    });

});
