<?php
require_once "db_controller.php";
class ShoppingCart extends DBController
{
    function getAllProduct(){
        $query = "SELECT * FROM evenimente";
        $productResult = $this->getDBResult($query);
        return $productResult;
    }
    function getMemberCartItem($member_id){
        $query = "SELECT evenimente.*, cos.id as
            id,cos.cantitate FROM evenimente, cos WHERE
            evenimente.id_eveniment = cos.event_id AND cos.utilizator_id = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }
    function getProductById($product_id){
        $query = "SELECT * FROM evenimente WHERE id_eveniment=?"; //*
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            )
        );
        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }
    function getProductByCode($product_code){
        $query = "SELECT * FROM tbl_product WHERE code=?";
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $product_code
            )
        );

        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }
    function getCartItemByProduct($product_id, $member_id){
        $query = "SELECT * FROM cos WHERE event_id = ? AND utilizator_id = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }
    function addToCart($product_id, $quantity, $member_id){
        $query = "INSERT INTO cos (event_id,cantitate,utilizator_id) VALUES (?, ?, ?)";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }
    function updateCartQuantity($quantity, $cart_id){
        $query = "UPDATE cos SET cantitate = ? WHERE id= ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        $this->updateDB($query, $params);
    }
    function deleteCartItem($cart_id){
        $query = "DELETE FROM cos WHERE id = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        $this->updateDB($query, $params);
    }
    function emptyCart($member_id){
        $query = "DELETE FROM cos WHERE utilizator_id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }
}
