<?
    require_once("functions.php");
    if (isset($_POST["login"]) and isset($_POST["password1"]) and isset($_POST["password2"]) and isset($_POST["phone"]) and isset($_POST["city"]) and $_SESSION["is_reg_error"] == false)
    {
        $login = htmlentities($_POST["login"]);
        $password1 = htmlentities($_POST["password1"]);
        $password2 = htmlentities($_POST["password2"]);
        $phone = htmlentities($_POST["phone"]);
        $city = htmlentities($_POST["city"]);
        $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $query = 'INSERT INTO users (`login`, `password`, phone, city) VALUES ("'.$login.'", "'.$password1.'", "'.$phone.'", "'.$city.'")';
        $result = $db->query($query);
        if (!$result)
        {
            echo "Bad sql";
        }
        else
        {
            header("Location: logform.php");
        }
        $db->close();
    }
    $_SESSION["is_reg_error"] = true;
?>
<form id="fm" action="register.php" method="post">
    <p>Новый логин:<br>
    <input type="text" size=25 maxlength=50 name=login id=login required></p>
    <p>Новый пароль:<br>
    <input type="password" size=25 maxlength=50 name=password1 id=password1 required></p>
    <p>Новый пароль ещё раз:<br>
    <input type="password" size=25 maxlength=50 name=password2 id=password2 required></p>
    <p>Телефон:<br>
    <input type="phone" size=25 maxlength=50 name=phone id=phone required></p>
    <p>Город:<br>
    <input type="text" size=25 maxlength=50 name=city id=city required></p>
    <input id=submit type="submit" value="Зарегестрироваться">
</form>
<script>
    document.getElementById("fm").addEventListener("submit", function(event)
    {
        if (document.getElementById("password1").value != document.getElementById("password2").value)
        {
            alert("Пароли не совпадают");
            event.preventDefault();
        } 
        let username = document.getElementById("login").value;
        fetch("ch_user.php?username=" + username)
        .then(response => response.json())
        .then(data =>
        {
            if (data.exists)
            {
                alert("Такой логин уже есть");
                event.preventDefault();
            } else {
                <?$_SESSION["is_reg_error"] = false;?>
            }
        });
    });
</script>
