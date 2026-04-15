<?
    session_start();
    require_once("functions.php");

    $login = check_user();

    $_SESSION["courses_visited"] = "Кружки";

    $db1 = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
?>

<html>
    <head>
        <title>Кружки</title>
        <link rel="stylesheet" href="Courses.css">
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
        <section class="courses">
            <?
                if (isset($_GET["id"]))
                {
                    $id = htmlentities($_GET["id"]);

                    $db = new mysqli("MySQL-8.0", "root", "", "site_db");
                
                    $query = "SELECT * FROM courses WHERE id=$id";
                    $result = $db->query($query);

                    $row = $result->fetch_row();

                    $img = htmlentities($db->real_escape_string($row[1]));
                    $title = htmlentities($db->real_escape_string($row[2]));
                    $describtion = htmlentities($db->real_escape_string($row[3]));
                    $max_places = htmlentities($db->real_escape_string($row[4]));
                    $places_zanato = htmlentities($db->real_escape_string($row[5]));

                    echo '
                    <section class="course">
                        <img class="course" src="'.$img.'" alt="Мероприятие 1">
                        <h2 class="course">'.$title.'</h2>
                        <p class="course">'.$describtion.'</p>
                        <a class="course" href="Courses.php">Назад</a>
                    ';

                    $places_free = $max_places - $places_zanato;

                    if ($places_free <= 0)
                    {
                        echo '<p class="course">Свободных мест нет</p>';
                    }
                    else
                    {
                        $db1 = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
            
                        $query1 = "SELECT `login`, an_order FROM orders WHERE `login`='".$login."' AND an_order='".$title."'";
                        $result1 = $db1->query($query1);
                        $result1_row = $result1->fetch_row();

                        if ($result1_row != null)
                        {
                            echo '<p class="course"><a id="zapis" href="delete_order.php?course_title='.$title.'">Отписаться</a></p>
                            </section>
                            ';
                        }
                        else
                        {
                            echo '
                            <p class="course">Свободно '.$places_free.' мест</p>
                            <p class="course"><a id="zapis" href="order_form.php?course_title='.$title.'">Записаться</a></p>
                            </section>
                            ';
                        }
                    }
                }
                else
                {
                    $db = new mysqli("MySQL-8.0", "root", "", "site_db");
                
                    $query = "SELECT * FROM courses";
                    $result = $db->query($query);

                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_row();
                        
                        $id = htmlentities($db->real_escape_string($row[0]));
                        $img = htmlentities($db->real_escape_string($row[1]));
                        $title = htmlentities($db->real_escape_string($row[2]));
                        $describtion = htmlentities($db->real_escape_string($row[3]));
                        $max_places = htmlentities($db->real_escape_string($row[4]));
                        $places_zanato = htmlentities($db->real_escape_string($row[5]));

                        echo '
                        <section class="course">
                        <img class="course" src="'.$img.'" alt="Кружок 1">
                        <h2 class="course">'.$title.'</h2>
                        <p class="course">'.$describtion.'</p>
                        <p class="course"><a href="Courses.php?id='.$id.'">Узнать больше</a></p>
                        ';

                        $places_free = $max_places - $places_zanato;

                        if ($places_free <= 0)
                        {
                            echo '<p class="course">Свободных мест нет</p>';
                        }
                        else
                        {
                            $db1 = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
                
                            $query1 = "SELECT `login`, an_order FROM orders WHERE `login`='".$login."' AND an_order='".$title."'";
                            $result1 = $db1->query($query1);
                            $result1_row = $result1->fetch_row();

                            if ($result1_row != null)
                            {
                                $page = "Courses.php";
                                echo '<p class="course"><a id="zapis" href="delete_order.php?course_title='.$title.'&page='.$page.'">Отписаться</a></p>
                                </section>
                                ';
                            }
                            else
                            {
                                echo '
                                <p class="course">Свободно '.$places_free.' мест</p>
                                <p class="course"><a id="zapis" href="order_form.php?course_title='.$title.'">Записаться</a></p>
                                </section>
                                ';
                            }
                        }
                    }
                    $db1->close();
                }
                $db->close();
            ?>
        </section>
    </body>
</html>