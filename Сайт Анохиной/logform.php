<?
    session_start();

    if (isset($_SESSION["youre_admin"])) {echo $_SESSION["youre_admin"];}
?>
<?
    session_start();
    require_once("functions.php");
    if (isset($_POST["login"]) and isset($_POST["password"]) and $_SESSION["is_log_error"] == 0) {
        $login = $_POST["login"];
        $password = $_POST["password"];
        $error = 0;
        $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $query = 'SELECT `login`, `password` FROM users WHERE `login`="'.$login.'"';
        $result = $db->query($query);
        if (isset($result) and $result->num_rows > 0) {
            $data = $result->fetch_row();
            if ($data[1] == $password) {
                $_SESSION['my_inside'] = 1;
                $_SESSION['current_user'] = $login;
            } else {
                $error = 1;
            }
        } else {
            $error = 1;
        }
        $db->close();
        if ($error == 0) {
            $_SESSION["is_log_error"] = 1;
            header("Location: Main.php");
        } else {
            header("Location: logform.php");
        }
    }
    $_SESSION["is_log_error"] = 1;
?>

<form id="fm" action="logform.php" method="post">
    <p>Логин<br>
    <input type="text" size=25 maxlength=50 name=login id="login" required></p>
    <p>Пароль<br>
    <input type="password" size=25 maxlength=50 name=password id="password" required></p>
    <input type="submit" value="Войти в аккаунт">
    <p><a href="register.php">Регистрация</a></p>
    <p><a href="recover_password.php">Восстановить пароль</a></p>
</form>

<script>
    document.getElementById("fm").addEventListener("submit", function(event)
    {
        let username = document.getElementById("login").value;
        let password = document.getElementById("password").value;
        fetch("ch_password.php?username=" + username + "&password=" + password)
        .then(response => response.json())
        .then(data =>
        {
            if (data.exists == false)
            {
                alert("Неверный логин или пароль");
                event.preventDefault();
                return;
            } else {
                <?$_SESSION["is_log_error"] = 0;?>
            }
        });
    });
</script>