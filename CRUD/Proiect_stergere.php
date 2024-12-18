
<link href="../Proiect.css" type="text/css" rel="stylesheet" />
<div style="padding:30px;">
<?php
include ("../Proiect_conectare.php");
if (isset($_GET['id_eveniment']) && is_numeric($_GET['id_eveniment'])) {
    $id_eveniment = $_GET['id_eveniment'];
    if ($stmt = $mysqli->prepare("DELETE FROM evenimente WHERE id_eveniment =? LIMIT 1")) {
        $stmt->bind_param("i", $id_eveniment);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "ERROR: Nu se poate executa delete.";
    }
    $mysqli->close();
    echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"../Proiect_evenimente_admin.php\">Index</a></p>";
?>
</div>