<?
    session_start();
    require_once("functions.php");
    $login = check_user();
    if (isset($_GET["course_title"]) and isset($_GET["page"]))
    {
        $course_title = $_GET["course_title"];
        $db1 = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $db2 = new mysqli("MySQL-8.0", "root", "", "site_db");
        $query1 = "DELETE FROM orders WHERE `login`='".$login."' AND an_order='".$course_title."'";
        $result1 = $db1->query($query1);
        $query2 = "SELECT places_zanato FROM courses WHERE title='".$course_title."'";
        $result2 = $db2->query($query2);
        $row2 = $result2->fetch_row();
        $budet_zanato = $row2[0] - 1;
        $query3 = "UPDATE courses SET places_zanato='".$budet_zanato."' WHERE title='".$course_title."'";
        $result3 = $db2->query($query3);
        $page = $_GET["page"];
        header("Location: ".$page);
    }
?>