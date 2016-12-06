<?php

class parser {
    private $file='tx_ertragskarte_domain_model_regions.csv';
    public function main(){
        $jsonStrng = $this->parseFile();
        file_put_contents('locs.json', $jsonStrng);
    }
    
    private function parseFile(){
        $json='[';
        if(($handle=fopen($this->file,'r')) !== FALSE){
            $counter=0;
            
            $keys=array();
            while($data=fgetcsv($handle,1000,';','"')){
                
                $processedData=array($data[0]);
                
                $address=$this->getAdress($this->makeAddress($data));
                
                if(!$address){
                    var_dump(rawurlencode($this->makeAddress($data)));
                }
                array_push($processedData,array('pos'=>$address));
                
                $json.=json_encode($processedData).',';
                                                        
                $counter++;
                usleep(100);
                
            }
            
        }
        $finaljson=substr($json,0,-1).']';
        
        return $finaljson;
    }
    
    private function makeAddress($data){
        $arr = explode(' ',$data[0]);
        if(count($arr)>1){
            return $arr[1];
        }else{
            return $arr[0];
        }
        
    }
    
   
    
    private function getAdress($address){
        $returnVal=false;

        // Get JSON results from this request
        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.rawurlencode($address).'&sensor=false&components=country:DE&key=AIzaSyBhhaaDitPwEYgmZGTElQZNLnB_LrSTIpw');
        
        // Convert the JSON to an array
        $geo = json_decode($geo, true);
        
        if ($geo['status'] == 'OK') {          
            var_dump($geo['results'][0]);
          $returnVal= array($geo['results'][0]['geometry']['location']['lat'],$geo['results'][0]['geometry']['location']['lng']);
        }
        
        return $returnVal;
    }
    
    
}

class importer{
    public function main(){
        $con = mysqli_connect("localhost","root","","ertragskarte");

        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $json = file_get_contents("locs.json");
        $arr=json_decode($json);
        
        foreach($arr as $key => $val){
            
            if($val[1]->pos){
                $sql="UPDATE tx_ertragskarte_domain_model_regions SET lng=".$val[1]->pos[1].",ltd=".$val[1]->pos[0]." WHERE title LIKE '".$val[0]."'";
                
                $result=mysqli_query($con,$sql);
            }
            

            
        }
    }
}

$parser = new parser();
$parser->main();

$importer = new importer();
$importer->main();