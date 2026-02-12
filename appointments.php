<?php include "include/header.php"; ?>
<?php
$conn = new mysqli("localhost", "root", "", "medical");

$specialists = [];
$result = $conn->query("SELECT id, name, speciality FROM specialists");
while ($row = $result->fetch_assoc()) $specialists[] = $row;
?>

<div class="appointment-container">
    <div class="appointment-card">
        <h2>Запись на прием</h2>
        <form id="appointmentForm" action="include/appointments.php" method="POST" class="appointment-form">
            <div class="grid">
                <div class="form-group">
                    <label for="name">
                        Ваше имя
                    </label>
                    <input type="text" id="name" name="name" placeholder="Введите ваше имя" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">
                        Телефон
                    </label>
                    <input type="tel" id="phone_number" name="phone_number" placeholder="+7 (999) 999-99-99" required>
                </div>

                <div class="form-group">
                    <label for="email">
                        Email
                    </label>
                    <input type="email" id="email" name="email" placeholder="example@mail.com" required>
                </div>

                <div class="form-group">
                    <label for="specialist">
                        Специалист
                    </label>
                    <select name="specialist_id" id="specialist" required>
                        <option value="" disabled selected>-- Выберите специалиста --</option>
                        <?php foreach ($specialists as $s): ?>
                        <option value="<?= $s['id'] ?>">
                            <?= htmlspecialchars($s['name']) ?> - <?= htmlspecialchars($s['speciality']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">
                        Дата приема
                    </label>
                    <select name="date" id="date" required disabled>
                        <option value="" disabled selected>-- Сначала выберите специалиста --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="time">
                        Время приема
                    </label>
                    <select name="time" id="time" required disabled>
                        <option value="" disabled selected>-- Сначала выберите дату --</option>
                    </select>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit">
                    <span>Записаться на прием</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="script/appointments.js"></script>
<?php include "include/footer.php"; ?>