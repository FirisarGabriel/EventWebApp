<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'evenimente';
$con = mysqli_connect(
    $DATABASE_HOST,
    $DATABASE_USER,
    $DATABASE_PASS,
    $DATABASE_NAME
);
if (mysqli_connect_errno()) {
    exit('Esec conectare MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'])) {
    exit('Completati username si password !');
}
if ($stmt = $con->prepare('SELECT id, password, is_admin FROM utilizatori WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    echo "3";
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $password, $is_admin);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            if ($is_admin) {
                echo 'Bine ati venit' . $_SESSION['name'] . '!';
                header('Location: ../Proiect_evenimente_admin.php');
            } else {
                header('Location: ../navbar/Proiect_evenimente.php');
            }
        } else {
            echo 'Incorrect  password!';
        }
    } else {
        echo 'Incorrect username ';
    }
    $stmt->close();
}
?>