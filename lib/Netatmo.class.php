<?php 
class Netatmo 
{
  private $tokens;
  private $client;

   public function __construct()
   {
      $scope = Netatmo\Common\NAScopes::SCOPE_READ_STATION;
      $config = array("client_id" => getenv('NETATMO_CLIENT_ID'),
                      "client_secret" => getenv('NETATMO_CLIENT_SECRET'),
                      "username" => getenv('NETATMO_USERNAME'),
                      "password" => getenv('NETATMO_PASSWORD'));

      $this->client = new Netatmo\Clients\NAWSApiClient($config);
      $this->tokens = $this->client->getAccessToken();
   }

    public function getData()
    {
      return $this->client->getData(NULL, TRUE);

    }

    public function format($data)
    {
        $return = array();
        $return['ext'] = array();
        $return['salon'] = array();
        $return['chambre'] = array();

        foreach ($data['devices'] as $device) {
          if($device['type'] == 'NAMain') {
            // main
            $return['ext']['Pressure'] = str_replace('.',',',$device['dashboard_data']['Pressure']);

            $return['salon']['temperature'] = str_replace('.',',',$device['dashboard_data']['Temperature']);
            $return['salon']['tmp_trend'] = 'arrow-'.$device['dashboard_data']['temp_trend'];
            if ($device['dashboard_data']['temp_trend'] == 'stable') {
              $return['salon']['tmp_trend'] = 'equals';
            }
            $return['salon']['CO2'] = $device['dashboard_data']['CO2'];
            $return['salon']['typeco'] = $this->getStatusCO($device['dashboard_data']['CO2']);
            $return['salon']['Noise'] = $device['dashboard_data']['Noise'];
            $return['salon']['Humidity'] = $device['dashboard_data']['Humidity'];
            $return['salon']['min_temp'] = str_replace('.',',',$device['dashboard_data']['min_temp']);
            $return['salon']['max_temp'] = str_replace('.',',',$device['dashboard_data']['max_temp']);

            $date = new DateTime();
            $date->setTimestamp($device['dashboard_data']['date_min_temp']);
            $return['salon']['date_min_temp'] = $date->format('d/m/Y H:i');
            $date = new DateTime();
            $date->setTimestamp($device['dashboard_data']['date_max_temp']);
            $return['salon']['date_max_temp'] = $date->format('d/m/Y H:i');

            $return['salon']['battery_percent'] =  '100';


            foreach ($device['modules'] as $module) {
                if ($module['type'] == 'NAModule4') {
                    $return['chambre']['temperature'] = str_replace('.',',',$module['dashboard_data']['Temperature']);
                    $return['chambre']['tmp_trend'] = 'arrow-'.$module['dashboard_data']['temp_trend'];
                    $return['chambre']['CO2'] = $module['dashboard_data']['CO2'];
                    $return['chambre']['typeco'] = $this->getStatusCO($module['dashboard_data']['CO2']);
                    $return['chambre']['Humidity'] = $module['dashboard_data']['Humidity'];
                    $return['chambre']['min_temp'] = str_replace('.',',',$module['dashboard_data']['min_temp']);
                    $return['chambre']['max_temp'] = str_replace('.',',',$module['dashboard_data']['max_temp']);
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
                    $return['ext']['tmp_trend'] = 'arrow-'.$module['dashboard_data']['temp_trend'];
                     if ($device['dashboard_data']['temp_trend'] == 'stable') {
                        $return['ext']['tmp_trend'] = 'equals';
                      }
                    $return['ext']['Humidity'] = $module['dashboard_data']['Humidity'];
                    $return['ext']['min_temp'] = str_replace('.',',',$module['dashboard_data']['min_temp']);
                    $return['ext']['max_temp'] = str_replace('.',',',$module['dashboard_data']['max_temp']);
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
                    <li class="list-group-item"><h3>Température : '.$return['ext']['temperature'].'° <i class="fas fa-'.$return['ext']['tmp_trend'].'"></i></h3></li>
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
                    <div class="col-md-12 text-start"><h3><i class="fas fa-utensils"></i> Salon </h3></div>
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
                    <li class="list-group-item"><h3><i class="fas fa-thermometer-quarter"></i> '.$return['salon']['temperature'].'° <i class="fas fa-'.$return['salon']['tmp_trend'].'"></i> </h3></li>
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
                    <li class="list-group-item"><h3><i class="fas fa-thermometer-quarter"></i> '.$return['chambre']['temperature'].'° <i class="fas fa-'.$return['chambre']['tmp_trend'].'"></i></h3></li>
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