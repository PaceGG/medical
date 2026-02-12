<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>

<section class="grid">
    <?php 
        $response = $conn->query("SELECT * FROM contacts");
        while ($row = $response->fetch_assoc()) {
            $work_hours = "";
            if ($row['work_from'] && $row['work_to']) {
                $work_from = date('H:i', strtotime($row['work_from']));
                $work_to = date('H:i', strtotime($row['work_to']));
                $work_hours = "<p class='work-hours'>Время работы: {$work_from} - {$work_to}</p>";
            }
            
            echo "
                <div class='card clinic-card'
                    data-lat='{$row['lat']}'
                    data-lon='{$row['lon']}'>
                    <h3>{$row['address']}</h3>
                    <p class='phone'>{$row['phone_number']}</p>
                    {$work_hours}
                </div>
            ";
        }
    ?>
</section>

<div class="grid"><button id="find-clinic">Найти ближайшую клинику</button></div>

<div id="map" class="map"></div>

<script src="script/geolocation.js"></script>

<?php include "include/footer.php"; ?>