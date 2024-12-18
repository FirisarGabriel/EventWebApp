
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <link href="Proiect.css" type="text/css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

    <style>
        div.admin-table{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100vw;
        }
    </style>
    <div id="admin-table" style="padding:20px;">
    <h1>Inregistrarile din tabela evenimente</h1>
    <p><b>Toate inregistrarile din evenimente</b></p>
    <a href="CRUD/Proiect_inserare.php">Adauga un nou eveniment</a>
    <a href="login/Proiect_logout.php">Logout</a>

    <?php

    include("Proiect_conectare.php");

    if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY id_eveniment")) {

        if ($result->num_rows > 0) {

            echo "<table border='2' cellpadding='8'>";

            echo "<tr><th>Id_eveniment</th><th>Numele evenimentului</th><th>Descriere</th><th>Poster</th><th>Data</th><th>Ora de inceput</th><th>Locatia</th><th>Organizator</th><th>Tipul evenimentului</th><th>Durata(in ore)</th><th>Speakers</th><th>Pret</th></th></tr>";

            while ($row = $result->fetch_object()) {

                echo "<tr>";
                echo "<td>" . $row->id_eveniment . "</td>";
                echo "<td>" . $row->nume . "</td>";
                echo "<td>" . $row->descriere . "</td>";
                echo "<td>" . $row->poster . "</td>";
                echo "<td>" . $row->data . "</td>";
                echo "<td>" . $row->ora . "</td>";
                echo "<td>" . $row->loc . "</td>";
                echo "<td>" . $row->organizator . "</td>";
                echo "<td>" . $row->tip_eveniment . "</td>";
                echo "<td>" . $row->durata . "</td>";
                
                echo "<td>";
                $eventID = $row->id_eveniment;
                $speakersQuery = "SELECT speakeri.nume FROM speakeri
                                  JOIN eventspeaker ON speakeri.id_speaker = eventspeaker.id_speaker
                                  WHERE eventspeaker.id_eveniment = $eventID";
                $speakersResult = $mysqli->query($speakersQuery);

                if ($speakersResult->num_rows > 0) {
                    while ($speakerRow = $speakersResult->fetch_object()) {
                        echo $speakerRow->nume . "<br>";
                    }
                } else {
                    echo "Eveniment fara vorbitori";
                }
                echo "<td>" . $row->pret . "</td>";
                echo "</td>";
                echo "<td><a href='CRUD/Proiect_modificare.php?id_eveniment=" . $row->id_eveniment . "'>Modifica evenimentul</a></td>";
                echo "<td><a href='CRUD/Proiect_stergere.php?id_eveniment=" .$row->id_eveniment . "'>Stergere evenimentul</a></td>"; 

                echo "</tr>";
                
            }
            echo "</table>";
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

