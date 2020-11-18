<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php 
class customer{
    private $db;
    private $fm;
    public function __construct(){
        $this ->db = new Database();
        $this ->fm = new Format(); 
    }
    public function login($data){
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $password = mysqli_real_escape_string($this->db->link,$data['password']);
        if($email =="" || $password =="")
        {
            $alert = "Not empty";
            return $alert;
        }else{
            $query = "select * from tbl_customer where email='$email' and password='$password'";
            $result = $this->db->select($query);
            if($result){
                $value = $result->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('Location:order.php');
            }else{
                $alert ='<span class="badge badge-danger">password doesnt match</span>';
                return $alert;
            }
        }
      
    }
    public function insertCustomer($data){
        $name = mysqli_real_escape_string($this->db->link,$data['name']);
        $gender = mysqli_real_escape_string($this->db->link,$data['gender']);
        $address = mysqli_real_escape_string($this->db->link,$data['address']);
        $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $password = mysqli_real_escape_string($this->db->link,$data['password']);
        if($name == "" || $gender == "" || $address == "" || $phone == "" || $email == "" || $password == ""){
            $alert = "Field must be not empty";
            return $alert;
        }else{
            $check_email = "select * from tbl_customer where email = '$email' Limit 1";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "This email already exist";
                return $alert;
            }else{
            $query = "Insert into tbl_customer(name,gender,address,phone,email,password)
            values('$name','$gender','$address','$phone','$email','$password')";
            $result = $this->db->insert($query);
            if($result){
                $alert ='<span style="color:green" class="badge badge-success">Success</span>';
                return $alert;
            }else{
                $alert ='<span class="badge badge-danger">Danger</span>';
                return $alert;
            }
        }
            }

    }
    public function show($id){
        $query = "select * from tbl_customer where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}

?>