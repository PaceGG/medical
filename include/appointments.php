<?php
$conn = new mysqli("localhost", "root", "", "medical");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone_number']);
    $email = $conn->real_escape_string($_POST['email']);
    $specialist_id = (int)$_POST['specialist_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    if (empty($time)) die("Выберите время.");

    $check = $conn->query("SELECT * FROM appointments WHERE specialist_id=$specialist_id AND date='$date' AND time='$time'");
    if ($check->num_rows > 0) die("Этот слот уже занят.");

    $conn->query("INSERT INTO appointments (name, phone_number, email, specialist_id, date, time) 
                 VALUES ('$name','$phone','$email',$specialist_id,'$date','$time')");

    header("Location: ../success.php");
    exit;
}
?>