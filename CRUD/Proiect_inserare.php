<?php
include ("../Proiect_conectare.php");
$error = '';
if (isset($_POST['submit'])) {

    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $poster = htmlentities($_POST['poster'], ENT_QUOTES);
    $data = htmlentities($_POST['data'], ENT_QUOTES);
    $ora = htmlentities($_POST['ora'], ENT_QUOTES);
    $loc = htmlentities($_POST['loc'], ENT_QUOTES);
    $organizator = htmlentities($_POST['organizator'], ENT_QUOTES);
    $tip_eveniment = htmlentities($_POST['tip_eveniment'], ENT_QUOTES);
    $durata = htmlentities($_POST['durata'], ENT_QUOTES);
    $pret = htmlentities($_POST['pret'], ENT_QUOTES);

    if ($nume == '' || $descriere == '' || $poster == '' || $data == '' || $ora == '' || $loc == '' || $organizator == '' || $tip_eveniment == '' || $durata == '' || $pret == '') {

        $error = 'ERROR: Campuri goale!';
    } else {
   
        if ($stmt = $mysqli->prepare("INSERT into evenimente ( nume, descriere, poster, data, ora, loc,organizator,tip_eveniment, durata, pret) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("ssssssssii", $nume, $descriere, $poster, $data, $ora, $loc, $organizator, $tip_eveniment, $durata, $pret);
            $stmt->execute();
            $stmt->close();

            $result = $mysqli->query("SELECT email FROM utilizatori");
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $to = $row['email'];
                    $subject = 'Buna ziua, eveniment nou!';
                    $message = 'Salut, a fost adaugat un eveniment nou!';


                    $headers = 'From: tech@pulse.com' . "\r\n" .
                        'Reply-To: your-email@example.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    mail($to, $subject, $message, $headers);
                }
            } else {
                echo "Error fetching email addresses: " . $mysqli->error;
            }
        } else {

            echo "ERROR: Nu se poate executa insert.";
        }
    }
}

$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title><?php echo "Inserare inregistrare"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../Proiect.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div style="padding:30px;">
    <h1><?php echo "Inserare inregistrare"; ?></h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <strong>Nume: </strong> <input type="text" name="nume" value="" /><br />
            <strong>Descriere: </strong> <input type="text" name="descriere" value="" /><br />
            <strong>Poster: </strong> <input type="text" name="poster" value="" /><br />
            <strong>Data: </strong> <input type="text" name="data" value="" /><br />
            <strong>Ora: </strong> <input type="text" name="ora" value="" /><br />
            <strong>Loc: </strong> <input type="text" name="loc" value="" /><br />
            <strong>Organizator: </strong> <input type="text" name="organizator" value="" /><br />
            <strong>Tip Eveniment: </strong> <input type="text" name="tip_eveniment" value="" /><br />
            <strong>Durata: </strong> <input type="text" name="durata" value="" /><br />
            <strong>Pret: </strong> <input type="text" name="pret" value="" /><br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="../Proiect_evenimente_admin.php">Index</a>
        </div>
    </form>
    </div>
</body>

</html>