<?php

include('ForecastInterface.php');

class ForecastAdapter implements ForecastInterface
{
    private $icons;

    public function __construct()
    {
        $this->icons = include(APP_PATH . 'icons.php');
    }

    public function get($weather)
    {
        include('TemperatureConverter.php');
        if ($weather[0]->EpochDateTime) {
            return $this->adapterAPI($weather);
        }
        if ($weather[0]->dt) {
            return $this->adapterJSON($weather);
        }
        if ($weather[0]['rain_possibility']) {
            return $this->adapterDB($weather);
        }
    }

    private function adapterAPI($weather)
    {
        return json_encode(array_map(function ($weatherForHour) {
            $iconId = $weatherForHour->WeatherIcon;
            $icon = $this->icons['rain'];
            if ($iconId >= 1 && $iconId <= 5 || $iconId >= 33 && $iconId <= 37) {
                $icon = $this->icons['sun'];
            }

            if ($iconId === 38 || $iconId === 6) {
                $icon = $this->icons['sunCloud'];
            }

            if ($iconId >= 15 && $iconId <= 17 || $iconId === 41 || $iconId === 42) {
                $icon = $this->icons['flash'];
            }

            if ($iconId >= 7 && $iconId <= 11 || $iconId === 30 || $iconId === 32) {
                $icon = $this->icons['cloud'];
            }
            return [
                'time' => $weatherForHour->EpochDateTime,
                'temperature' => TemperatureConverter::fahrenheitToCelsius($weatherForHour->Temperature->Value),
                'icon' => $icon
            ];
        }, $weather));
    }

    private function adapterJSON($weather)
    {
        return json_encode(array_map(function ($weatherForHour) {
            $iconId = $weatherForHour->weather[0]->main;
            $cloudValue = $weatherForHour->clouds->all;
            $icon = $this->icons['flash'];
            if ($iconId === 'Clear' && $cloudValue < 10) {
                $icon = $this->icons['sun'];
            }

            if ($iconId === 'Clear' && $cloudValue >= 10) {
                $icon = $this->icons['sunCloud'];
            }

            if ($iconId === 'Clouds') {
                $icon = $this->icons['cloud'];
            }

            if ($iconId === 'Rain') {
                $icon = $this->icons['rain'];
            }

            return [
                'time' => $weatherForHour->dt,
                'temperature' => TemperatureConverter::kelvinToCelsius($weatherForHour->main->temp),
                'icon' => $icon,
            ];
        }, $weather));
    }

    private function adapterDB($weather)
    {
        return json_encode(array_map(function ($weatherForHour) {
            $icon = $this->icons['sun'];
            if ($weatherForHour['rain_possibility'] >= 0.8) {
                $icon = $this->icons['rain'];
            }

            if ($weatherForHour['clouds'] > 15) {
                $icon = $this->icons['sunCloud'];
            }
            $weatherForHour['icon'] = $icon;
            return $weatherForHour;
        }, $weather));
    }
}