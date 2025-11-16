$(document).ready(function() {

    //code for index.htm to handle form submission
   $("#regForm").on("submit", function(e) {
    e.preventDefault(); // prevent page reload

    // Collect form inputs
    let full_name = $("#name").val().trim();
    let email = $("#email").val().trim();
    let gender = $("input[name='gender']:checked").val();
    let interests = [];
    $("input[type='checkbox']:checked").each(function() {
      interests.push($(this).val());
    });
    let country = $("#country").val();

    // Basic validation
    if (!full_name || !email || !gender || interests.length === 0 || !country) {
      alert("⚠️ Please fill all fields before submitting!");
      return;
    }

    // Prepare data object for API
    let formData = {
      full_name: full_name,
      email: email,
      gender: gender,
      interests: interests.join(", "),
      country: country
    };

    // AJAX POST request
    $.ajax({
      url: "api/registration_api.php",   // <-- your backend API endpoint
      type: "POST",
      data: formData,
      success: function(response) {
        alert(response); // success message from backend
        $("#regForm")[0].reset(); // clear form after submit
      },
      error: function(xhr, status, error) {
        console.log("Error:", error);
        alert("❌ Something went wrong while submitting!");
      }
    });//end of ajax

  });//end of form submission

      //code for show.htm to load and manage user data
      // Load data from backend (e.g., get_data.php)
    
      //loadUsers();

function loadUsers() {
    console.log("Loading users...");
  $.ajax({
    url: "api/show_api.php",
    type: "GET",
    dataType: "json",
    success: function(data) {
      let rows = "";
      $.each(data, function(index, user) {
        rows += `
          <tr>
            <td>${user.id}</td>
            <td>${user.full_name}</td>
            <td>${user.email}</td>
            <td>${user.gender}</td>
            <td>${user.interests}</td>
            <td>${user.country}</td>
            <td>${user.registration_date}</td>
            <td>
              <button class="btn btn-sm btn-warning editBtn" data-id="${user.id}">Edit</button>
              <button class="btn btn-sm btn-danger deleteBtn" data-id="${user.id}">Delete</button>
            </td>
          </tr>
        `;
      });
      $("#userTable").html(rows);
    }
  });
}//end of loadUsers
loadUsers();

      // Delete button click handler
      $(document).on("click", ".deleteBtn", function() {
        let id = $(this).data("id");
        if (confirm("Are you sure you want to delete this record?")) {
          $.ajax({
            url: "api/delete_user_api.php",
            type: "POST",
            data: { id: id },
            success: function(response) {
              alert(response);
              loadUsers(); // reload table after deletion
            }
          });
        }
      });

      // Edit button click handler
      $(document).on("click", ".editBtn", function() {
        let id = $(this).data("id");
        window.location.href = "api/edit_user.html?id=" + id;
      });

    });// End of document ready