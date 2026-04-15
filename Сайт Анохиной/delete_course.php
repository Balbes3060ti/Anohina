<?
    if (isset($_GET["title"]))
    {
        $db = new mysqli("MySQL-8.0", "root", "", "site_db");
        $query = "DELETE FROM courses WHERE title='".$_GET["title"]."'";
        $result = $db->query($query);
        if (isset($result))
        {
            header("Location: manager_panel.php");
        }
    }
?>