<?php
class Plan
{
    // dbection
    private $db;
    // Table
    private $db_table = "plans";
    // Columns
    public $_id;
    public $operator;
    public $plan_name;
    public $plan_value;
    public $Internet_details;
    public $talk_value;
    public $validity;
    public $plan_details;
    public $othe_details;
    public $created;


    // Db dbection
    public function __construct($db)
    {
        $this->db = $db;
    }

    // GET ALL
    public function getPlans()
    {
        $sqlQuery = "SELECT _id, operator, plan_name, plan_value, Internet_details, talk_value, validity, plan_details, othe_details, created FROM " . $this->db_table . "";
        $this->result = $this->db->query($sqlQuery);
        return $this->result;
    }

    // CREATE
    public function createPlan()
    {
        // sanitize
        $this->operator = htmlspecialchars(strip_tags($this->operator));
        $this->plan_name = htmlspecialchars(strip_tags($this->plan_name));
        $this->plan_value = htmlspecialchars(strip_tags($this->plan_value));
        $this->Internet_details = htmlspecialchars(strip_tags($this->Internet_details));
        $this->talk_value = htmlspecialchars(strip_tags($this->talk_value));
        $this->validity = htmlspecialchars(strip_tags($this->validity));
        $this->plan_details = htmlspecialchars(strip_tags($this->plan_details));
        $this->othe_details = htmlspecialchars(strip_tags($this->othe_details));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $sqlQuery =
            "INSERT INTO " . $this->db_table . "(
            operator,
            plan_name,
            plan_value,
            Internet_details, 
            talk_value,
            validity,
            plan_details,
            othe_details,
            created ) 
            VALUES (
                '$this->operator',
                '$this->plan_name',
                '$this->plan_value',
                '$this->Internet_details', 
                '$this->talk_value',
                '$this->validity',
                '$this->plan_details',
                '$this->othe_details',
                '$this->created'
            )";
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // get details
    public function getSinglePlan()
    {
        $sqlQuery = 'SELECT _id, operator, plan_name, plan_value, Internet_details, talk_value, validity, plan_details, othe_details,created FROM ' . $this->db_table . ' WHERE _id =' . $this->_id;
        $record = $this->db->query($sqlQuery);
        if ($record->num_rows > 0) {
            $dataRow = $record->fetch_assoc();
            $this->_id = $dataRow['_id'];
            $this->operator = $dataRow['operator'];
            $this->plan_name = $dataRow['plan_name'];
            $this->plan_value = $dataRow['plan_value'];
            $this->Internet_details = $dataRow['Internet_details'];
            $this->talk_value = $dataRow['talk_value'];
            $this->validity = $dataRow['validity'];
            $this->plan_details = $dataRow['plan_details'];
            $this->othe_details = $dataRow['othe_details'];
            $this->created = $dataRow['created'];
        }
    }

    // UPDATE
    public function updatePlan()
    {
        $this->operator = htmlspecialchars(strip_tags($this->operator));
        $this->plan_name = htmlspecialchars(strip_tags($this->plan_name));
        $this->plan_value = htmlspecialchars(strip_tags($this->plan_value));
        $this->Internet_details = htmlspecialchars(strip_tags($this->Internet_details));
        $this->talk_value = htmlspecialchars(strip_tags($this->talk_value));
        $this->validity = htmlspecialchars(strip_tags($this->validity));
        $this->plan_details = htmlspecialchars(strip_tags($this->plan_details));
        $this->othe_details = htmlspecialchars(strip_tags($this->othe_details));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->_id = htmlspecialchars(strip_tags($this->_id));

        $sqlQuery = "UPDATE " . $this->db_table .
            " SET operator = '" . $this->operator . "',
            plan_name = '" . $this->plan_name . "',
            plan_value = '" . $this->plan_value . "',
            Internet_details = '" . $this->Internet_details . "',
            talk_value = '" . $this->talk_value . "',
            validity = '" . $this->validity . "',
            plan_details = '" . $this->plan_details . "',
            created = '" . $this->created . "',
            othe_details = '" . $this->othe_details . "'
            WHERE _id = " . $this->_id;

        var_dump($sqlQuery);
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // DELETE
    function deletePlan()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE _id = " . $this->_id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}
