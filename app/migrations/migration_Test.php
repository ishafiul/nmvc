<?php 
use app\core\Database;
            
class migration_Test
{
   private Database $db;

    public function __construct()
    {
        $this->db= new Database();
    }
    public function up(){
        $this->db->query("CREATE TABLE IF NOT EXISTS test (
                id INT AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(255),
                lastname VARCHAR(255),
                email VARCHAR(255),
                password VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;");
        $this->db->execute();
    }
    public function down(){
    
    }
}
