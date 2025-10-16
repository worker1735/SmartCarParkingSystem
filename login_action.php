<?php
include('includes/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch user from DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Get available parking slots in real-time
            $slots_result = mysqli_query($conn, "SELECT * FROM parking_areas WHERE available_slots > 0");
            $_SESSION['available_slots'] = [];
            while ($row = mysqli_fetch_assoc($slots_result)) {
                $_SESSION['available_slots'][] = $row;
            }

            // Redirect to slots page
            header("Location: slots.php");
            exit;

        } else {
            echo "<script>alert('❌ Invalid password'); window.location='login.php';</script>";
        }

    } else {
        echo "<script>alert('❌ User not found'); window.location='login.php';</script>";
    }
}
?>
