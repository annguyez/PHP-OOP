<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    
?>

<?php 
class cart{
    private $db;
    private $fm;
    public function __construct(){
        $this ->db = new Database();
        $this ->fm = new Format(); 
    }
    public function addToCart($quantity, $id){
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link,$quantity);
        $id = mysqli_real_escape_string($this->db->link,$id);
        $sId = session_id();
        $query = "select * from tbl_product where productId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();
        $productId = $result['productId'];
        $productName = $result['productName'];
        $image = $result['image'];
        $price = $result['price'];

        $checkCart = "select * from tbl_cart where productId = '$id' and sId='$sId'";
        $check_cart = $this->db->select($checkCart);
        if(mysqli_num_rows($check_cart)>0){
            // $old_quantity = $check_cart['quantity'];
            // $new_quantity = mysqli_real_escape_string($this->db->link,$quantity);
            // $queryUpdate = "Update tbl_cart set quantity='$old_quantity+ $new_quantity' where 
            // productId='$productId' and  sId = '$sId'";
            // $UpdateCart = $this->db->update($queryUpdate);
            // if($UpdateCart){
            //     header("Location:cart.php");
            // }else{
            //     header("Location:404.php");
            // }
            $alert = "Aldready product";
            return $alert;
            
        }else{
            $queryInsert = "insert into tbl_cart(productId,sId, productName,price,quantity,image)
            values('$productId','$sId','$productName','$price','$quantity','$image')";
            $insertCart = $this->db->insert($queryInsert);
            if($insertCart){
                header("Location:cart.php");
            }else{
                header("Location:404.php");
            }
        }
    }
    public function getProductCart(){
        $sId = session_id();
        $query = "select * from tbl_cart where sId = '$sId'";
        $result = $this->db->select($query);
        return  $result;
    }
    public function updateQuantity($quantity, $cartId){
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $queryUpdate = "Update tbl_cart set quantity='$quantity' where 
            cartId='$cartId' ";
        $result = $this->db->update($queryUpdate);
        if($result){
            $msg = "Update Success";
            return $msg;
        }else{
            $msg = "Update Failse";
            return $msg;
        }
    }
    public function deleteCart($cartId){
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query  = "delete from tbl_cart where cartId= '$cartId'";
        $result = $this->db->delete($query);
        if($result){
            header('Location:cart.php');
            
            return $msg;
        }else{
            $msg = "Delete Failse";
            return $msg;
        }
        
    }
    public function checkCart(){
        $sId = session_id();
        $checkCart = "select * from tbl_cart where sId='$sId'";
        $result = $this->db->select($checkCart);
        return $result;
    }
    public function deleteAll(){
        $sId = session_id();
        $query = "delete from tbl_cart where sId='$sId'";
        $result = $this->db->delete($query);
        return $result;
    }
    public function insertOrder($customerId){
        $sId = session_id();
        $query = "select * from tbl_cart where sId= '$sId'";
        $getProduct = $this->db->select($query);
        if($getProduct){
            while($result = $getProduct->fetch_assoc()){
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price']*$quantity;
                $image = $result['image'];
                $customerId = $customerId;
                $order = "insert into tbl_order(productId, productName,customerId,quantity,price,image) 
                values ('$productId','$productName','$customerId','$quantity','$price','$image')";
                $resultOrder = $this->db->insert($order);
            }
        }
    }
    public function getTotal($customerId){
        $query  = "Select price from tbl_order where customerId = '$customerId'";
        $getPrice = $this->db->select($query);
        return $getPrice;

    }
    public function getCartOrder($customerId){
        $query  = "Select * from tbl_order where customerId = '$customerId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getInboxCart(){
        $query  = "Select * from tbl_order";
        $result = $this->db->select($query);
        return $result;
    }
    public function change($id){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "update tbl_order set status = '1' where id = $id";
        $result = $this->db->update($query);
        if($result){
            $msg = "Update Success";
            return $msg;
        }else{
            $msg = "Update Failse";
            return $msg;
        }
    }
}

?>