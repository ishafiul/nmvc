<?php
class Newmodel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getinitdata($limit) {
        $this->db->query("SELECT * FROM posts order by id asc limit 0,$limit");
        $results = $this->db->resultSet();
        return $results;
    }
    public function getnextdata($row,$limit) {
        $this->db->query("SELECT * FROM posts order by id asc LIMIT $limit OFFSET $row");
        $results = $this->db->resultSet();
        return $results;
    }
}