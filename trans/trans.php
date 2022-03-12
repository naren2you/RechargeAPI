<?php
class Trans
{
    // dbection
    private $db;
    // Table
    private $db_table = "trans";
    // Columns
    public $_id;
    public $mobile;
    public $operator;
    public $country;
    public $plan_name;
    public $plan_value;
    public $Internet_details;
    public $talk_value;
    public $validity;
    public $plan_details;
    public $status;
    public $requestBy;
    public $requestOn;
    public $processedBy;
    public $processOn;

    // Db dbection
    public function __construct($db)
    {
        $this->db = $db;
    }

    // GET ALL
    public function getTrans()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $this->result = $this->db->query($sqlQuery);
        return $this->result;
    }

    // CREATE
    public function createTrans()
    {
        // sanitize
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->operator = htmlspecialchars(strip_tags($this->operator));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->plan_name = htmlspecialchars(strip_tags($this->plan_name));
        $this->plan_value = htmlspecialchars(strip_tags($this->plan_value));
        $this->Internet_details = htmlspecialchars(strip_tags($this->Internet_details));
        $this->talk_value = htmlspecialchars(strip_tags($this->talk_value));
        $this->validity = htmlspecialchars(strip_tags($this->validity));
        $this->plan_details = htmlspecialchars(strip_tags($this->plan_details));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->requestBy = htmlspecialchars(strip_tags($this->requestBy));
        $this->requestOn = htmlspecialchars(strip_tags($this->requestOn));
        $this->processedBy = htmlspecialchars(strip_tags($this->processedBy));
        $this->processOn = htmlspecialchars(strip_tags($this->processOn));

        $sqlQuery =
            "INSERT INTO " . $this->db_table . "(
                mobile, operator, country, plan_name, plan_value, Internet_details, talk_value, validity, plan_details,  status, requestBy, requestOn, processedBy, processOn ) 
                VALUES ('$this->mobile','$this->operator', '$this->country', '$this->plan_name', '$this->plan_value', '$this->Internet_details', '$this->talk_value', '$this->validity', '$this->plan_details', '$this->status', '$this->requestBy', '$this->requestOn', '$this->processedBy', '$this->processOn')";
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function updateTrans()
    {
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->processedBy = htmlspecialchars(strip_tags($this->processedBy));
        $this->processOn = htmlspecialchars(strip_tags($this->processOn));
        $this->_id = htmlspecialchars(strip_tags($this->_id));

        $sqlQuery = "UPDATE " . $this->db_table . " SET 
            status = '" . $this->status . "',
            processedBy = '" . $this->processedBy . "',
            processOn = '" . $this->processOn . "'
            WHERE _id = " . $this->_id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteTrans()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE _id = " . $this->_id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}
