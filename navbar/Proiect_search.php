<?php

include("../Proiect_conectare.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../Proiect.css">
    
</head>
<body>
    
<nav>
    <a href="Proiect_evenimente.php" onclick="showEvents()">Evenimente disponibile</a>
    <a id="ag" href="Proiect_agenda.php">Agenda</a>
    <a href="Proiect_speaker.php">Vorbitori</a>
    <a href="Proiect_sponsori.php">Parteneri & Sponsori</a>
    <a href="Proiect_contact">Contact</a>
    <a href="Proiect_bilete.php">Bilete</a>
    <form method="post" action="Proiect_search.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit"><img src="../resurse/magnifying-glass.png" style="width: 20px;"></button>
    </form>
    <a href="Proiect_evenimente.php"><img src="../resurse/romania.png" alt="RO" style="width: 20px;"></a>
    <a href="../english/Proiect_evenimente_E.php"><img src="../resurse/united-kingdom.png" alt="ENG" style="width: 20px;"></a>
    <a href="../cart/cos.php"><img src="../resurse/trolley.png" alt="COS" style="width: 20px;"></a>
    <a href="../login/Proiect_logout.php">Logout</a>
  </nav>

  <?php

    if (isset($_POST["submit"])) {
        $searchTerm = $_POST["search"];
        $searchTerm = htmlspecialchars($searchTerm); // You can still sanitize HTML input if required.

        // Use a prepared statement to safely query the database
        $stmt = $mysqli->prepare("SELECT * FROM evenimente WHERE nume LIKE ? OR descriere LIKE ?");
        $searchTerm = '%' . $searchTerm . '%'; // Add wildcards for the LIKE operator
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
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
                echo "Nu s-au găsit evenimente pentru termenul căutat.";
            }
        } else {
            echo "Eroare în interogare: " . $mysqli->error;
        }
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

  <script src="../Proiect.js"></script>

</body>
</html>
