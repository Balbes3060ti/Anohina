<html> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Панель менеджера</title>
        <link rel="stylesheet" href="manager_panel.css">
    </head>
    <body>
        <?
            $db = new mysqli("MySQL-8.0", "root", "", "lab1_n1_db");
            $db1 = new mysqli("MySQL-8.0", "root", "", "site_db");

            $query = "SELECT id, `login`, phone, `message`, `state` FROM reverse_rings";
            $result = $db->query($query);

            if (isset($result) and $result->num_rows > 0)
            {
                $rows = $result->num_rows;

                echo "
                <h2>Обратные звонки</h2>
                <table>
                    <tr>
                        <th>Логин</th>
                        <th>Телефон</th>
                        <th>Сообщение</th>
                        <th>Статус</th>
                    </tr>";

                for ($i = 0; $i < $rows; $i++)
                {
                    $row = $result->fetch_row();

                    echo "<tr>";

                    for ($j = 1; $j < count($row); $j++)
                    {
                        echo "<td>$row[$j]</td>";
                    }
                     
                    echo "<td><a href='change_state.php?id=$row[0]'>Изменить статус</a></td>";
                    echo "</tr>";
                }
            echo "</table>";
            }

            $query = "SELECT img, title, describtion, max_places, places_zanato FROM courses";
            $result = $db1->query($query);

            if (isset($result) and $result->num_rows > 0)
            {
                $rows = $result->num_rows;

                echo "
                <br><h2>Список кружков</h2>
                <table>
                    <tr>
                        <th>Изображение</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Максимум мест</th>
                        <th>Занято мест</th>
                    </tr>";

                for ($i = 0; $i < $rows; $i++)
                {
                    $row = $result->fetch_row();

                    echo "<tr>";

                    for ($j = 0; $j < count($row); $j++)
                    {
                        echo "<td>$row[$j]</td>";
                    }
                    echo "<td><a href='change_course.php?title=".$row[1]."'>Обновить</a></td>"; 
                    echo "<td><a href='delete_course.php?title=".$row[1]."'>Удалить</a></td>"; 
                    echo "</tr>";
                }
            echo "</table>";
            }
            echo "<div id='add_course'><a href='add_course.php'>Добавить кружок</a></div>";

            $query = "SELECT `login`, an_order, `name`, phone FROM orders";
            $result = $db->query($query);

            if (isset($result) and $result->num_rows > 0)
            {
                $rows = $result->num_rows;

                echo "
                <br><h2>Записи на кружки</h2>
                <table>
                    <tr>
                        <th>Логин</th>
                        <th>Кружок</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                    </tr>";

                for ($i = 0; $i < $rows; $i++)
                {
                    $row = $result->fetch_row();

                    echo "<tr>";

                    for ($j = 0; $j < count($row); $j++)
                    {
                        echo "<td>$row[$j]</td>";
                    }

                    $title = $row[1];
                    $page = "manager_panel.php";
                    
                    echo '<td><a href="delete_order.php?course_title='.$title.'&page='.$page.'">Отклонить запись</a></td>';
                    echo "</tr>";
                }
            echo "</table>";
            }
            $db->close();
        ?>
    </body>
</html>