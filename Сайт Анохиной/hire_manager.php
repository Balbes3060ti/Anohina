<?
    if (isset($_POST["manager_login"])){
        $manager_login = $_POST["manager_login"];
        $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $query1 = 'UPDATE users SET `role`="Менеджер" WHERE `login`="'.$manager_login.'"';
        $query2 = 'SELECT `login` FROM users WHERE `login`="'.$manager_login.'"';
        $result1 = $db->query($query1);
        $result2 = $db->query($query2);
        if (isset($result2) and $result2->num_rows > 0) {
            header("Location: Home.php");
        } else {
            $wrong_login = "Такого логина не существует";
        }
    }
?>

<form action="hire_manager.php" method="post">
    <p>Логин<br>
    <input type="text" size=25 maxlength=50 name=manager_login></p>
    <p><input type="submit" value="Подтвердить"></p>
</form>

<?
    if (isset($wrong_login)) {echo $wrong_login;}
?>