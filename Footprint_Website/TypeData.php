<?php
  class dataAPI {
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

    
    public function getTypeData(){
      $tapType = "tap";
      $swipeType = "swipe";

      $result = array();

      $arr = array();
      $arr1 = array();


      $stmt = $this->db->prepare("SELECT * FROM fp_tracking WHERE Type=?");
      $stmt->bind_param("s", $tapType);
      $stmt->execute();
      $stmt->store_result();
      $tapCount= $stmt->num_rows;  
       $data1 = array(); 
       $data1['name'] = 'taps';
       $data1['y'] = $tapCount;
       array_push($arr1, $data1);

      $stmt->close();

      $stmt = $this->db->prepare("SELECT * FROM fp_tracking WHERE Type=?");
      $stmt->bind_param("s", $swipeType);
      $stmt->execute();
      $stmt->store_result();
      $swipeCount= $stmt->num_rows; 

       $data2 = array(); 
       $data2['name'] = 'swipes';
       $data2['y'] = $swipeCount;
       array_push($arr1, $data2);

      $stmt->close();


      $arr['name'] = 'views';
      $arr['data'] = $arr1;
      array_push($result, $arr);

          return $result ;
    }

  }

  $api = new dataAPI;
  $result = $api->getTypeData(); 
  echo json_encode($result, JSON_NUMERIC_CHECK);
?>
