<?php
// Database credentials
$host = "localhost";
$dbname = "test";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id = intval($_POST['id']); // make sure id is integer

        // Prepare delete query
        $query = "DELETE FROM registration_details WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "✅ Record deleted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "❌ Delete failed!"]);
        }

    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
