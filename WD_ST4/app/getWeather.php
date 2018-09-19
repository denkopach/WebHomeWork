<?php 
$maxCountForecast = 6;
$API = 'uQ7lYepuglkbEO6UZ7KP9CVZGVlZCOdP';
$CITY_CODE = '324291';
$JSON_PATH = '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'today.json';

if (isset($_POST['getWeather'])) {
	if ($_POST['getWeather'] === 'getFromAPI') {
		$obj = json_decode(file_get_contents("http://dataservice.accuweather.com/forecasts/v1/hourly/12hour/${CITY_CODE}?apikey=${API}"));
		
        $icons = [
            'cloud' => '/^[7-9]$|1[01]|30|32/',
            'flash' => '/1[5-7]|4[1-2]/',
            'rain' => '/1[23489]|2[0-9]|39|4[034]/',
            'sun' => '/^[1-5]$|3[3-7]/',
            'sun-cloud' => '/^6$|38/'
        ];
		foreach ($obj as $key => $value) {
        	$res[] = [
        			'time' => $value->EpochDateTime,
					'temperature' => round(($value->Temperature->Value - 32) * 5 / 9),
					'icon' => key(array_filter($icons, function($val) use ($value) {
						return preg_match($val, $value->WeatherIcon);
					})),
        	];
        	if($key >= $maxCountForecast) {
        		break;
        	}
        }
		echo json_encode($res);
	}

	if ($_POST['getWeather'] === 'getFromJSON') {
		$obj = json_decode(file_get_contents($JSON_PATH));
		$icons = [
			'Clear' => 'sun',
			'Clouds' => 'sky',
			'Rain' => 'rain',
		];
		$flag = false;
		$flagCheck = true;
		$keyFlag = 0;
		foreach ($obj->list as $key => $value) {
			$nowHour = date('H', 10800 * round(time() / 10800));
			$hourItems = date('H', $value->dt);
			if ($flagCheck && $nowHour === $hourItems) {
				$flagCheck = false;
				$flag = true;
			}
			if ($flag) {
				$keyFlag++;
				$res[] = [
						'time' => $value->dt,
						'temperature' => round($value->main->temp) - 273,
						'icon' => $icons[$value->weather[0]->main],
				];
			}
			if ($keyFlag > $maxCountForecast) {
				$flag = false;
			}
			
		}
		echo json_encode($res);
	}

	if ($_POST['getWeather'] === 'getFromDatabase') {
	    $params = [
	    	    'host' => 'localhost',
			    'dbname' => 'weather',
			    'user' => 'root',
			    'password' => '',
	    ];
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password'], array(PDO::ATTR_PERSISTENT => true));
        $db->exec("set names utf8");

        $sql = 'SELECT UNIX_TIMESTAMP(forecast.timestamp), temperature, rain_possibility, clouds FROM forecast';
        $result = $db->prepare($sql);
        $result->execute();

        $resp = $result->fetchAll();

        foreach ($resp as $key => $value) {
        	if ($value[2] > 0.6) {
        		$icon = 'rain';
        	} elseif ($value[3] < 15) {
        		$icon = 'sun';
        	} elseif ($value[3] > 15 && $value[3] < 20) {
        		$icon = 'sky';
        	} else {
        		$icon = 'sky-1';
        	}
        	$res[] = [
        			'time' => $value[0],
					'temperature' => $value[1],
					'icon' => $icon,
        	];
        }
		echo json_encode($res);
	}
}