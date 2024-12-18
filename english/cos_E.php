<?php
require_once "../cart/shopping_cart.php";
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: indexl.html');
    exit;
}

$member_id = $_SESSION['loggedin'];
$shoppingCart = new ShoppingCart();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":

            if (!empty($_POST["quantity"])) {

                $productResult = $shoppingCart->getProductById($_GET["id_eveniment"]);

                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id_eveniment"], $member_id);

                if (!empty($cartResult)) {

                    $newQuantity = $cartResult[0]["cantitate"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity(
                        $newQuantity,
                        $cartResult[0]["id"]
                    );
                } else {

                    $shoppingCart->addToCart(
                        $productResult[0]["id_eveniment"],
                        $_POST["quantity"],
                        $member_id
                    );
                }
            }
            break;
        case "remove":

            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":

            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>
<HTML>

<HEAD>
    <TITLE>creare cos permament in PHP</TITLE>
    <link href="../Proiect.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>

    <nav>
        <a href="Proiect_evenimente_E.php" onclick="showEvents()">Events available</a>
        <a href="Proiect_agenda_E.php">Agenda</a>
        <a href="Proiect_speaker_E.php">Speakers</a>
        <a href="Proiect_sponsori_E.php">Partners & Sponsors</a>
        <a href="Proiect_contact_E.php">Contact</a>
        <a href="../cart/cos.php"><img src="../resurse/romania.png" alt="RO" style="width: 20px;"></a>
        <a href="cos_E.php"><img src="../resurse/united-kingdom.png" alt="ENG" style="width: 20px;"></a>
        <a href="cos_E.php"><img src="../resurse/trolley.png" alt="COS" style="width: 20px;"></a>
        <a href="../login/Proiect_logout.php">Logout</a>
    </nav>

    <div id="shopping-cart"  style="margin: 50px;">
        <div class="txt-heading">

            <div class="txt-heading-label"><h2>Shopping Cart</h2></div> <a id="btnEmpty" href="cos.php?action=empty"><img
                    src="../resurse/shopping-cart.png" alt="empty-cart" title="Empty Cart" style="width: 20px;" /></a>
        </div>
        <?php
        $cartItem = $shoppingCart->getMemberCartItem($member_id);
        if (!empty($cartItem)) {
            $item_total = 0;
            ?>
            <table cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align: left;"><strong>Name</strong></th>
                        <th style="text-align: left;"><strong>Id</strong></th>
                        <th style="text-align: right;"><strong>Quantity</strong></th>
                        <th style="text-align: right;"><strong>Price</strong></th>
                        <th style="text-align: center;"><strong>Action</strong></th>
                    </tr>
                    <?php
                    foreach ($cartItem as $item) {
                        ?>
                        <tr>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong>
                                    <?php echo $item["nume"]; ?>
                                </strong></td>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px solid;">
                                <?php echo $item["id"]; ?>
                            </td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px solid;">
                                <?php echo $item["cantitate"]; ?>
                            </td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px solid;">
                                <?php echo "$" . $item["pret"]; ?>
                            </td>
                            <td style="text-align: center; border-bottom: #F0F0F0 1px solid;">
                                <a href="cos.php?action=remove&id=<?php echo $item["id"]; ?>" 21 class="btnRemoveAction"><img src="../resurse/trash.png" alt="icon-delete"
                                        title="Remove Item" style="width: 20px;" /></a></td>
                        </tr>
                        <?php
                        $item_total += ($item["pret"] * $item["cantitate"]);
                    }
                    ?>
                    <tr>
                        <td colspan="3" align=right><strong>Total:</strong></td>
                        <td align=right><?php echo "$" . $item_total; ?></td>
                        <td>
                        <form method="post" action="../payment/checkout.php">
                            <button><strong style="color: white;">Pay</strong></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
        }
        ?>
    </div>
    

</BODY>

</HTML>