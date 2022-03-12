<?php
class User
{
    // dbection
    private $db;
    // Table
    private $db_table = "users";
    // Columns
    public $_id;
    public $f_name;
    public $l_name;
    public $email;
    public $password;
    public $user_type;
    public $mobile;
    public $country;
    public $language;
    public $balanceAmount;
    public $created_by;
    public $agentType;
    public $agentCreatedBy;


    // Db dbection
    public function __construct($db)
    {
        $this->db = $db;
    }

    // GET ALL
    public function getUsers()
    {
        $sqlQuery = "SELECT _id, f_name, l_name, email, user_type, mobile, country, language, balanceAmount, created_by FROM " . $this->db_table . " WHERE created_by = " . $this->agentCreatedBy . " AND user_type = " . $this->agentType;
        $this->result = $this->db->query($sqlQuery);
        return $this->result;
    }

    // CREATE
    public function createUser()
    {
        // sanitize
        $this->f_name = htmlspecialchars(strip_tags($this->f_name));
        $this->l_name = htmlspecialchars(strip_tags($this->l_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->user_type = htmlspecialchars(strip_tags($this->user_type));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->language = htmlspecialchars(strip_tags($this->language));
        $this->balanceAmount = htmlspecialchars(strip_tags($this->balanceAmount));
        $this->created_by =  htmlspecialchars(strip_tags($this->created_by));
        $sqlQuery =
            "INSERT INTO " . $this->db_table . "(f_name, l_name, email, password, user_type, mobile, country, language, balanceAmount, created_by) 
            VALUES ('$this->f_name', '$this->l_name', '$this->email', '$this->password', '$this->user_type', '$this->mobile', '$this->country', '$this->language', '$this->balanceAmount', '$this->created_by')";
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // get details
    public function getSingleUser()
    {
        $sqlQuery = 'SELECT _id, f_name, l_name, email, user_type, mobile, country, language,balanceAmount, created_by FROM ' . $this->db_table . ' WHERE _id =' . $this->_id;
        $record = $this->db->query($sqlQuery);
        if ($record->num_rows > 0) {
            $dataRow = $record->fetch_assoc();
            $this->_id = $dataRow['_id'];
            $this->f_name = $dataRow['f_name'];
            $this->l_name = $dataRow['l_name'];
            $this->email = $dataRow['email'];
            $this->user_type = $dataRow['user_type'];
            $this->mobile = $dataRow['mobile'];
            $this->country = $dataRow['country'];
            $this->language = $dataRow['language'];
            $this->balanceAmount = $dataRow['balanceAmount'];
            $this->created_by = $dataRow['created_by'];
        }
    }

    // UPDATE
    public function updateAmount()
    {
        $this->balanceAmount = htmlspecialchars(strip_tags($this->balanceAmount));
        $this->_id = htmlspecialchars(strip_tags($this->_id));

        $sqlQuery = "UPDATE " . $this->db_table .
            " SET balanceAmount = '" . $this->balanceAmount . "'
            WHERE _id = " . $this->_id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function updateUser()
    {
        $this->f_name = htmlspecialchars(strip_tags($this->f_name));
        $this->l_name = htmlspecialchars(strip_tags($this->l_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->user_type = htmlspecialchars(strip_tags($this->user_type));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->language = htmlspecialchars(strip_tags($this->language));
        $this->balanceAmount = htmlspecialchars(strip_tags($this->balanceAmount));
        $this->_id = htmlspecialchars(strip_tags($this->_id));

        $sqlQuery = "UPDATE " . $this->db_table .
            " SET f_name = '" . $this->f_name . "',
            l_name = '" . $this->l_name . "',
            email = '" . $this->email . "',
            user_type = '" . $this->user_type . "',
            mobile = '" . $this->mobile . "',
            country = '" . $this->country . "',
            language = '" . $this->language . "',
            balanceAmount = '" . $this->balanceAmount . "'
            WHERE _id = " . $this->_id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteUser()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE _id = " . $this->_id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}
