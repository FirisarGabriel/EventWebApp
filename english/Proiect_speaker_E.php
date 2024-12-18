<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speakers</title>
    <style>
        .divSpeaker {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin-left: 150px;
            margin-right: 150px;
        }
        .speaker-container {
            margin: 20px;
            text-align: center;
        }
    </style>

    <link rel="stylesheet" href="../Proiect.css">
    <script src="../Proiect.js"></script>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <nav>
        <a href="Proiect_evenimente_E.php" onclick="showEvents()">Events available</a>
        <a href="Proiect_agenda_E.php">Agenda</a>
        <a href="Proiect_speaker_E.php">Speakers</a>
        <a href="Proiect_sponsori_E.php">Partners & Sponsors</a>
        <a href="Proiect_contact_E.php">Contact</a>
        <a href="../navbar/Proiect_speaker.php"><img src="../resurse/romania.png" alt="RO" style="width: 20px;"></a>
        <a href="Proiect_speaker_E.php"><img src="../resurse/united-kingdom.png" alt="ENG" style="width: 20px;"></a>
        <a href="../cart/Cos.php"><img src="../resurse/trolley.png" alt="COS" style="width: 20px;"></a>
        <a href="../login/Proiect_logout.php">Logout</a>
    </nav>
</head>

<body>
    <div class="divSpeaker">
        <?php
        include("../Proiect_conectare.php");

        $result = $mysqli->query("SELECT id_speaker, nume, descriere FROM speakeri");

        while ($row = $result->fetch_object()) {
            echo '<div class="speaker-container" onclick="window.location.href=\'../navbar/Proiect_speaker_detalii.php?id_speaker=' . $row->id_speaker . '\'">';
            echo '<h2>' . $row->nume . '</h2>';
            echo '<p>' . $row->descriere . '</p>';
            echo '</div>';
        }

        $conn = null;
        ?>
    </div>


</body>

</html>