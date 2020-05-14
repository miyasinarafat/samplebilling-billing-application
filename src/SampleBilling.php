<?php

namespace App\SampleBilling;

use PDO;

class SampleBilling
{
    // user table
    protected $id;
    public $uid;
    public $name;
    protected $password;
    public $email;
    public $phone;
    public $fb_profile_url;

    // transaction table
    public $amount;
    public $bkasht_id;
    protected $user_id;
    public $new_id;
    public $accept_id;

    public $data;
    public $errors;
    public $con;

    // login
    public $log_email;
    public $log_password;

    public function __construct()
    {
        session_start();
        date_default_timezone_set("Asia/Dhaka");
        $this->con = new PDO('mysql:host=localhost;dbname=samplebilling', "valet", "valet1234");
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

        // log data
        if (!empty($data['log_email'])) {
            $this->log_email = $data['log_email'];
        }
        if (!empty($data['log_password'])) {
            $this->log_password = $data['log_password'];
        }

        // transaction
        if (!empty($data['amount'])) {
            $this->amount = $data['amount'];
            $this->errors = true;
        }
        if (!empty($data['bkasht_id'])) {
            $this->bkasht_id = $data['bkasht_id'];
            $this->errors = true;
        }

        if (!empty($data['new_id'])) {
            $this->new_id = $data['new_id'];
        }
        if (!empty($data['accept_id'])) {
            $this->accept_id = $data['accept_id'];
        }

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

    public function login()
    {
        try {
            $query = "SELECT * FROM user_table WHERE email = '$this->log_email'AND password='$this->log_password'";
            $query = $this->con->prepare($query);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if (isset($row) && !empty($row)) {
                if ($row['is_delete'] == 0) {
                    if ($row['is_admin'] == 1) {
                        $_SESSION['Login_data'] = $row;
                        $_SESSION['Login'] = "Successfully Login";
                        header("location:views/index.php?id=" . $_SESSION['Login_data']['unique_id']);
                    } else {
                        $_SESSION['Login_data'] = $row;
                        $_SESSION['Login'] = "Successfully Login";
                        header("location:views/profile.php?id=" . $_SESSION['Login_data']['unique_id']);
                    }
                } else {
                    $_SESSION['Is_D'] = "Your account was Suspended, Please contact with admin.";
                    header("location:login.php");
                }
            } else {
                $_SESSION['U_P'] = "UserName & Password dose not matched.";
                header("location:login.php");
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function loginCheck()
    {
        if (empty($_SESSION['Login_data']) && !isset($_SESSION['Login_data'])) {
            $_SESSION['Errors_R'] = "User not found :(";
            header("location:errors.php");
        }
    }

    public function logout()
    {
        try {
            $_SESSION['Logout_M'] = "Successfully logout";
            unset($_SESSION['Login_data']);
            header("location:../login.php");
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function index()
    {
        try {
            $qur = "SELECT * FROM user_table WHERE is_delete = 0";
            $query = $this->con->prepare($qur);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $this->data[] = $row;
            }
            return $this->data;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function show()
    {
        try {
            $qur = "SELECT * FROM user_table WHERE unique_id=" . "'" . $this->id . "'";
            $query = $this->con->prepare($qur);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['acc_data'] = $row;
            return $row;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function transaction()
    {
        if (!empty($this->errors) == true) {
            try {
                $this->user_id = $_SESSION['Login_data']['id'];
                $this->uid = uniqid();

                $query = "INSERT INTO transaction_table (`id`, `user_id`, `unique_id`, `amount`, `bkasht_id`,`is_accept`,`is_new`, `created`) VALUES (:id, :user_id, :unique_id, :amount, :bkasht_id, :is_accept, :is_new, :created)";
                $stmt = $this->con->prepare($query);
                $stmt->execute(array(
                    ':id' => null,
                    ':user_id' => $this->user_id,
                    ':unique_id' => $this->uid,
                    ':amount' => $this->amount,
                    ':bkasht_id' => $this->bkasht_id,
                    ':is_accept' => 0,
                    ':is_new' => 0,
                    ':created' => date("Y-m-d h:i:s"),
                ));
                $_SESSION['orderS'] = 'Your order has been submitted.';
                header("location:request-money.php?id=" . $_SESSION['Login_data']['unique_id']);

            } catch (Exception $exc) {
                echo 'Error: ' . $exc->getMessage();
            }
        } else {
            header("location:request-money.php?id=" . $_SESSION['Login_data']['unique_id']);
        }
    }

    public function transactionIndex()
    {
        try {
            $this->user_id = $_SESSION['Login_data']['id'];

            $qur = "SELECT * FROM transaction_table WHERE user_id = '$this->user_id' ORDER BY transaction_table.id DESC";
            $query = $this->con->prepare($qur);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $this->data[] = $row;
            }
            return $this->data;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function transactionIndexForAdmin()
    {
        try {
            $qur = "SELECT user_table.id,transaction_table.user_id, user_table.name, user_table.email, transaction_table.amount, transaction_table.unique_id, transaction_table.bkasht_id,transaction_table.is_accept,transaction_table.created,transaction_table.accepted,transaction_table.remain FROM user_table LEFT JOIN transaction_table ON user_table.id = transaction_table.user_id WHERE is_new = '1' ORDER BY transaction_table.id DESC";
            $query = $this->con->prepare($qur);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $this->data[] = $row;
            }
            return $this->data;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function moneyRequest()
    {
        try {
            $qur = "SELECT user_table.id,transaction_table.user_id, user_table.name, user_table.email, transaction_table.unique_id,transaction_table.amount, transaction_table.bkasht_id,transaction_table.is_accept,transaction_table.created,transaction_table.accepted,transaction_table.remain FROM user_table LEFT JOIN transaction_table ON user_table.id = transaction_table.user_id WHERE is_new = '0' ORDER BY transaction_table.id DESC";
            $query = $this->con->prepare($qur);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $this->data[] = $row;
            }
            return $this->data;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function acceptOrDueMoney()
    {
        try {
            if ($this->accept_id == 1) {
                $query = "UPDATE transaction_table SET is_accept=:is_accept,is_new=:is_new,accepted=:accepted WHERE unique_id=" . "'" . $this->id . "'";
                $stmt = $this->con->prepare($query);
                $stmt->execute(array(
                    ":is_accept" => $this->accept_id,
                    ":is_new" => $this->new_id,
                    ":accepted" => date("Y-m-d h:i:s"),
                ));
                $_SESSION['Accept_M'] = "Accepted order";
                header("location:money-request.php?id=" . $_SESSION['Login_data']['unique_id']);
            } else {
                $query = "UPDATE transaction_table SET is_accept=:is_accept,is_new=:is_new,remain=:remain WHERE unique_id=" . "'" . $this->id . "'";
                $stmt = $this->con->prepare($query);
                $stmt->execute(array(
                    ":is_accept" => $this->accept_id,
                    ":is_new" => $this->new_id,
                    ":remain" => date("Y-m-d h:i:s"),
                ));
                $_SESSION['remain_M'] = "Due order";
                header("location:money-request.php?id=" . $_SESSION['Login_data']['unique_id']);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateUser()
    {
        try {
            if (!empty($this->errors) == true) {
                $query = "UPDATE user_table SET name=:name,password=:password,email=:email,phone=:phone,fb_profile_url=:fb_profile_url,modified=:modified WHERE unique_id=" . "'" . $this->id . "'";
                $stmt = $this->con->prepare($query);
                $stmt->execute(array(
                    ":name" => $this->name,
                    ":password" => $this->password,
                    ":email" => $this->email,
                    ":phone" => $this->phone,
                    ":fb_profile_url" => $this->fb_profile_url,
                    ":modified" => date("Y-m-d h:i:s"),
                ));
                $_SESSION['Pro_U'] = "Profile Updated";
                header("location:edit.php?id=" . $this->id);
            } else {
                header("location:edit.php?id=" . $this->id);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function trash()
    {
        try {
            $query = "UPDATE user_table SET is_delete=:is_delete,deleted=:deleted WHERE unique_id=" . "'" . $this->id . "'";
            $stmt = $this->con->prepare($query);
            $stmt->execute(array(
                ":is_delete" => 1,
                ":deleted" => date("Y-m-d h:i:s"),
            ));
            $_SESSION['Sus_Acc'] = "Successfully Suspended";
            header("location:trash-item.php?id=" . $_SESSION['Login_data']['unique_id']);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function restore()
    {
        try {
            $query = "UPDATE user_table SET is_delete=:is_delete,deleted=:deleted WHERE unique_id=" . "'" . $this->id . "'";
            $stmt = $this->con->prepare($query);
            $stmt->execute(array(
                ":is_delete" => 0,
                ":deleted" => date("Y-m-d h:i:s"),
            ));
            $_SESSION['Res_Acc'] = "Successfully restore";
            header("location:index.php?id=" . $_SESSION['Login_data']['unique_id']);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function indexTrash()
    {
        try {
            $qur = "SELECT * FROM user_table WHERE is_delete = 1";
            $query = $this->con->prepare($qur);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $this->data[] = $row;
            }
            return $this->data;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function delete()
    {
        try {
            $query = "DELETE user_table, transaction_table FROM user_table INNER JOIN transaction_table ON user_table.id = transaction_table.user_id WHERE user_table.unique_id=" . "'" . $this->id . "'";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            $_SESSION['dele_Acc'] = "Successfully Deleted";
            header("location:trash-item.php?id=" . $_SESSION['Login_data']['unique_id']);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function countUsers()
    {
        try {
            $query = "SELECT COUNT(*) AS id FROM user_table";
            $query = $this->con->prepare($query);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $exc) {
            echo 'Error: ' . $exc->getMessage();
        }
    }

    public function countTrashUser()
    {
        try {
            $query = "SELECT COUNT(*) AS is_delete FROM user_table WHERE is_delete= 1";
            $query = $this->con->prepare($query);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $exc) {
            echo 'Error: ' . $exc->getMessage();
        }
    }

    public function countNewOrder()
    {
        try {
            $query = "SELECT COUNT(*) AS is_new FROM transaction_table WHERE is_new= 0";
            $query = $this->con->prepare($query);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $exc) {
            echo 'Error: ' . $exc->getMessage();
        }
    }

    public function countCompleteOrder()
    {
        try {
            $query = "SELECT COUNT(*) AS is_accept FROM transaction_table WHERE is_accept= 1";
            $query = $this->con->prepare($query);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $exc) {
            echo 'Error: ' . $exc->getMessage();
        }
    }
}