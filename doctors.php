<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<section class="doctors grid">
    <?php
        $response = $conn->query("select * from specialists");
        while ($row = $response->fetch_assoc()) {
            echo "
                <div class='card'>
                    <img src='assets/specialists/{$row['photo']}' alt='{$row['name']}'>
                    <h3>{$row['name']}</h3>
                    <p>{$row['speciality']}</p>
                </div>"
            ;
        }
    ?>

</section>
<?php include "include/footer.php"; ?>