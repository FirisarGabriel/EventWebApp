
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <link rel="stylesheet" href="../Proiect.css">
    <script src="Proiect.js"></script>
<title>Vizualizare Inregistrari</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<nav>
    <a href="Proiect_evenimente_E.php" onclick="showEvents()">Events available</a>
    <a href="Proiect_agenda_E.php">Agenda</a>
    <a href="Proiect_speaker_E.php">Speakers</a>
    <a href="Proiect_sponsori_E.php">Partners & Sponsors</a>
    <a href="Proiect_contact_E.php">Contact</a>
    <a href="../navbar/Proiect_agenda.php"><img src="../resurse/romania.png" alt="RO" style="width: 20px;"></a>
    <a href="Proiect_agenda_E.php"><img src="../resurse/united-kingdom.png" alt="ENG" style="width: 20px;"></a>
    <a href="../cart/Cos.php"><img src="../resurse/trolley.png" alt="COS" style="width: 20px;"></a>
    <a href="../login/Proiect_logout.php">Logout</a>
</nav>


<?php

include("../Proiect_conectare.php");

if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY ora, data")) {

    if ($result->num_rows > 0) {

        $agenda = array();

        while ($row = $result->fetch_object()) {

            $ora = date("H:i", strtotime($row->ora));
            $agenda[$ora][] = array(
                'nume' => $row->nume,
                'descriere' => $row->descriere,
                'loc' => $row->loc,

            );
        }

        foreach ($agenda as $ora => $evenimente) {
            echo "<h2>Time $ora</h2>";
            echo "<ul>";
            foreach ($evenimente as $eveniment) {
                echo "<li>";
                echo "<strong>Name:</strong> {$eveniment['nume']}, ";
                echo "<strong>Description:</strong> {$eveniment['descriere']}, ";
                echo "<strong>Loc:</strong> {$eveniment['loc']}";
                echo "</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "Nu sunt inregistrari in tabela!";
    }
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
?>
</body>
</html>