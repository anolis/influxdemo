<?php

$config_file = 'base.conf';
$config_dir = './configs/';
$config_data = array();

//perform get/post operations
if(isset($_GET['a']) && isset($_POST['p'])){
    $action = $_GET['a'];
    $param = $_POST['p'];

    switch($action){
        
        //returns the value of a setting to the front end in json
        case 'getParam':
            if(sizeof($param) <= 16){//perform a simple sanity check on input data
                
                $value = getParamVal($param);
                
                //create json output data
                $output = array();
                
                $output['setting'] = $param;
                $output['value'] = $value;
                $setting = parseSetting($value);
                $output['phpvalue'] = $setting;
                $output['datatype'] = gettype($setting);
                
                //set json output type
                header('Content-Type: application/json');
                echo json_encode($output);
            }
            
            break;
        default:
            echo('no setting selected.');
            break;
    }
}

//reads the config file
function readConfig($config_file = 'base.conf'){
    $fullpath = $config_dir . $config_file;
    is_file($fullpath);
    $config_raw = file_get_contents($fullpath);
    $config_raw = explode("\n", $config_raw);
    
    //extract the key/value pair from each valid config row
    //skip the bad ones
    foreach($config_raw as $config_row){
        $setting = explode("=", $config_row);
        $setting[0] = trim($setting[0]);
        
        //this is a comment .. skip
        if(substr($setting[0], 0,1) == "#") continue;
        
        //this is a corrupt line, skip
        if(!preg_match('/^[A-z]+$/', $setting[0])) continue;
        
        //if all is good, add the setting to the config_data array
        $config_data["$setting[0]"] = $setting[1];
    }
    
    //filter out empty array k/v's
    $config_data = array_filter($config_data);
    return $config_data;
}

//this function will normalize setting data, 
//int strings become ints.. 
//float strings become floats.. 
//boolean strings become booleans
function parseSetting($setting){
    
    //clean up input
    $setting = trim(strtolower($setting));
    
    //handle numbers
    if(is_numeric($setting)){
        $setting+=0;
        //handle ints
        if(is_int($setting)) $setting = (int)$setting;
    
        //handle floats
        if(is_float($setting)) $setting = (float)$setting;
    }
    
    //handle bools
    switch($setting){
        case "yes": 
            $setting = true;
            break;
        case "true":
            $setting = true;
            break;
        case "on":
            $setting = true;
            break;
        case "no":
            $setting = false;
            break;
        case "false":
            $setting = false;
            break;
        case "off":
            $setting = false;
            break;
            
    }
    
    return $setting;

}

//Default load of rc.php renders the page and inserts tmplt vars

//outputs html formatted 
function getParamNames(){
    
    $html_output = '';
    $config_data = readConfig();
    
    // var_dump($config_data);
    
    foreach($config_data as $sname => $sval){
        $html_output .= "<option>" . $sname . "</option>";
    }
    
    echo $html_output;
    
}

//returns the value of any config parameter
function getParamVal($param){
    $config_data = readConfig();
    
    if(key_exists($param, $config_data)) {
        return $config_data[$param];
    }
}




?>
