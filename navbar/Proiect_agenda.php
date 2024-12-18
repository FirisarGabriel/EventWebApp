<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <link rel="stylesheet" href="../Proiect.css">
    <script src="../Proiect.js"></script>
<title>Vizualizare Inregistrari</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<nav>
    <a href="Proiect_evenimente.php" onclick="showEvents()">Evenimente disponibile</a>
    <a href="Proiect_agenda.php">Agenda</a>
    <a href="Proiect_speaker.php">Vorbitori</a>
    <a href="Proiect_sponsori.php">Parteneri & Sponsori</a>
    <a href="Proiect_contact">Contact</a>
    <a href="Proiect_evenimente.php"><img src="../resurse/romania.png" alt="RO" style="width: 20px;"></a>
    <a href="../english/Proiect_agenda_E.php"><img src="../resurse/united-kingdom.png" alt="ENG" style="width: 20px;"></a>
    <a href="../cart/cos.php"><img src="../resurse/trolley.png" alt="COS" style="width: 20px;"></a>
    <a href="../login/Proiect_logout.php">Logout</a>
  </nav>

<div style="padding:30px">
<?php

include("../Proiect_conectare.php");

if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY data, ora")) {
    if ($result->num_rows > 0) {
        $agenda = array();
        while ($row = $result->fetch_object()) {
            $data = date("d.m.Y", strtotime($row->data));
            $ora = date("H:i", strtotime($row->ora));
            $agenda[$data][] = array(
                'nume' => $row->nume,
                'descriere' => $row->descriere,
                'loc' => $row->loc,
                'ora'=> $row->ora
            );
        }
        foreach ($agenda as $data => $evenimente) {
            echo "<h2>Data $data</h2>";
            echo "<ul>";
            foreach ($evenimente as $eveniment) {
                echo "<li>";
                echo "<strong>Nume:</strong> {$eveniment['nume']}, ";
                echo "<strong>Descriere:</strong> {$eveniment['descriere']}, ";
                echo "<strong>Loc:</strong> {$eveniment['loc']}, ";
                echo "<strong>Ora:</strong> {$eveniment['ora']}";
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
</div>
</body>
</html>
