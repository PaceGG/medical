<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha+</title>

    <link rel="shortcut icon" href="assets/header/logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/header.css">
    <link rel="stylesheet" href="assets/style/footer.css">
    <link rel="stylesheet" href="assets/style/table.css">
    <link rel="stylesheet" href="assets/style/map.css">
    <link rel="stylesheet" href="assets/style/grid.css">
    <link rel="stylesheet" href="assets/style/card.css">
    <link rel="stylesheet" href="assets/style/success.css">
    <link rel="stylesheet" href="assets/style/button.css">
    <link rel="stylesheet" href="assets/style/appointment.css">
    <link rel="stylesheet" href="assets/style/doctors.css">
</head>

<body>

    <header>
        <a href="index.php" class="logo">
            <img src="assets/header/logo.svg" alt="Alpha+">
            <h1>Alpha+</h1>
        </a>
        <p>Время</p>
    </header>

    <nav>
        <a href="index.php" <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : ''; ?>>Новости
            и
            акции</a>
        <a href="doctors.php"
            <?php echo basename($_SERVER['PHP_SELF']) == 'doctors.php' ? 'class="active"' : ''; ?>>Наши
            специалисты</a>
        <a href="schedule.php"
            <?php echo basename($_SERVER['PHP_SELF']) == 'schedule.php' ? 'class="active"' : ''; ?>>Расписание работы
            специалистов</a>
        <a href="contacts.php"
            <?php echo basename($_SERVER['PHP_SELF']) == 'contacts.php' ? 'class="active"' : ''; ?>>Контакты</a>
        <a href="appointments.php"
            <?php echo basename($_SERVER['PHP_SELF']) == 'appointments.php' ? 'class="active"' : ''; ?>>Запись</a>
    </nav>

    <main>