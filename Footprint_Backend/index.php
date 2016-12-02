<?php


class footprintAPI {
    private $db;

    // Constructor - open DB connection
    function __construct() {
        $this->db = new mysqli('localhost', 'YOURUSERNAME', 'YOURPASSWORD', 'footprint');
        $this->db->autocommit(TRUE);
    }
 
    // Destructor - close DB connection
    function __destruct() {
        $this->db->close();
    }

    public function setAppID(){

         if (isset($_POST["appName"])) {
            echo 'insert statement';
            $appName = $_POST["appName"];
            echo $appName;

            $statement = $this->db->prepare("INSERT INTO fp_app (app_name) VALUES (?)");
            $statement->bind_param("s", $appName);
            $statement->execute();

            $statement->close();

      
            return true;

         }
         return false;  
    }

    public function addTracking(){


         if (isset($_POST["applicationName"]) && isset($_POST["name"]) && isset($_POST["type"]) && isset($_POST["view"]) && isset($_POST["time"])) {
            echo 'tracking';

            $applicationName = $_POST["applicationName"];
            $name = $_POST["name"];
            $type = $_POST["type"];
            $time = $_POST["view"];
            $view = $_POST["time"];

            echo $applicationName;
            $stmt = $this->db->prepare("SELECT id FROM fp_app WHERE app_name=?");
            $stmt->bind_param("s",$applicationName);
            $stmt->execute();
            $stmt->bind_result($currentAppId);
            while($stmt->fetch()){
                echo $currentAppId; 
                $cAppID = $currentAppId;
            }
            
            $stmt->close();

        
            echo 'stored id';
            echo $cAppID;

            $statement = $this->db->prepare("INSERT INTO fp_tracking(fp_app_id, name, type, view, time) VALUES (?,?,?,?,?)");
            $statement->bind_param("issss",$cAppID, $name, $type, $time, $view);
            $statement->execute();

            $statement->close();

      
            return true;
         }
         return false;  
    }
}
 
$api = new footprintAPI;
$api->setAppID();
$api->addTracking();
 
?>

