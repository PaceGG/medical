<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>

<section class="table">
    <table>
        <thead>
            <tr>
                <th>ФИО</th>
                <th>Специальность</th>
                <th>ПН</th>
                <th>ВТ</th>
                <th>СР</th>
                <th>ЧТ</th>
                <th>ПТ</th>
                <th>СБ</th>
                <th>ВС</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $query = "
                SELECT 
                    s.id,
                    s.name,
                    s.speciality,
                    s.photo,
                    sch.day_of_week,
                    sch.work_from,
                    sch.work_to
                FROM specialists s
                LEFT JOIN schedule sch ON s.id = sch.doctor_id
                ORDER BY s.name, sch.day_of_week
            ";
            
            $result = $conn->query($query);
            
            $current_doctor_id = null;
            $schedule = array_fill(0, 7, '-');
            $doctor_name = '';
            $doctor_speciality = '';
            
            while ($row = $result->fetch_assoc()) {
                if ($current_doctor_id != $row['id']) {
                    if ($current_doctor_id != null) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($doctor_name) . "</td>";
                        echo "<td>" . htmlspecialchars($doctor_speciality) . "</td>";
                        foreach ($schedule as $day_schedule) {
                            echo "<td>" . $day_schedule . "</td>";
                        }
                        echo "</tr>";
                    }
                    
                    $current_doctor_id = $row['id'];
                    $doctor_name = $row['name'];
                    $doctor_speciality = $row['speciality'];
                    $schedule = array_fill(0, 7, '-');
                }
                
                if ($row['day_of_week'] !== null) {
                    $day_index = $row['day_of_week'] - 1;
                    if ($day_index < 0) $day_index = 6;
                    $schedule[$day_index] = date('H:i', strtotime($row['work_from'])) . ' - ' . date('H:i', strtotime($row['work_to']));
                }
            }
            
            if ($current_doctor_id != null) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($doctor_name) . "</td>";
                echo "<td>" . htmlspecialchars($doctor_speciality) . "</td>";
                foreach ($schedule as $day_schedule) {
                    echo "<td>" . $day_schedule . "</td>";
                }
                echo "</tr>";
            }
            
            if ($current_doctor_id == null) {
                echo "<tr><td colspan='9'>Нет данных о врачах</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<?php include "include/footer.php"; ?>