<?
    $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
    $username = htmlentities($_GET["username"]);
    
    $result = $db->query("SELECT * FROM users WHERE `login`='".$username."'");
    $row = $result->fetch_row();
    if ($result and $result->num_rows > 0)
    {
        echo json_encode(["exists"=>true]);
    }
    else
    {
        echo json_encode(["exists"=>false]);
    }
?>