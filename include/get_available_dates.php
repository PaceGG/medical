<?php
$conn = new mysqli("localhost", "root", "", "medical");
$specialistId = $_GET['specialist_id'] ?? 0;
$availableDates = [];

if ($specialistId) {
    $days = [];
    $res = $conn->query("SELECT day_of_week, work_from, work_to FROM schedule WHERE doctor_id = $specialistId");
    while ($row = $res->fetch_assoc()) {
        $days[$row['day_of_week']] = ['from' => $row['work_from'], 'to' => $row['work_to']];
    }

    if (!empty($days)) {
        $today = new DateTime();
        for ($i = 0; $i < 14; $i++) {
            $date = (clone $today)->modify("+$i day");
            $dow = (int)$date->format('w');
            if (isset($days[$dow])) {
                $work_from = $days[$dow]['from'];
                $work_to = $days[$dow]['to'];

                $dateStr = $date->format('Y-m-d');
                $takenTimes = [];
                $stmt = $conn->prepare("SELECT time FROM appointments WHERE specialist_id = ? AND time BETWEEN ? AND ?");
                $stmt->bind_param("iss", $specialistId, $work_from, $work_to);
                $stmt->execute();
                $res2 = $stmt->get_result();
                while ($r = $res2->fetch_assoc()) {
                    $takenTimes[] = $r['time'];
                }

                $start = new DateTime($work_from);
                $end = new DateTime($work_to);
                $hasFreeSlot = false;
                while ($start < $end) {
                    $slot = $start->format('H:i:s');
                    if (!in_array($slot, $takenTimes)) {
                        $hasFreeSlot = true;
                        break;
                    }
                    $start->modify('+1 hour');
                }

                if ($hasFreeSlot) {
                    $availableDates[] = $dateStr;
                }
            }
        }
    }
}

header('Content-Type: application/json');
echo json_encode($availableDates);