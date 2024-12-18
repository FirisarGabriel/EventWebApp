<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../Proiect.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <h1>Inregistrarile din tabela datepers</h1>
    <p><b>Toate inregistrarile din datepers</b</p>
            <?php

            include ("../Proiect_conectare.php");

            if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY id_eveniment ")) { 
                if ($result->num_rows > 0) {

                    echo "<table border='1' cellpadding='10'>";

                    echo "<tr><th>id_eveniment</th><th>nume</th><th>descriere</th><th>data</th><th>ora</th><th>loc</th><th>pret</th><th>organizator</th><th>imagine</th><th>tip_eveniment</th><th>durata</th><th>locuri_disponibile</th><th>locuri_rezervate</th><th>id_categorie</th></tr>";

                    while ($row = $result->fetch_object()) {

                        echo "<tr>";
                        echo "<td>" . $row->id_eveniment . "</td>";
                        echo "<td>" . $row->nume . "</td>";
                        echo "<td>" . $row->descriere . "</td>";
                        echo "<td>" . $row->poster . "</td>";
                        echo "<td>" . $row->data . "</td>";
                        echo "<td>" . $row->ora . "</td>";
                        echo "<td>" . $row->loc . "</td>";
                        echo "<td>" . $row->pret . "</td>";
                        echo "<td>" . $row->organizator . "</td>";
                        echo "<td>" . $row->imagine . "</td>";
                        echo "<td>" . $row->tip_eveniment . "</td>";
                        echo "<td>" . $row->durata . "</td>";
                        echo "<td>" . $row->locuri_disponibile . "</td>";
                        echo "<td>" . $row->locuri_rezervate . "</td>";
                        echo "<td>" . $row->id_categorie . "</td>";
                        echo "<td><a href='Proiect_modificare.php?id_eveniment=" . $row->id_eveniment . "'>Modifica evenimentul</a></td>";
                        echo "<td><a href='Proiect_stergere.php?id_eveniment=" . $row->id_eveniment . "'>Stergere evenimentul</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }

                else {
                    echo "Nu sunt inregistrari in tabela!";
                }
            }

            else {
                echo "Error: " . $mysqli->error;
            }

            $mysqli->close();
            ?>
            <a href="Proiect_inserare.php">Adauga un nou eveniment</a>
</body>

</html>