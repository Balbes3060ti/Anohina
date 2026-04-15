<?
    session_start();

    if (isset($_SESSION["login"]) and isset($_POST["message"])) {
        $login = $_SESSION["login"];
        $phone = $_SESSION["phone"];
        $message = $_POST["message"];
        $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $query = "INSERT INTO reverse_rings VALUES (null, '$login', '$message', 'Не прочитано', '$phone')";
        $result = $db->query($query);
        if (isset($result)) {
            header("Location: Main.php");
        }
    }

?>

<form action="reverse_ring.php" method="post">
    <p>Сообщение администратору</p>
    <p><textarea name=message maxlength="500" style="height:20%; width:20%; max-height:50%; max-width:60%"></textarea></p>
    <p><input type="submit" value="Отправить"></p>
</form>