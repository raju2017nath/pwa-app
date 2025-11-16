// Handle box click
function openPage(page) {
    console.log("Opening: " + page);
    window.location.href = page; 
}

// Register service worker
if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("service-worker.js")
        .then(() => console.log("Service Worker Registered"));
}

$(document).ready(function () {

    $("#dataForm").submit(function (e) {
        e.preventDefault();

        let data = {
            field1: $("#field1").val(),
            field2: $("#field2").val(),
            field3: $("#field3").val()
        };

        $.ajax({
            url: "https://your-api.onrender.com/add",   // <-- Change this
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(data),
            success: function (res) {
                $("#msg").html("<div class='alert alert-success'>Added Successfully!</div>");
                $("#dataForm")[0].reset();
            },
            error: function () {
                $("#msg").html("<div class='alert alert-danger'>Error saving data!</div>");
            }
        });
    });

});
