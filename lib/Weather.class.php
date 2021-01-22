<?php

class Weather {
    private $data;
    private $url = "https://api.openweathermap.org/data/2.5/onecall?lat=48.6131&lon=2.49586&exclude=current,minutely,hourly,alerts&units=metric&lang=fr&cnt=16&appid=";

    public function __construct() {

        $owm_url = $this->url.getenv('OWM_KEY');
        $ch = curl_init($owm_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $this->data = json_decode(curl_exec($ch), true); 
    }


    public  function getData()
    {
        $icons = array(
            '01d'=>'<i class="fas fa-sun fa-2x"></i>',
            '02d'=>'<i class="fas fa-cloud-sun fa-2x"></i>',
            '03d'=>'<i class="fas fa-cloud fa-2x"></i>',
            '04d'=>'<i class="fas fa-cloud fa-2x"></i>',
            '09d'=>'<i class="fas fa-cloud-showers-heavyfa-2x "></i>',
            '10d'=>'<i class="fas fa-cloud-rain fa-2x"></i>',
            '11d'=>'<i class="fas fa-bolt fa-2x"></i>',
            '13d'=>'<i class="fas fa-snowflake fa-2x"></i>',
            '50d'=>'<i class="fas fa-smog fa-2x"></i>',
        );

        $weather = array();
        foreach ($this->data['daily'] as $k=>$weatherByDay) {
            if ($k >= 3) {
                continue;
            }
            $weather[$k]= array();
            $weather[$k]['rain_mn'] = 0;
            $weather[$k]['icon']= $icons[$weatherByDay['weather'][0]['icon']];

            $date = new DateTime();
            $date->setTimestamp($weatherByDay['dt']);
            $weather[$k]['date'] = $date->format('d/m');

            $weather[$k]['description']= ucfirst($weatherByDay['weather'][0]['description']);
            $weather[$k]['temp_min']= str_replace('.',',',round($weatherByDay['temp']['min'],1));
            $weather[$k]['temp_max']= str_replace('.',',',round($weatherByDay['temp']['max'],1));
            if(!empty($weatherByDay['snow'])) {
                $weather[$k]['rain_mn'] += str_replace('.',',',round($weatherByDay['snow'],0));
            }
            if(!empty($weatherByDay['rain'])) {
                $weather[$k]['rain_mn'] += str_replace('.',',',round($weatherByDay['rain'],0));
            }
            $weather[$k]['wind']= str_replace('.',',',round($weatherByDay['wind_speed']*3.6));

        }

        return $weather;
    }

    public function render() {
        $weathertab = $this->getData();

        $html = '<div class="row">';
        foreach ($weathertab as $weather) {
             $html .= '<div class="col-md-4 themed-grid-col"><div class="card text-center"><div class="card-header">'.$weather["date"].'</div><div class="card-body"><h5 class="card-title">'.$weather["icon"].'</h5><p class="card-text">'.$weather["description"];
             if(!empty($weather['rain_mn'])) {
                $html .= ' ('.$weather['rain_mn'].' mm)';
             }
             $html .='</p></div><div class="card-footer text-muted"><div class="row"><div class="col-md-4 text-start"><i class="fas fa-temperature-low"></i> '.$weather["temp_min"].'°</div><div class="col-md-4 text-start"><i class="fas fa-wind"></i> '.$weather["wind"].' km/h</div><div class="col-md-4 text-end"><i class="fas fa-temperature-high"></i> '.$weather["temp_max"].'°</div></div></div></div></div>';
         } 
        $html .= '</div>';

        return $html;
    }
}