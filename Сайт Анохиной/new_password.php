<?
    session_start();
    if (isset($_POST["new_password"]) and isset($_SESSION["login"])) {
        $new_password = $_POST["new_password"];
        $login = $_SESSION["login"];
        $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $query = 'UPDATE users SET `password`="'.$new_password.'" WHERE login="'.$login.'"';
        $result = $db->query($query);
        if (isset($result)) {
            header("Location: logform.php");
        } else {
            echo "bad sql";
        }
        echo "diodrjognjf";
    }
?>

<form action="new_password.php" method="post">
    <p>Новый пароль<br>
    <input type="password" size=25 maxlength=50 name=new_password></p>
    <p><input type="submit" value="Подтвердить"></p>
</form>