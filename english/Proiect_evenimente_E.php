<?php
require_once "../cart/shopping_cart.php"; 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Vizualizare Inregistrari</title>
  <link rel="stylesheet" href="../Proiect.css">
</head>
<body>
  <nav>
    <a href="Proiect_evenimente_E.php" onclick="showEvents()">Events available</a>
    <a href="Proiect_agenda_E.php">Agenda</a>
    <a href="Proiect_speaker_E.php">Speakers</a>
    <a href="Proiect_sponsori_E.php">Partners & Sponsors</a>
    <a href="Proiect_contact_E.php">Contact</a>
    <form method="post" action="Proiect_search.php" onsubmit="searchEvents();link='Proiect_search.php'">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit"><img src="../resurse/magnifying-glass.png" style="width: 20px;"></button>
    </form>
    <a href="../navbar/Proiect_evenimente.php"><img src="../resurse/romania.png" alt="RO" style="width: 20px;"></a>
    <a href="Proiect_evenimente_E.php"><img src="../resurse/united-kingdom.png" alt="ENG" style="width: 20px;"></a>
    <a href="../cart/cos.php"><img src="../resurse/trolley.png" alt="COS" style="width: 20px;"></a>
    <a href="../login/Proiect_logout.php">Logout</a>
  </nav>

  <div id="events" class="event-container">
    <?php
      include("../Proiect_conectare.php");
      
      if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY id_eveniment ")) {

          if ($result->num_rows > 0) {

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
          } else {
              echo "Nu sunt inregistrari in tabela!";
          }
      } else {
          echo "Error: " . $mysqli->error;
      }
      
      $mysqli->close();
      
    ?>
  </div>

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

