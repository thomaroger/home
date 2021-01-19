<?php 
class Netatmo 
{
    public function getData()
    {
      return '{"body":{"devices":[{"_id":"70:ee:50:22:a3:00","date_setup":1435834348,"last_setup":1435834348,"type":"NAMain","last_status_store":1555677748,"module_name":"Indoor","firmware":137,"last_upgrade":1512405614,"wifi_status":55,"reachable":true,"co2_calibrating":false,"station_name":"Casa","data_type":["string"],"place":{"timezone":"Africa/Lagos","country":"EG","altitude":144,"location":["30.89600807058707, 29.94281464724796"]},"read_only":true,"home_id":"594xxxxxxxxxdb","home_name":"Home","dashboard_data":{"time_utc":1555677739,"Temperature":23.7,"CO2":967,"Humidity":41,"Noise":42,"Pressure":997.6,"AbsolutePressure":1017.4,"min_temp":21.2,"max_temp":27.4,"date_min_temp":1555631374,"date_max_temp":1555662436,"temp_trend":"up","pressure_trend":"up"},"modules":[{"oneOf":[{"_id":"06:00:00:02:47:00","type":"NAModule4","module_name":"Indoor Module","data_type":["Temperature, Humidity, CO2"],"last_setup":1435834348,"reachable":true,"dashboard_data":{"time_utc":1555677739,"Temperature":23.7,"CO2":967,"Humidity":41,"Pressure":997.6,"AbsolutePressure":1017.4,"min_temp":21.2,"max_temp":27.4,"date_min_temp":1555631374,"date_max_temp":1555662436,"temp_trend":"up"},"firmware":19,"last_message":1555677746,"last_seen":1555677746,"rf_status":31,"battery_vp":5148,"battery_percent":58},{"_id":"06:00:00:02:47:00","type":"NAModule1","module_name":"Outdoor Module","data_type":["Temperature, Humidity"],"last_setup":1435834348,"reachable":true,"dashboard_data":{"time_utc":1555677739,"Temperature":23.7,"Humidity":41,"min_temp":21.2,"max_temp":27.4,"date_min_temp":1555631374,"date_max_temp":1555662436,"temp_trend":"up"},"firmware":19,"last_message":1555677746,"last_seen":1555677746,"rf_status":31,"battery_vp":5148,"battery_percent":58},{"_id":"06:00:00:02:47:00","type":"NAModule3","module_name":"Rain gauge","data_type":["Rain"],"last_setup":1435834348,"reachable":true,"dashboard_data":{"time_utc":1555677734,"Rain":0,"sum_rain_24":0,"sum_rain_1":0},"firmware":19,"last_message":1555677746,"last_seen":1555677746,"rf_status":31,"battery_vp":5148,"battery_percent":58},{"_id":"06:00:00:02:47:00","type":"NAModule2","module_name":"Wind Module","data_type":["Wind"],"last_setup":1435834348,"battery_percent":58,"reachable":true,"firmware":19,"last_message":1555677746,"last_seen":1555677746,"rf_status":31,"battery_vp":5148,"dashboard_data":{"time_utc":1555677734,"WindStrength":2,"WindAngle":75,"GustStrength":3,"GustAngle":75,"max_wind_str":4,"max_wind_angle":100,"date_max_wind_str":1555673190}}]}]}],"user":{"mail":"name@mail.com","administrative":{"reg_locale":"fr-FR","lang":"fr-FR","country":"FR","unit":0,"windunit":0,"pressureunit":0,"feel_like_algo":0}}},"status":"ok","time_exec":"0.060059070587158","time_server":"1553777827"}';
    }

    public function format($data)
    {
        $return = array();
        $return['ext'] = array();
        $return['salon'] = array();
        $return['chambre'] = array();

        $data = json_decode($data, true);
        foreach ($data['body']['devices'] as $device) {
          if($device['type'] == 'NAMain') {
            // main
            $return['ext']['Pressure'] = str_replace('.',',',$device['dashboard_data']['Pressure']);

            $return['salon']['temperature'] = str_replace('.',',',$device['dashboard_data']['Temperature']);
            $return['salon']['temperature'] = '21,4';
            $return['salon']['tmp_trend'] = $device['dashboard_data']['temp_trend'];
            $return['salon']['CO2'] = $device['dashboard_data']['CO2'];
            $return['salon']['typeco'] = $this->getStatusCO($device['dashboard_data']['CO2']);
            $return['salon']['Noise'] = $device['dashboard_data']['Noise'];
            $return['salon']['Humidity'] = $device['dashboard_data']['Humidity'];
            $return['salon']['Humidity'] = '41';
            $return['salon']['min_temp'] = str_replace('.',',',$device['dashboard_data']['min_temp']);
            $return['salon']['min_temp'] = '18,5';
            $return['salon']['max_temp'] = str_replace('.',',',$device['dashboard_data']['max_temp']);
            $return['salon']['max_temp'] = '27,8';

            $date = new DateTime();
            $date->setTimestamp($device['dashboard_data']['date_min_temp']);
            $return['salon']['date_min_temp'] = $date->format('d/m/Y H:i');
            $date = new DateTime();
            $date->setTimestamp($device['dashboard_data']['date_max_temp']);
            $return['salon']['date_max_temp'] = $date->format('d/m/Y H:i');

            $return['salon']['battery_percent'] =  '100';


            foreach ($device['modules'][0]['oneOf'] as $module) {
                if ($module['type'] == 'NAModule4') {
                  //Module ADD
                    $return['chambre']['temperature'] = str_replace('.',',',$module['dashboard_data']['Temperature']);
                    $return['chambre']['temperature'] = '16,6';
                    $return['chambre']['tmp_trend'] = $module['dashboard_data']['temp_trend'];
                    $return['chambre']['CO2'] = $module['dashboard_data']['CO2'];
                    $return['chambre']['typeco'] = $this->getStatusCO($module['dashboard_data']['CO2']);
                    $return['chambre']['Humidity'] = $module['dashboard_data']['Humidity'];
                    $return['chambre']['Humidity'] = '52';
                    $return['chambre']['min_temp'] = str_replace('.',',',$module['dashboard_data']['min_temp']);
                    $return['chambre']['min_temp'] = '14,6';
                    $return['chambre']['max_temp'] = str_replace('.',',',$module['dashboard_data']['max_temp']);
                    $return['chambre']['max_temp'] = '21,0';
                    $return['chambre']['battery_percent'] =  $module['battery_percent'];

                    $date = new DateTime();
                    $date->setTimestamp($module['dashboard_data']['date_min_temp']);
                    $return['chambre']['date_min_temp'] = $date->format('d/m/Y H:i');
                    $date = new DateTime();
                    $date->setTimestamp($module['dashboard_data']['date_max_temp']);
                    $return['chambre']['date_max_temp'] = $date->format('d/m/Y H:i');
                }
                if ($module['type'] == 'NAModule1') {
                  // EXT
                    $return['ext']['temperature'] = str_replace('.',',',$module['dashboard_data']['Temperature']);
                    $return['ext']['tmp_trend'] = $module['dashboard_data']['temp_trend'];
                    $return['ext']['Humidity'] = $module['dashboard_data']['Humidity'];
                    $return['ext']['min_temp'] = str_replace('.',',',$module['dashboard_data']['min_temp']);
                    $return['ext']['min_temp'] = '-6,8';
                    $return['ext']['max_temp'] = str_replace('.',',',$module['dashboard_data']['max_temp']);
                    $return['ext']['max_temp'] = '34,8';
                    $date = new DateTime();
                    $date->setTimestamp($module['dashboard_data']['date_min_temp']);
                    $return['ext']['date_min_temp'] = $date->format('d/m/Y H:i');
                    $date = new DateTime();
                    $date->setTimestamp($module['dashboard_data']['date_max_temp']);
                    $return['ext']['date_max_temp'] = $date->format('d/m/Y H:i');
                    $return['ext']['battery_percent'] =  $module['battery_percent'];
                }
            }
          }
        }
        return $return;
    }

    public function getStatusCO($co)
    {
      $status = 'bg-danger';
      if ($co<1500) {
        $status = 'bg-warning';
      }
      if ($co<1000) {
        $status = 'bg-success';
      }
      return $status;
    }


    public function render()
    {
        $return = $this->format($this->getData());


        return '
           <div class="card border-dark">
              <div class="card-header">
                  <div class="row">
                    <div class="col-md-9 text-start"><h3><i class="fas fa-umbrella-beach "></i> Extérieur </h3></div>
                    <div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> '.$return['ext']['battery_percent'].'%</p></div>
                  </div>
              </div>
              <div class="card-body text-dark">
                  <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><h3>Température : '.$return['ext']['temperature'].'° <i class="fas fa-arrow-'.$return['ext']['tmp_trend'].'"></i></h3></li>
                    <li class="list-group-item">Humidité : '.$return['ext']['Humidity'].'%</li>
                    <li class="list-group-item">Pression : '.$return['ext']['Pressure'].' Hpa</li>
                  </ul>
              </div>
                <div class="card-footer text-muted">
                  <div class="row">
                  <div class="col-md-6 text-start"><i class="fas fa-temperature-low"></i> '.$return['ext']['min_temp'].'° ('.$return['ext']['date_min_temp'].')</div>
                  <div class="col-md-6 text-end"><i class="fas fa-temperature-high"></i> '.$return['ext']['max_temp'].'° ('.$return['ext']['date_max_temp'].')</div>
                  </div>
                </div>
            </div>

            <div class="card border-dark">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-9 text-start"><h3><i class="fas fa-utensils"></i> Salon </h3></div>
                    <div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> '.$return['salon']['battery_percent'].'%</p></div>
                  </div>
                </div>
              <div class="card-body text-dark">
                <div class="row">
                  <div class="col-md-3">
                      <span class="badge rounded-pill '.$return['salon']['typeco'].'" style="height: 100%;width: 100%;">
                        <table style="height: 100%;width: 100%;">
                          <tbody>
                            <tr>
                              <td class="align-middle"><h1>'.$return['salon']['CO2'].'</h1>ppm</td>
                            </tr>
                          </tbody>
                        </table>
                      </span>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><h3><i class="fas fa-thermometer-quarter"></i> '.$return['salon']['temperature'].'° <i class="fas fa-arrow-'.$return['salon']['tmp_trend'].'"></i> </h3></li>
                    <li class="list-group-item">Humidité : '.$return['salon']['Humidity'].'%</li>
                    <li class="list-group-item">Bruit : '.$return['salon']['Noise'].' dB</li>
                  </ul>
                  </div>
                </div>
                </div>
                <div class="card-footer text-muted">
                  <div class="row">
                  <div class="col-md-6 text-start"><i class="fas fa-temperature-low"></i> '.$return['salon']['min_temp'].'° ('.$return['salon']['date_min_temp'].')</div>
                  <div class="col-md-6 text-end"><i class="fas fa-temperature-high"></i> '.$return['salon']['max_temp'].'° ('.$return['salon']['date_max_temp'].')</div>
                  </div>
                </div>
            </div>

            <div class="card border-dark">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-9 text-start"><h3><i class="fas fa-bed"></i> Chambre </h3></div>
                    <div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> '.$return['chambre']['battery_percent'].'%</p></div>
                  </div>
                </div>
              <div class="card-body text-dark">
                <div class="row">
                  <div class="col-md-3">
                      <span class="badge rounded-pill '.$return['chambre']['typeco'].'" style="height: 100%;width: 100%;">
                        <table style="height: 100%;width: 100%;">
                          <tbody>
                            <tr>
                              <td class="align-middle"><h1>'.$return['chambre']['CO2'].'</h1>ppm</td>
                            </tr>
                          </tbody>
                        </table>
                      </span>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><h3><i class="fas fa-thermometer-quarter"></i> '.$return['chambre']['temperature'].'° <i class="fas fa-arrow-'.$return['chambre']['tmp_trend'].'"></i></h3></li>
                    <li class="list-group-item">Humidité : '.$return['chambre']['Humidity'].'%</li>
                  </ul>
                  </div>
                </div>
                </div>
                <div class="card-footer text-muted">
                  <div class="row">
                  <div class="col-md-6 text-start"><i class="fas fa-temperature-low"></i> '.$return['chambre']['min_temp'].'° ('.$return['chambre']['date_min_temp'].')</div>
                  <div class="col-md-6 text-end"><i class="fas fa-temperature-high"></i> '.$return['chambre']['max_temp'].'° ('.$return['chambre']['date_max_temp'].')</div>
                  </div>
                </div>
            </div>';

    }
}