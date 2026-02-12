<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<section class="grid">
    <?php 
        $response = $conn->query("select * from news");
        while ($row = $response->fetch_assoc()) {
            echo "<div class='card'>
                    <div>
                        <h3>{$row['title']}</h3>
                        <h4>{$row['date']}</h4>
                    </div>
                    <p>{$row['text']}</p>
                </div>";
        }
    ?>
</section>


<?php include "include/footer.php"; ?>