<?php
    ini_set('memory_limit','250M');

    $base_url = "http://api.openweathermap.org/data/2.5/forecast?id=";

    $api_key = "&units=imperial&APPID={myAPIid}";

    /*Weekdays*/
    function weekday(){
                
        $weekdays = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

        $daynum = array();

        $day = date("w");

        $day = intval($day);

        array_push($daynum,$day);

        while(sizeof($daynum) < 5){

            $day+=1;

            array_push($daynum,$day);

            if($day >= 6){$day -= 7;}
        }

        $currentWeek = array();

        for($i = 0; $i < 5; $i++){array_push($currentWeek,$weekdays[$daynum[$i]]);}

        return $currentWeek;
    }


    function getCityId($data_array, $cityname){

        for($i = 0; $i < sizeof($data_array); $i++){
                
            if($data_array[$i]['name'] = $cityname and $data_array[$i]['country'] = "US"){
                    
                $city_id = $data_array[$i]['id'];

                break;

            }
        }

        return $city_id;
    }


    /*Getters*/

    function getTemp($index,$array){
        return round($array["list"][$index]["main"]["temp"]);
    }

    function getMaxTemp($index,$array){
        return round($array["list"][$index+2]["main"]["temp_max"]);
    }

    function getMinTemp($index,$array){
        return round($array["list"][$index-1]["main"]["temp_min"]);
    }

    function getWindSpeed($index,$array){
        return round($array["list"][$index]["wind"]["speed"]);
    }

    function getHumidity($index,$array){
        return $array["list"][$index]["main"]["humidity"];
    }

?>
