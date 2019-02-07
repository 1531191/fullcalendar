<?php

if (isset($_POST['id'])) {
    $connect = new PDO('mysql:host=localhost;dbname=fullcalendar', 'root', '');

    $query = "DELETE FROM events WHERE id=:id";

    $statement = $connect->prepare($query);
    $statement->execute(
            array(
                ':id' => $_POST['id']
            )
    );
}

?>


