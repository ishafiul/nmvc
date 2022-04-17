<?php 
use app\core\Database;
            
class migration_Hola
{
   private Database $db;

    public function __construct()
    {
        $this->db= new Database();
    }
    public function up(){
        $this->db->query("CREATE TABLE IF NOT EXISTS hola (
                id INT AUTO_INCREMENT PRIMARY KEY,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;");
        $this->db->execute();
    }
    public function down(){
    
    }
}
