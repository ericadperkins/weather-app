<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Prata|Roboto+Condensed" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="weather.css" rel="stylesheet">
    </head>
    <body>
        <?php
            include_once("weatherlogic.php");
        ?>
        <!--header--> 
        <div class="row">
            <nav>
                <table>
                    <tr>
                        <td id="leftnav" class="navsec">
                            <h3>Weather</h3>
                        </td>
                        <td id="rightnav" class="navsec">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <input type="text" name="usercity" placeholder="<?php echo 'Enter city name'; ?>">
                                <input type="submit" name="subwbtn" id="subwbtn" onclick="clearDefault();">
                            </form>
                        </td>
                    </tr>
                </table>
            </nav>
        </div>
        
        <!--forecast-->
        <div class="row">
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['subwbtn'])){

                    $json_city_list = file_get_contents('city.list.json');

                    $city_data = json_decode($json_city_list,true);

                    $usercity = $_POST['usercity'];
            
                    $city_error = '';
            
                    $id = getCityId($city_data,$usercity);

                    if(ctype_alpha($usercity)){
                        
                        $url = $base_url . $id . $api_key;
            
                        $forecast_data = file_get_contents($url);

                        $forecast = json_decode($forecast_data,true);

                echo "
                    <div class='forecast_wrap'>
                        <div class='forecast'>
                            <div class='forecast_day'>" . weekday()[0] . "</div>
                            <div class='forecast_temp'>". getTemp(3,$forecast) ."<sup><small>&deg;</small></sup></div>
                            <div class='forecast_high'><p><b>High: </b>" .getMaxTemp(3,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_low'><p><b>Low: </b>" .getMinTemp(3,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_humid'><p><b>Humidity: </b>". getHumidity(3,$forecast) ."%</p></div>
                            <div class='forecast_wind'><b>Wind: </b>". getWindSpeed(3,$forecast) ."<small style='font-size:9px'>mph</small></div>
                        </div>
                    </div>
                    
                    <div class='forecast_wrap'>
                        <div class='forecast'>
                            <div class='forecast_day'>" . weekday()[1] . "</div>
                            <div class='forecast_temp'>". getTemp(11,$forecast) ."<sup><small>&deg;</small></sup></div>
                            <div class='forecast_high'><p><b>High: </b>" .getMaxTemp(11,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_low'><p><b>Low: </b>" .getMinTemp(11,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_humid'><p><b>Humidity: </b>". getHumidity(11,$forecast) ."%</p></div>
                            <div class='forecast_wind'><b>Wind: </b>". getWindSpeed(11,$forecast) ."<small style='font-size:9px'>mph</small></div>
                        </div>
                    </div>
                    
                    <div class='forecast_wrap'>
                        <div class='forecast'>
                            <div class='forecast_day'>" . weekday()[2] . "</div>
                            <div class='forecast_temp'>". getTemp(19,$forecast) ."<sup><small>&deg;</small></sup></div>
                            <div class='forecast_high'><p><b>High: </b>" .getMaxTemp(19,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_low'><p><b>Low: </b>" .getMinTemp(19,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_humid'><p><b>Humidity: </b>". getHumidity(19,$forecast) ."%</p></div>
                            <div class='forecast_wind'><b>Wind: </b>". getWindSpeed(19,$forecast) ."<small style='font-size:9px'>mph</small></div>
                        </div>
                    </div>
                    
                    <div class='forecast_wrap'>
                        <div class='forecast'>
                            <div class='forecast_day'>" . weekday()[3] . "</div>
                            <div class='forecast_temp'>". getTemp(27,$forecast) ."<sup><small>&deg;</small></sup></div>
                            <div class='forecast_high'><p><b>High: </b>" .getMaxTemp(27,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_low'><p><b>Low: </b>" .getMinTemp(27,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_humid'><p><b>Humidity: </b>". getHumidity(27,$forecast) ."%</p></div>
                            <div class='forecast_wind'><b>Wind: </b>". getWindSpeed(27,$forecast) ."<small style='font-size:9px'>mph</small></div>
                        </div>
                    </div>
                    
                    <div class='forecast_wrap'>
                        <div class='forecast'>
                            <div class='forecast_day'>" . weekday()[4] . "</div>
                            <div class='forecast_temp'>". getTemp(35,$forecast) ."<sup><small>&deg;</small></sup></div>
                            <div class='forecast_high'><p><b>High: </b>" .getMaxTemp(35,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_low'><p><b>Low: </b>" .getMinTemp(35,$forecast) ."<sup><small>&deg;</small></sup></p></div>
                            <div class='forecast_humid'><p><b>Humidity: </b>". getHumidity(35,$forecast) ."%</p></div>
                            <div class='forecast_wind'><b>Wind: </b>". getWindSpeed(35,$forecast) ."<small style='font-size:9px'>mph</small></div>
                        </div>
                    </div>
                ";
                    
                    }else{
            
                        $city_error = "Sorry, we couldn\'t find that city.";
            
                    }
                }
            ?>   
            <?php
                include_once("default.php");
            ?>
            <div id="default"><!--Start of random default forecast-->
            <div class='forecast_wrap'>
                <div class='forecast'>
                    <div class='forecast_day'><?php echo weekday()[0]; ?></div>
                    <div class='forecast_temp'><?php echo getTemp(3,$random_weather); ?><sup><small>&deg;</small></sup></div>
                    <div class='forecast_high'><p><b>High: </b><?php echo getMaxTemp(3,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_low'><p><b>Low: </b><?php echo getMinTemp(3,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_humid'><p><b>Humidity: </b><?php echo getHumidity(3,$random_weather); ?>%</p></div>
                    <div class='forecast_wind'><b>Wind: </b><?php echo getWindSpeed(3,$random_weather); ?><small style='font-size:9px'>mph</small></div>
                </div>
            </div>
              
            <div class='forecast_wrap'>
                <div class='forecast'>
                    <div class='forecast_day'><?php echo weekday()[1]; ?></div>
                    <div class='forecast_temp'><?php echo getTemp(11,$random_weather); ?><sup><small>&deg;</small></sup></div>
                    <div class='forecast_high'><p><b>High: </b><?php echo getMaxTemp(11,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_low'><p><b>Low: </b><?php echo getMinTemp(11,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_humid'><p><b>Humidity: </b><?php echo getHumidity(11,$random_weather); ?>%</p></div>
                    <div class='forecast_wind'><b>Wind: </b><?php echo getWindSpeed(11,$random_weather); ?><small style='font-size:9px'>mph</small></div>
                </div>
            </div>
                    
            <div class='forecast_wrap'>
                <div class='forecast'>
                    <div class='forecast_day'><?php echo weekday()[2]; ?></div>
                    <div class='forecast_temp'><?php echo getTemp(19,$random_weather); ?><sup><small>&deg;</small></sup></div>
                    <div class='forecast_high'><p><b>High: </b><?php echo getMaxTemp(19,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_low'><p><b>Low: </b><?php echo getMinTemp(19,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_humid'><p><b>Humidity: </b><?php echo getHumidity(19,$random_weather); ?>%</p></div>
                    <div class='forecast_wind'><b>Wind: </b><?php echo getWindSpeed(19,$random_weather); ?><small style='font-size:9px'>mph</small></div>
                </div>
            </div>
                    
            <div class='forecast_wrap'>
                <div class='forecast'>
                    <div class='forecast_day'><?php echo weekday()[3]; ?></div>
                    <div class='forecast_temp'><?php echo getTemp(27,$random_weather); ?><sup><small>&deg;</small></sup></div>
                    <div class='forecast_high'><p><b>High: </b><?php echo getMaxTemp(27,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_low'><p><b>Low: </b><?php echo getMinTemp(27,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_humid'><p><b>Humidity: </b><?php echo getHumidity(27,$random_weather); ?>%</p></div>
                    <div class='forecast_wind'><b>Wind: </b><?php echo getWindSpeed(27,$random_weather); ?><small style='font-size:9px'>mph</small></div>
                </div>
            </div>
                    
            <div class='forecast_wrap'>
                <div class='forecast'>
                    <div class='forecast_day'><?php echo weekday()[4]; ?></div>
                    <div class='forecast_temp'><?php echo getTemp(35,$random_weather); ?><sup><small>&deg;</small></sup></div>
                    <div class='forecast_high'><p><b>High: </b><?php echo getMaxTemp(35,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_low'><p><b>Low: </b><?php echo getMinTemp(35,$random_weather); ?><sup><small>&deg;</small></sup></p></div>
                    <div class='forecast_humid'><p><b>Humidity: </b><?php echo getHumidity(35,$random_weather); ?>%</p></div>
                    <div class='forecast_wind'><b>Wind: </b><?php echo getWindSpeed(35,$random_weather); ?><small style='font-size:9px'>mph</small></div>
                </div>
            </div>  
            </div><!--end of default wrap-->
        </div>
        <!--footer-->
        <?php
            
        ?>

        <script type="text/javascript">

            "use strict";

            var clearDefault;
            
            clearDefault = function(){
            
                var container = document.getElementById('default');

                container.innerHTML = '';

                container.style.display = 'none';
                
            }
        </script>   
    </body>
</html>