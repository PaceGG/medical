<?php
include "db.php";

header("Content-Type: application/json; charset=utf-8");

$result = $conn->query("
    SELECT
        id,
        address,
        phone_number,
        work_from,
        work_to,
        lat,
        lon
    FROM contacts
");

$clinics = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $clinics[] = $row;
    }
}

echo json_encode($clinics);