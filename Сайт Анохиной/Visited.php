<?
    session_start();
    require_once("functions.php");

    $login = check_user();
?>


<html>
    <head>
        <title>Посещённые страницы</title>
        <link rel="stylesheet" href="Visited.css">
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
            <article class="visited_list">Посещённые страницы:</article>
            <ul class="visited_list">
                <?  
                    if (isset($_SESSION["main_visited"])) {
                        echo '<li>'.$_SESSION["main_visited"].'</li>';
                    }

                    if (isset($_SESSION["events_visited"])) {
                        echo '<li>'.$_SESSION["events_visited"].'</li>';
                    }

                    if (isset($_SESSION["home_visited"])) {
                        echo '<li>'.$_SESSION["home_visited"].'</li>';
                    }
                    if (isset($_SESSION["courses_visited"])) {
                        echo '<li>'.$_SESSION["courses_visited"].'</li>';
                    }
                ?>
            </ul>
        </main>
    </body>
</html>