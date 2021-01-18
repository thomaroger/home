<?php 

class Flipr {
    private $oauth = "https://apis.goflipr.com/OAuth2/token";
    private $flipr = "https://apis.goflipr.com/modules/30C8C7/survey/last";
    private $flipr_historical = "https://apis.goflipr.com/modules/30C8C7/survey/LastHours/48";
    private $access_token = null;

    public function __construct($username, $password)
    {
        $payload_token = "grant_type=password&username=".getenv('FLIPR_USER')."&password=".getenv('FLIPR_PWD');
        $ch = curl_init($this->oauth);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_token); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','cache-control : no-cache'));
        $result = json_decode(curl_exec($ch),true);
        $this->access_token = $result['access_token'];
    }
    public function getData()
    {
        $status = "bg-danger";
        $return = array();

        $ch = curl_init($this->flipr);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$this->access_token,'cache-control : no-cache'));
        $result = json_decode(curl_exec($ch),true);

        $return['temp']= str_replace('.',',',round($result['Temperature'],1));

        if($result['PH']['Message'] == 'Bon' || $result['PH']['Message'] == 'Parfait') {
            $status = "bg-success";
        }
        $return['ph']= array(
            'value' => str_replace('.',',',$result['PH']['Value']), 
            'status' => $status
        );

        $status = "bg-danger";
        if($result['Desinfectant']['Message'] == 'Bon' || $result['Desinfectant']['Message'] == 'Parfait') {
            $status = "bg-success";
        }
        $return['chlore']= array(
            'value' => $result['OxydoReductionPotentiel']['Value'], 
            'status' => $status
        );
        $return['batt']= $result['Battery']['Deviation'];
        $datetime = new DateTime($result['DateTime']);
        $return["date"] = $datetime->format('d/m/Y à H:m');
        $return["uv"] = $result['UvIndex'];

        $ch = curl_init($this->flipr_historical);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$this->access_token,'cache-control : no-cache'));
        $result = json_decode(curl_exec($ch),true);

        $return["trend"] = 'down';
        if ($return['temp'] > $result[1]['Temperature']) {
            $return["trend"] = 'up';
        }

        return $return;
    }

    public function render() {
        $pool = $this->getData();
        $html = '';
        if(empty($pool)) {
            return $html;
        }

        $html = '<div class="card border-dark"><div class="card-header"><div class="row"><div class="col-md-9 text-start"><h3><i class="fas fa-swimming-pool "></i> Piscine </h3></div><div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> '.($pool['batt']*100).'%</p></div></div></div><div class="card-body text-dark"><ul class="list-group list-group-flush text-center"><li class="list-group-item"><h3>Température : '.$pool['temp'].'° <i class="fas fa-arrow-'.$pool['trend'].'"></i></h3></li></ul><div class="row"><div class="col-md-6"><span class="badge rounded-pill '.$pool['ph']['status'].'" style="height: 100%;width: 100%;"><table style="height: 100%;width: 100%;"><tbody><tr> <td class="align-middle">PH <h1>'.$pool['ph']['value'].'</h1></td></tr></tbody></table></span></div><div class="col-md-6"><span class="badge rounded-pill '.$pool['chlore']['status'].'" style="height: 100%;width: 100%;"><table style="height: 100%;width: 100%;"><tbody><tr><td class="align-middle">Chlore<h1>'.$pool['chlore']['value'].'  mV</h1></td></tr></tbody></table></span></div></div></div><div class="card-footer text-muted"><div class="row"><div class="col-md-9 text-start"><i class="fas fa-clock"></i> Dernière mesure le '.$pool['date'].'</div><div class="col-md-3 text-end"><i class="fas fa-sun"></i> UV : '.$pool['uv'].'</div></div></div></div></div></div>';

        return $html;
    }
}