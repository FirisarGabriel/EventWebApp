
<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'evenimente';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    exit('Nu se poate conecta la MySQL:' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    exit('Completare formular registration!');
}

if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
    exit('Completare registration form');
}

$email = trim($_POST['email']);
$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if(!preg_match($pattern, $email)){
    exit('email invalid');
}
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    exit('Username nu este valid!');
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    exit('Password trebuie sa fie intre 5 si 20 charactere!');
}
if ($stmt = $con->prepare('SELECT id, password FROM utilizatori WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'Username exists, alegeti altul!';
    } else {
        if ($stmt = $con->prepare('INSERT INTO utilizatori (username, password, email) VALUES (?, ?, ?)')) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
            echo 'Success inregistrat!';
            header('Location: Proiect_index.html');
        } else {
            echo 'Nu se poate face prepare statement!';
        }
    
        $stmt->close();
    }
} else {
    echo 'Nu se poate face prepare statement!';
}

$con->close();
?>
