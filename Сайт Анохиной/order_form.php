<?
    session_start();
    require_once("functions.php");
    $login = check_user();
    if (isset($_GET["course_title"]))
    {
        $_SESSION["course_title"] = $_GET["course_title"];
        echo "Запись на ".$_SESSION["course_title"];
    }
    if (isset($_POST["course_title"]) and isset($_POST["fio"]))
    {
        $course_title = $_POST["course_title"];
        $fio = $_POST["fio"];
        $db1 = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $db2 = new mysqli("MySQL-8.0", "root", "", "site_db");
        $query1 = "SELECT phone FROM users WHERE `login`='".$login."'";
        $result1 = $db1->query($query1);
        $row1 = $result1->fetch_row();
        $phone = $row1[0];
        $query2 = "INSERT INTO orders VALUES (null, '$login', '$course_title', '$fio', '$phone')";
        $result2 = $db1->query($query2);
        $query3 = "SELECT places_zanato FROM courses WHERE title='".$course_title."'";
        $result3 = $db2->query($query3);
        $row2 = $result3->fetch_row();
        $budet_zanato = $row2[0] + 1;
        $query4 = "UPDATE courses SET places_zanato='".$budet_zanato."' WHERE title='".$course_title."'";
        $result4 = $db2->query($query4);
        if (isset($result2) and isset($result4))
        {
            header("Location: Courses.php");
        }
        $db1->close();
        $db2->close();
    }
?>

<form action="order_form.php" method="post">
    <p>Введите ваше ФИО<br>
    <input type="text" name="fio" required></p>
    <input type="hidden" name="course_title" value="<?echo $_SESSION["course_title"]?>">
    <input type="submit">
</form>