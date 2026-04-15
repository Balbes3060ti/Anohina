<?
    session_start();
    if (isset($_GET["title"]))
    {
        $_SESSION["title"] = $_GET["title"];
        $db1 = new mysqli("MySQL-8.0", "root", "", "site_db");
        $query = "SELECT img, title, describtion, max_places FROM courses WHERE title='".$_SESSION["title"]."'";
        $result = $db1->query($query);
        if (isset($result))
        {
            $row = $result->fetch_row();
            $img = $row[0];
            $describtion = $row[2];
            $max_places = $row[3];
        }
    }
    if (isset($_POST["img"]) and isset($_POST["title"]) and isset($_POST["describtion"]) and isset($_POST["max_places"])) {
        $new_img = $_POST["img"];
        $new_title = $_POST["title"];
        $new_describtion = $_POST["describtion"];
        $new_places = $_POST["max_places"];
        $db = new mysqli("MySQL-8.0", "root", "", "site_db");
        $query = "UPDATE courses SET img='".$new_img."', title='".$new_title."', describtion='".$new_describtion."', max_places='".$new_places."' WHERE title='".$_SESSION["title"]."'";
        $result = $db->query($query);
        if (isset($result)) {
            header("Location: manager_panel.php");
        }
    }
?>

<form action="change_course.php" method="post">
    <h2>Изменить курс</h2>
    <p>Изображение<br>
    <input type="text" name="img" value="<?echo $img?>"></p>
    <p>Название<br>
    <input type="text" name="title" value="<?echo $_SESSION["title"]?>"></p>
    <p>Описание<br>
    <input type="text" name="describtion" value="<?echo $describtion?>"></p>
    <p>Максимум мест<br>
    <input type="text" name="max_places" value="<?echo $max_places?>"></p>
    <input type="submit">
</form>