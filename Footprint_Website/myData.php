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

    public function getAllData(){
      $appID = '1';

      $stmt = $this->db->prepare("SELECT * FROM fp_tracking WHERE fp_app_id=?");
          $stmt->bind_param("i", $appID);
          $stmt->execute();
          
          $stmt->bind_result($id, $fp_app_id, $name, $type, $view, $time);

         $data = array(); 
          while($stmt->fetch()){

              $row =  array (
                'id' => $id,
                'fp_app_id' => $fp_app_id,
                'name' => $name,
                'type' => $type,
                'view' => $view,
                'time' => $time
              );

              array_push($data,$row); 

          }

          $stmt->close();

          return $data;
    }

    public function getSessions(){
      $startController = "StartViewController";

      $stmt = $this->db->prepare("SELECT * FROM fp_tracking WHERE view=?");
          $stmt->bind_param("s", $startController);
          $stmt->execute();
          
          $stmt->bind_result($id, $fp_app_id, $name, $type, $view, $time);

         $data = array(); 
          while($stmt->fetch()){

              $row =  array (
                'id' => $id,
                'fp_app_id' => $fp_app_id,
                'name' => $name,
                'type' => $type,
                'view' => $view,
                'time' => $time
              );

              array_push($data,$row); 

          }

          $stmt->close();

          return $data;
    }

    public function getData($id){
      	$stmt = $this->db->prepare("SELECT male, female FROM higcharts_data WHERE map_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($male, $female);
       	
       	$arr 	= array();
		  $arr1 	= array();
		  $result = array();
		  $j = 0;

        while($stmt->fetch()){
            if($j == 0){
			$arr['name'] = 'Male';
			$arr1['name'] = 'Female';
				$j++;
			}
			$arr['data'][] = $male;
			$arr1['data'][] = $female;
        }

        array_push($result,$arr);
  		array_push($result,$arr1);



        $stmt->close();

          return $result ;
    }

    public function getPageData(){
  
    	$startView = "StartViewController";
    	$pageView = "MyListsViewController";
    	$uniqueView = "UniqueListsViewController";

    	$result = array();
    	$data = array();
    	$arr = array();
		  $arr1 = array();

      $stmt = $this->db->prepare("SELECT * FROM fp_tracking WHERE view=?");
		  $stmt->bind_param("s", $startView);
		  $stmt->execute();
		  $stmt->store_result();
		  $startCount= $stmt->num_rows; 	
    	array_push($arr1, $startCount);

    	$stmt->close();

      $stmt = $this->db->prepare("SELECT * FROM fp_tracking WHERE view=?");
      $stmt->bind_param("s", $pageView);
      $stmt->execute();
      $stmt->store_result();
		  $pageCount= $stmt->num_rows; 
    	array_push($arr1, $pageCount);
    	$stmt->close();

    	$stmt = $this->db->prepare("SELECT * FROM fp_tracking WHERE view=?");
      $stmt->bind_param("s", $uniqueView);
      $stmt->execute();
      $stmt->store_result();
	   	$uniqueCount= $stmt->num_rows; 
    	array_push($arr1, $uniqueCount);
    	$stmt->close();


	   	$arr['name'] = 'views';
		  $arr['data'] = $arr1;

		  array_push($result, $arr);

          return $result ;
    }

    

  }

  $api = new dataAPI;
  $appData = $api->getAllData();
  $sessions = $api->getSessions(); 
  

  $result = $api->getPageData(); 
  echo json_encode($result, JSON_NUMERIC_CHECK);

?>
