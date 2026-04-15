<?
    session_start();
    require_once("functions.php");
    $login = check_user();
    if (empty($login)) {
        header("Location: logform.php");
    }
    $_SESSION["main_visited"] = "Главная"
?>

<html>
    <head>
        <title>Главная страница</title>
        <link rel="stylesheet" href="Main.css">
    </head>
    <body>
        <header class="header">
            <nav class="header">
                <img class="header" src="Slider_1.jpg" alt="Логотип">
                <article class="header"><a href="Main.php">Главная</a></article>
                <article class="header"><a href="Events.php">Мероприятия</a></article>
                <article class="header"><a href="Courses.php">Кружки</a></article>
                <article class="header"><a href="Visited.php">Посещённые страницы</a></article>
                <article class="header"><a href="Home.php">Личный кабинет</a></article>
                <article class="header"><a href="logout.php">Выход</a></article>
            </nav>
        </header>
        <main>
            <article class="describtion">Шахматный клуб "Северная ладья" - самый крутой клуб на районе!</article>
            <section class="slider">
                <article class="slide"><img class="slide_img" src="Slider_1.jpg" alt="Изображение 1"></article>
                <article class="slide"><img class="slide_img" src="Slider_2.jpg" alt="Изображение 2"></article>
                <article class="slide"><img class="slide_img" src="Slider_3.jpg" alt="Изображение 3"></article>
                <article class="slide"><img class="slide_img" src="Slider_4.jpg" alt="Изображение 4"></article>
            </section>
        </main>
    </body>
</html>