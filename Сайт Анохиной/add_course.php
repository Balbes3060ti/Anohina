<?
    if (isset($_POST["img"]) and isset($_POST["title"]) and isset($_POST["describtion"]) and isset($_POST["max_places"])) {
        $new_img = $_POST["img"];
        $new_title = $_POST["title"];
        $new_describtion = $_POST["describtion"];
        $max_places = $_POST["max_places"];
        $db = new mysqli("MySQL-8.0", "root", "", "site_db");
        $query = "INSERT INTO courses VALUES (null,'$new_img', '$new_title', '$new_describtion', '$max_places', '0')";
        $result = $db->query($query);
        if (isset($result)) {
            header("Location: manager_panel.php");
        }
    }
?>

<form action="add_course.php" method="post">
    <h2>Добавить курс</h2>
    <p>Изображение<br>
    <input type="text" name="img"></p>
    <p>Название<br>
    <input type="text" name="title"></p>
    <p>Описание<br>
    <input type="text" name="describtion"></p>
    <p>Максимум мест<br>
    <input type="text" name="max_places"></p>
    <input type="submit">
</form>