<?php
// Database credentials

$host = "sql103.infinityfree.com";
$dbname = "if0_40160511_test";
$username = "if0_40160511";
$password = "rs7htY8Qe5";

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set error mode
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if POST data is received
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get and sanitize input values
        $full_name = htmlspecialchars(trim($_POST['full_name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $interests = htmlspecialchars(trim($_POST['interests']));
        $country = htmlspecialchars(trim($_POST['country']));

        // Prepare SQL query using placeholders (prevents SQL injection)
        $query = "INSERT INTO registration_details (full_name, email, gender, interests, country)
                  VALUES (:full_name, :email, :gender, :interests, :country)";
        
        $stmt = $pdo->prepare($query);

        // Bind parameters to placeholders
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':interests', $interests);
        $stmt->bindParam(':country', $country);

        // Execute query
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "✅ Registration successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "❌ Registration failed!"]);
        }

    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
