<?php
// Database credentials
$host = "sql103.infinityfree.com";
$dbname = "if0_40160511_test";
$username = "if0_40160511";
$password = "rs7htY8Qe5";

try {
    // PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all users
    $stmt = $pdo->prepare("SELECT id, full_name, email, gender, interests, country, registration_date FROM registration_details ORDER BY registration_date DESC");
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode($users);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>
