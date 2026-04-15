<?
    if (isset($_POST["new_state"]) and isset($_POST["id"])) {
        $new_state = $_POST["new_state"];
        $id = $_POST["id"];
        $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
        $query = "UPDATE reverse_rings SET `state`='".$new_state."' WHERE id='".$id."'";
        $result = $db->query($query);
        if (isset($result)) {
            header("Location: manager_panel.php");
        }
    }
?>

<form action="change_state.php" method="post">
    <p>Выберите новый статус</p>
    <p><input type="radio" name="new_state" value="Не прочитано">Не прочитано<br>
    <input type="radio" name="new_state" value="Прочитано">Прочитано<br>
    <input type="radio" name="new_state" value="Отвечено">Отвечено</p>
    <input type="hidden" name="id" value="<? echo $_GET["id"];?>">
    <input type="submit">
</form>