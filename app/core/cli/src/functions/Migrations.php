<?php

namespace Console\functions;
use app\core\Database;

class Migrations
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function applyMigrations(){
        $this->createMigrationTable();
        $appliedMigrations = array_values($this->getAplliedMigrations());
        $files = scandir(dirname(__DIR__, 4).'\migrations');
        $objAppliedMigrations = $appliedMigrations;
        $appliedMigrationsArr = [];
        foreach ($objAppliedMigrations as $arry){
            $appliedMigrationsArr[] = $arry->migration;
        }
        $toApplyMigrations = array_diff($files, $appliedMigrationsArr);
        //var_export($toApplyMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            //echo dirname(__DIR__, 4).'\migrations\\'.$migration;
            require_once dirname(__DIR__, 4).'\migrations\\'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            //echo $className;
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("There are no migrations to apply");
        }
        return 'ok';
    }
    public function createMigrationTable(): void
    {
        $this->db->query('CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;');
        $this->db->execute();
    }

    private function getAplliedMigrations()
    {
        $this->db->query('SELECT migration FROM migrations');
        return $this->db->resultSet();
    }
    protected function saveMigrations(array $newMigrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $this->db->query('INSERT INTO migrations (migration) VALUES '.$str);
        $this->db->execute();
    }
    private function log($message)
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }

    public function createMigration($name)
    {
        $path = dirname(__DIR__, 4).'\migrations';
        $className ='migration_'. ucfirst($name);
        if (file_exists($path.'/'.$className.'.php')){
            return '<fg=#f9c33d>'.'Migration Already Exist!'.'</>';
        }
        else{
            $creteFile = fopen($path.'/'.$className.'.php','w');
            $code = '<?php 
use app\core\Database;
            
class '.$className.'
{
   private Database $db;

    public function __construct()
    {
        $this->db= new Database();
    }
    public function up(){
        $this->db->query("CREATE TABLE IF NOT EXISTS '.$name.' (
                id INT AUTO_INCREMENT PRIMARY KEY,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;");
        $this->db->execute();
    }
    public function down(){
    
    }
}
';
            fwrite($creteFile,$code);
            return '<fg=green>'.$className.' Migration Created!'.'</>';
        }
    }
}