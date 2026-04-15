<?
    session_start();
    require_once("functions.php");

    $login = check_user();

    $_SESSION["events_visited"] = "Мероприятия";
?>

<html>
    <head>
        <title>Мероприятия</title>
        <link rel="stylesheet" href="Events.css">
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
        <section class="events">
            <?
                if (isset($_GET["id"]))
                {
                    $id = htmlentities($_GET["id"]);

                    $db = new mysqli("MySQL-8.0", "root", "", "site_db");
                
                    $query = "SELECT * FROM events WHERE id=$id";
                    $result = $db->query($query);

                    $row = $result->fetch_row();

                    $row1 = htmlentities($db->real_escape_string($row[1]));
                    $row2 = htmlentities($db->real_escape_string($row[2]));
                    $row3 = htmlentities($db->real_escape_string($row[3]));

                    echo '
                    <section class="event">
                        <img class="event" src="'.$row1.'" alt="Мероприятие 1">
                        <h2 class="event">'.$row2.'</h2>
                        <p class="event">'.$row3.'</p>
                        <a class="event" href="Events.php">Назад</a>
                    </section>
                    ';
                }
                else
                {
                    $db = new mysqli("MySQL-8.0", "root", "", "site_db");
                
                    $query = "SELECT * FROM events";
                    $result = $db->query($query);

                    for ($i = 0; $i < $result->num_rows; $i++)
                    {
                        $row = $result->fetch_row();

                        $row1 = htmlentities($db->real_escape_string($row[1]));
                        $row2 = htmlentities($db->real_escape_string($row[2]));
                        $row3 = htmlentities($db->real_escape_string($row[3]));

                        $more_id = $i + 1;

                        echo '
                        <section class="event">
                            <img class="event" src="'.$row1.'" alt="Мероприятие 1">
                            <h2 class="event">'.$row2.'</h2>
                            <p class="event">'.$row3.'</p>
                            <a class="event" href="Events.php?id='.$more_id.'">Узнать больше</a>
                        </section>
                        ';
                    }
                }

                $db->close();
            ?>
        </section>
    </body>
</html>