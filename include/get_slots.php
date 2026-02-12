<?php
$conn = new mysqli("localhost", "root", "", "medical");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$specialist_id = (int)$_GET['specialist_id'];
$date = $_GET['date'];

$dayOfWeek = date("w", strtotime($date));

$sched_res = $conn->query("SELECT work_from, work_to FROM schedule WHERE doctor_id=$specialist_id AND day_of_week=$dayOfWeek");
$slots = [];

if ($sched_res->num_rows > 0) {
    $sched = $sched_res->fetch_assoc();
    $start = strtotime($sched['work_from']);
    $end = strtotime($sched['work_to']);

    while ($start + 15*60 <= $end) {
        $time_slot = date("H:i", $start);

        $check = $conn->query("SELECT * FROM appointments WHERE specialist_id=$specialist_id AND date='$date' AND time='$time_slot'");
        if ($check->num_rows === 0) {
            $slots[] = $time_slot;
        }
        $start += 15*60;
    }
}

header('Content-Type: application/json');
echo json_encode($slots);