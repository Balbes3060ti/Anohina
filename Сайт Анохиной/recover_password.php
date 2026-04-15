<?
    session_start();
    if (isset($_POST["phone"]) and isset($_POST["login"])) {
        $phone = $_POST["phone"];
        $_SESSION["login"] = $_POST["login"];
        $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $query = 'SELECT phone FROM users WHERE phone="'.$phone.'" and login="'.$_SESSION["login"].'"';
        $result = $db->query($query);
        if (isset($result)) {
            header("Location: new_password.php");
        } else {
            $error = "Неверный логин или телефон";
        }
    }
?>

<form action="recover_password.php" method="post">
    <p>Логин<br>
    <input type="text" size=25 maxlength=50 name=login></p>
    <p>Телефон<br>
    <input type="phone" size=25 maxlength=50 name=phone></p>
    <p><input type="submit" value="Подтвердить"></p>
</form>

<?
    if (isset($error)) {
        echo $error;
    }
?>