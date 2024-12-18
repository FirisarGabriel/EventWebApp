<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51P3KHMKMGVk4RjSbVNQ41ji4zW2jF3wANoDEJbU33c2FmkdUrsmlmtviiD0iuQsjZZmdL67pEeZafawoUOpPFX3c00XtWYhPCD";

\Stripe\Stripe::setApiKey($stripe_secret_key);

require_once "../cart/shopping_cart.php";
session_start();
$member_id = $_SESSION['loggedin'];
$shoppingCart = new ShoppingCart();
$cartItem = $shoppingCart->getMemberCartItem($member_id);

if (!empty($cartItem)) {
    $item_total = 0;
    foreach ($cartItem as $item) {
        $item_total += ($item["pret"] * $item["cantitate"]);
    }
    
}

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/proiect/payment/success.php",
    "cancel_url" => "http://localhost/proiect/cart/cos.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "ron",
                "unit_amount" => $item_total*100,
                "product_data" => [
                    "name" => "Evenimente"
                ]
            ]
        ],       
    ]
]);

http_response_code(303);
header("Location: " . $checkout_session->url);