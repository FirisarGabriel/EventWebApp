<?php 
include ("../Proiect_conectare.php");

$error = '';
if (!empty($_POST['id_eveniment'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id_eveniment'])) {
            $id_eveniment = htmlentities($_POST['id_eveniment'], ENT_QUOTES);
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
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE evenimente SET nume=?, descriere=?, poster=?, data=?, ora=?, loc=?, organizator=?, tip_eveniment=?, durata=?, pret=? WHERE id_eveniment=?")) {
                    $stmt->bind_param("sssssssssii", $nume, $descriere, $poster, $data, $ora, $loc, $organizator, $tip_eveniment, $durata, $pret, $id_eveniment);
                    $stmt->execute();
                    $stmt->close();
                }
                else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        }
        else {
            echo "id incorect!";
        }
    }
} ?>
<html>

<head>
    <title> <?php if ($_GET['id_eveniment'] != '') {
        echo "Modificare inregistrare";
    } ?> </title>
        <link href="../Proiect.css" type="text/css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
    <div style="padding:30px;">
    <h1><?php if ($_GET['id_eveniment'] != '') {
        echo "Modificare Inregistrare";
    } ?></h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <?php if ($_GET['id_eveniment'] != '') { ?>
                <input type="hidden" name="id_eveniment" value="<?php echo $_GET['id_eveniment']; ?>" />
                <p>ID:
                    <?php echo $_GET['id_eveniment'];
                    if ($result = $mysqli->query("SELECT * FROM evenimente where id_eveniment='" . $_GET['id_eveniment'] . "'")) {
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_object();

                            ?>

                        </p>

                        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->nume;
                        ?>" /><br />
                        <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->descriere;
                        ?>" /><br />
                         <strong>Poster: </strong> <input type="text" name="poster" value="<?php echo $row->poster;
                        ?>" /><br />
                        <strong>Data: </strong> <input type="text" name="data" value="<?php echo $row->data;
                        ?>" /><br />
                        <strong>Ora: </strong> <input type="text" name="ora" value="<?php echo $row->ora;
                        ?>" /><br />
                        <strong>Loc: </strong> <input type="text" name="loc" value="<?php echo $row->loc;
                        ?>" /><br />
                        <strong>Organizator: </strong> <input type="text" name="organizator" value="<?php echo $row->organizator;
                        ?>" /><br />
                        <strong>Tip Eveniment: </strong> <input type="text" name="tip_eveniment" value="<?php echo $row->tip_eveniment;
                        ?>" /><br />
                        <strong>Durata: </strong> <input type="text" name="durata" value="<?php echo $row->durata;
                        ?>" /><br />
                        <strong>Pret: </strong> <input type="text" name="pret" value="<?php echo $row->pret;
                        }
                    }
            }
            ?>" /><br />
            <br />

            <input type="submit" name="submit" value="Submit" />
            <a href="../Proiect_evenimente_admin.php">Index</a>
        </div>
    </form>
    </div>
</body>

</html>