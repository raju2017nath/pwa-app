<?php
// Database credentials
$host = "localhost";
$dbname = "your_database";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get POST data
        $id = intval($_POST['id']); // make sure id is integer
        $full_name = htmlspecialchars(trim($_POST['full_name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $interests = htmlspecialchars(trim($_POST['interests']));
        $country = htmlspecialchars(trim($_POST['country']));

        // Prepare update query
        $query = "UPDATE registration_details 
                  SET full_name = :full_name, email = :email, gender = :gender, 
                      interests = :interests, country = :country
                  WHERE id = :id";
        
        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':interests', $interests);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute query
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "✅ Record updated successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "❌ Update failed!"]);
        }

    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
