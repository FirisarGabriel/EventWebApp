
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Proiect.css">
    <script src="../Proiect.js"></script>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <nav>
        <a href="Proiect_evenimente.php"> Evenimente disponibile </a>
        <a href="Proiect_agenda.php">Agenda</a>
        <a href="Proiect_speaker.php">Speakers</a>
        <a href="Proiect_sponsori.php">Parteneri & Sponsori</a>
        <a href="Proiect_contact.php">Contact</a>
        <a href="Proiect_bilete.php">Bilete</a>
        <a href="Proiect_evenimente.php"><img src="../resurse/romania.png" alt="RO" style="width: 20px;"></a>
        <a href="../english/Proiect_speaker_E.php"><img src="../resurse/united-kingdom.png" alt="ENG" style="width: 20px;"></a>
        <a href="../cart/cos.php"><img src="../resurse/trolley.png" alt="COS" style="width: 20px;"></a>
        <a href="../login/Proiect_logout.php">Logout</a>
    </nav>
</head>
<body>
    
</body>
</html>

<?php

include("../Proiect_conectare.php");

if (isset($_GET['id_speaker'])) {
    $id_speaker = (int) $_GET['id_speaker'];
    $query = "
        SELECT e.nume, e.descriere, e.poster, e.data, e.ora, e.pret, e.loc, e.id_eveniment 
        FROM evenimente e 
        JOIN eventspeaker es 
        ON es.id_eveniment = e.id_eveniment 
        WHERE es.id_speaker = $id_speaker
    ";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        echo '<div id="events" >';
        echo '<div class="event-container">';
        while ($row = $result->fetch_object()) {
            echo '<div class="event-box" 
                onclick="showEventDetails(
                    \'' . $row->nume . '\', 
                    \'' . $row->descriere . '\', 
                    \'' . $row->data . ' ' . $row->ora . '\', 
                    \'' . $row->loc . '\',
                    \'' . $row->pret . '\',  
                    \'' . $row->id_eveniment . '\')">';
            echo '<div class="container" ><h3>' . $row->nume . '</h3></div>';
            echo '<img src="../resurse/'. $row->poster .'" alt="Afis eveniment" style="width:100%">';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo "Nu există evenimente pentru acest speaker.";
    }
} else {
    echo "ID-ul speakerului nu a fost furnizat.";
}
?>

<div id="eventDetails" class="event-details">
    <h2 id="eventTitle"></h2>
    <p id="eventDescription"></p>
    <p id="eventDateTime"></p>
    <p id="eventLoc"></p>
    <p id="eventPrice"></p>
    
    <div class="product-item">
    <form id="addToCartForm" method="post" action="">
        <div>
            <input type="text" name="quantity" value="1" size="2" />
            <input type="submit" value="Add to cart" class="btnAddAction" />
        </div>
    </form>
    </div>
             
</div>

<?php $mysqli->close(); ?>

