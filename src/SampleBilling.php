<?php

namespace App\SampleBilling;

use PDO;

class SampleBilling
{
    // user table
    protected $id;
    public $uid;
    protected $user_id;
    public $name;
    protected $password;
    public $email;
    public $phone;
    public $fb_profile_url;

    // transaction table
    public $amount;
    public $bkasht_id;

    public $data;
    public $errors;
    public $con;

    // login
    public $log_name;
    public $log_email;

    public function __construct()
    {
        session_start();
        date_default_timezone_set("Asia/Dhaka");
        $this->con = new PDO('mysql:host=localhost;dbname=SampleBilling', "root", "");
    }

    public function prepare($data)
    {
        if (!empty($data['id'])) {
            $this->id = $data['id'];
        }
        if (!empty($data['name'])) {
            $this->name = $data['name'];
            $this->errors = true;
        }
        if (!empty($data['password'])) {
            $this->password = $data['password'];
            $this->errors = true;
        }
        if (!empty($data['email'])) {
            $this->email = $data['email'];
            $this->errors = true;
        }
        if (!empty($data['phone'])) {
            $this->phone = $data['phone'];
            $this->errors = true;
        }
        if (!empty($data['fb_profile_url'])) {
            $this->fb_profile_url = $data['fb_profile_url'];
            $this->errors = true;
        }
        print_r($data);
    }

    public function validationMessage($validM = "")
    {
        if (isset($_SESSION["$validM"]) && !empty($_SESSION["$validM"])) {
            echo $_SESSION["$validM"];
            unset($_SESSION["$validM"]);
        }
    }

    public function addNewUser()
    {
        if (!empty($this->errors) == true) {
            try {
                $this->uid = uniqid();
                $query = "INSERT INTO user_table (`id`, `unique_id`, `name`, `password`,`email`, `phone`, `fb_profile_url`, `is_admin`, `is_delete`, `created`) VALUES (:id, :unique_id, :namee, :password, :email, :phone, :fb_profile_url, :is_admin, :is_delete, :created)";
                $stmt = $this->con->prepare($query);
                $stmt->execute(array(
                    ':id' => null,
                    ':unique_id' => $this->uid,
                    ':namee' => $this->name,
                    ':password' => $this->password,
                    ':email' => $this->email,
                    ':phone' => $this->phone,
                    ':fb_profile_url' => $this->fb_profile_url,
                    ':is_admin' => 0,
                    ':is_delete' => 0,
                    ':created' => date("Y-m-d h:i:s"),
                ));
                $_SESSION['storeSuccess'] = 'Successfully added user';
                header("location:add-user.php");

            } catch (Exception $exc) {
                echo 'Error: ' . $exc->getMessage();
            }
        } else {
            header("location:add-user.php");
        }
    }

}