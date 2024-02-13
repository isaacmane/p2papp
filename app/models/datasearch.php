<?php

Class Datasearch{

	public function __construct() {
        $this->DB = new Database();
    }

	function whatSrch($p)
	{
		if (strlen(key($p)) > 0) {
			$what = key($p)."%";
			$data = [];
			$query = "select DISTINCT position from post where position like '%$what%' and status = '2' limit 5";
			//echo $query;
			$data = $this->DB->read($query, $data);

			//show($data);
			$html = '';
			if (is_array($data)) {
				foreach ($data as $key => $value) {
					$positionslist[$key] = $value->position; 
				}				
			
				foreach ($positionslist as $key => $value) {
					$html .= "<div style='margin-top: 3%; cursor:pointer' id='$value' onclick='desc(this.id)'>";
		          	$html .= "<span>".$value."</span>";
		          	$html .= "</div>";
		        }		        
			}else{
				$html .= "<div style='margin-top: 3%; cursor:pointer'>";
	          	$html .= "<span>No results</span>";
	          	$html .= "</div>";
			}	
			echo $html;			
		}		
	}

	function whereSrch($p)
	{
		//echo $p;
		if (strlen(key($p)) > 0) {
			$where = key($p)."%";
			$data = [];
			//$query = "SELECT UC.CITY, US.STATE_NAME FROM `us_cities` AS UC, us_states AS US WHERE UC.city like '$where' AND UC.STATUS = 'A' AND UC.ID_STATE = US.ID";
			$query = "SELECT UC.CITY, US.STATE_NAME FROM `us_cities` AS UC, us_states AS US WHERE UC.city like '$where' AND UC.STATUS = 'A' AND UC.ID_STATE = US.ID UNION SELECT UC.CITY, US.STATE_NAME FROM `us_cities` AS UC, us_states AS US WHERE US.STATE_NAME like '$where' AND UC.STATUS = 'A' AND UC.ID_STATE = US.ID";
			//echo $query;
			$data = $this->DB->read($query, $data);
			//show($data);
			if (is_array($data)) {
				foreach ($data as $key => $value) {
					$positionslist[$key] = $value->CITY.", ".$value->STATE_NAME; 
				}
				$html = '';
			
				foreach ($positionslist as $key => $value) {
					$html .= "<div style='margin-top: 3%; cursor:pointer' id='$value' onclick='descwhere(this.id)'>";
		          	$html .= "<span>".$value."</span>";
		          	$html .= "</div>";
		        }		        
		        echo $html;
			}				
		}
	}

	function lookCityStateId($c, $s){
		$data = [];
		$query = "SELECT UC.*, US.STATE_NAME FROM us_cities as UC, us_states as US WHERE UC.ID_STATE = US.ID AND UC.city = '$c' AND US.STATE_NAME = '$s' AND UC.STATUS = 'A'";	
		//echo $query;

		$data = $this->DB->read($query, $data);
		//show($data);
		if (!is_array($data)) {
			return 0;
		}else{
			return $data[0];
		}		
	}

	function jobsSrch($p){
		//show($p);
		$data = $datatype = $datapmntype = $querypmntype = [];
		
		
		if (empty($p['wht']) AND empty($p['whr']) ) {
        	$_SESSION['validatefields'] = '<b>Enter a job title or location to start a search</b><br>';
        }else{
        	if (empty($p['whr'])) {	        		
        		$term = $p['wht'];
        		if(empty($p['wht'])){
        			$term = '';
        		}
				$exp = explode(" ", $term);
				$wsrch = "'".implode("|", $exp)."'";
        		$query = "SELECT PO.*, UC.CITY, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE (PO.description REGEXP ($wsrch) or PO.position REGEXP ($wsrch)) AND PO.city_id = UC.ID AND PO.state_id = US.ID AND PO.type = TY.id";
        		$tq = 1;
        		$data['term'] = $term;
        		$data['whr'] = "";
        		$data['city'] = "United";
				$data['state'] = "States";
        	}

        	//Check this logic
        	if (empty($p['wht'])) {	
        		$city = explode(",", $p['whr']);
        		$state = trim($city[1]);
        		$city = trim($city[0]);
        		$citystate = $this->lookCityStateId($city, $state);
        		$cityid = trim($citystate->ID);
        		$stateid = trim($citystate->ID_STATE);
        		$query = "SELECT PO.*, UC.*, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.city_id = UC.ID AND PO.state_id = US.ID AND PO.city_id = '$cityid' AND PO.type = TY.id AND UC.STATUS = 'A'";
        		if($cityid = 29881){
        			$query = "SELECT PO.*, UC.*, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.city_id = UC.ID AND PO.state_id = US.ID AND PO.work_location = 1 AND PO.type = TY.id AND UC.STATUS = 'A'";
        		}
				$data['term'] = "";
        		$data['city'] = $city;
				$data['state'] = $state;		
        	}
        	//show($data);
        	if(!empty($p['wht']) AND !empty($p['whr'])){   
        		/*$exp = explode(",", $p["whr"]);
        		$state = trim($exp[1]);
				$city = trim($exp[0]);
				$cityid = $this->lookCityId($city, $state);  
				$term = $p['wht'];
				$expterm = explode(" ", $term);
				$wsrch = "'".implode("|", $expterm)."'";   		
        		$query = "SELECT PO.*, UC.CITY, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.description REGEXP ($wsrch) AND PO.city_id = UC.ID AND PO.state_id = US.ID AND UC.ID = '$cityid' AND PO.type = TY.id UNION SELECT PO.*, UC.CITY, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.position REGEXP ($wsrch) AND PO.city_id = UC.ID AND PO.state_id = US.ID AND UC.ID = '$cityid' AND PO.type = TY.id";*/
        		$data['wht'] = $p['wht'];
        		$data['whr'] = $p['whr'];
        		$data['city'] = $city;
				$data['state'] = $state;
        	}
        	$resultset = $this->DB->read($query, $data);
        	
			if (!is_array($resultset)) {
				$totalrecords = 0;
			}else{
				$totalrecords = count($resultset);
				//show($resultset);
				$data['defaultrcd'] = $resultset[0]->id;
				$data['totalrecords'] = $totalrecords;
				$data['results'] = $resultset;			
				//show($data);
				if (is_array($data)) {
					return $data;
				}else{
					$data = 0;
				};
			}			
        }
        
		/*$exp = explode(",", $p["whr"]);
		//show($exp);
		$state = trim($exp[1]);
		$city = trim($exp[0]);
		$term = $p['wht'];
		$exp = explode(" ", $term);
		$wsrch = "'".implode("|", $exp)."'";
		$cityid = $this->lookCityId($city, $state);

		if ($p["whr"]) {
			if($city == "Remote"){
				$query = "SELECT PO.*, UC.CITY, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.position REGEXP ($wsrch) AND PO.city_id = UC.ID AND PO.state_id = US.ID AND PO.type = TY.id UNION SELECT PO.*, UC.CITY, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.position REGEXP ($wsrch) AND PO.city_id = UC.ID AND PO.state_id = US.ID AND PO.type = TY.id";
			}else{
				$query = "SELECT PO.*, UC.CITY, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.description REGEXP ($wsrch) AND PO.city_id = UC.ID AND PO.state_id = US.ID AND UC.ID = '$cityid' AND PO.type = TY.id UNION SELECT PO.*, UC.CITY, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.position REGEXP ($wsrch) AND PO.city_id = UC.ID AND PO.state_id = US.ID AND UC.ID = '$cityid' AND PO.type = TY.id";
			}
		}		
		if (empty($city) AND empty($state)) {
			$query = "SELECT PO.* FROM `post` AS PO WHERE PO.description REGEXP ('$wsrch') or PO.position REGEXP ($wsrch)";
		}
		
		//echo $query;
		$resultset = $this->DB->read($query, $data);

		if (!is_array($resultset)) {
			$totalrecords = 0;
		}else{
			$totalrecords = count($resultset);
		}
		$data['results'] = $resultset;
		$data['term'] = $term;
		$data['state'] = $state;
		$data['city'] = $city;
		$data['totalrecords'] = $totalrecords;
		//show($data);
		if (is_array($data)) {
			return $data;
		}else{
			$data = 0;
		};*/
		
	}

	function jobId($id){
		$id = array_key_first($id);
		$data = [];
		
		$query = "SELECT PO.*, UC.CITY, US.STATE_NAME, TY.description AS typejob FROM `post` AS PO, us_cities AS UC, us_states AS US, type AS TY WHERE PO.id = '$id' AND PO.city_id = UC.ID AND PO.state_id = US.ID AND PO.type = TY.id";
		//echo $query;
		$data = $this->DB->read($query, $data);
		//show($data);
		$key = 0;
		$html = '';
		$html .= "<div class='card mb-4 box-shadow'>
            <div class='card-body' id='".$data[$key]->id."' onclick='showFdesc(this.id)'>
              <h5 class=''>".$data[$key]->position."</h5>
              <h6>".$data[$key]->company."</h6>
              <h6>".$data[$key]->CITY.", ".$data[$key]->STATE_NAME."</h6>
              <h6>$".$data[$key]->low." - $".$data[$key]->high."<span> ".$data[$key]->typejob."</span></h6>
              <span>".$data[$key]->description."</span>
              <p></p>
            </div>            
          </div>
          <button id='myBtn' class='btn btn-primary'>Apply</button>";        

        echo $html;		
	}
}