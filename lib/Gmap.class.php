<?php

class Gmap
{
    private $origin = "224 route de l'église, 74250 Bogève";
    private $traffics;
    private $gmap_url = "https://maps.googleapis.com/maps/api/distancematrix/json";
    private $gcal_url = "https://www.googleapis.com/calendar/v3/calendars/thomaroger%40gmail.com/events?orderBy=startTime&singleEvents=true";
    private $gcal_url_aurelie = "https://www.googleapis.com/calendar/v3/calendars/laporte.aurelie91%40gmail.com/events?orderBy=startTime&singleEvents=true";
    public function __construct() {
        $traffics = array();

        $nextEvent = $this->getNextEvent($this->gcal_url);
        if(!empty($nextEvent)) {
             $traffics[] = array(
                "name" => $nextEvent['name'],
                "adress" => $nextEvent['adress'],
                "distance" => 0,
                "duration" => 0,
                "extra_duration" => "+ 0 min",
                "status" => "list-group-item-success",
            );
        }

        $nextEvent = $this->getNextEvent($this->gcal_url_aurelie);
        if(!empty($nextEvent)) {
             $traffics[] = array(
                "name" => $nextEvent['name'],
                "adress" => $nextEvent['adress'],
                "distance" => 0,
                "duration" => 0,
                "extra_duration" => "+ 0 min",
                "status" => "list-group-item-success",
            );
        }

        $traffics[] = array(
            "name" => 'KTB',
            "adress" => "Kiss The Bride, Allée des Frènes, Limonest",
            "distance" => 0,
            "duration" => 0,
            "extra_duration" => "+ 0 min",
            "status" => "list-group-item-success",
        );
        $traffics[] = array(
            "name" => 'Ecole',
            "adress" => "Ecole Primaire, 88 chemin des écoliers, 74250 Bogève",
            "distance" => 0,
            "duration" => 0,
            "extra_duration" => "+ 0 min",
            "status" => "list-group-item-success",

        );
        $traffics[] = array(
            "name" => 'Manue',
            "adress" => "28 Rue Perquel, 95160 Montmorency",
            "distance" => 0,
            "duration" => 0,
            "extra_duration" => "+ 0 min",
            "status" => "list-group-item-success",

        );
        $traffics[] = array(
            "name" => 'Voisenon',
            "adress" => "8 impasse des lys, 77950 Voisenon",
            "distance" => 0,
            "duration" => 0,
            "extra_duration" => "+ 0 min",
            "status" => "list-group-item-success",

        );
        $traffics[] = array(
            "name" => 'Mathieu',
            "adress" => "2 Place Charles Peguy, 77330 Ozoir-la-Ferrière",
            "distance" => 0,
            "duration" => 0,
            "extra_duration" => "+ 0 min",
            "status" => "list-group-item-success",

        );
        $traffics[] = array(
            "name" => 'La Darbella',
            "adress" => "423 Route de la Darbella, 39220 Prémanon",
            "distance" => 0,
            "duration" => 0,
            "extra_duration" => "+ 0 min",
            "status" => "list-group-item-danger",

        );
        $traffics[] = array(
            "name" => 'Saint Martin de Londres',
            "adress" => "4 Rue des Chênes, 34380 Saint-Martin-de-Londres",
            "distance" => 0,
            "duration" => 0,
            "extra_duration" => "+ 0 min",
            "status" => "list-group-item-success",

        );
        $traffics[] = array(
            "name" => 'Sorède',
            "adress" => "24 Rue de Vell Roure, Sorède",
            "distance" => 0,
            "duration" => 0,
            "extra_duration" => "+ 0 min",
            "status" => "list-group-item-success",
        );
        $this->traffics = $traffics;

        $this->gmap_url .= "?departure_time=now&origins=".urlencode($this->origin)."&key=".getenv("GMAP_KEY")."&destinations=";
    }

    public function getTraffics() {

        foreach ($this->traffics as $key => $traffic) {

            if (empty($traffic['adress'])) {
                continue;
            }

            $gmap_url = $this->gmap_url.urlencode($traffic['adress']);
            $ch = curl_init($gmap_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $result = json_decode(curl_exec($ch), true); 
            if(empty($result['rows'][0])) {
                continue;
            }

            if ($result['rows'][0]['elements'][0]['status'] == 'ZERO_RESULTS') {
                unset($this->traffics[$key]);
                continue;
            }

            $this->traffics[$key]["distance"]= $result['rows'][0]['elements'][0]['distance']['text'];
            $this->traffics[$key]["duration"]= $this->translate($result['rows'][0]['elements'][0]['duration']['text']);

            if(!empty($result['rows'][0]['elements'][0]['duration_in_traffic'])) {
              $diff = round(($result['rows'][0]['elements'][0]['duration_in_traffic']['value']-$result['rows'][0]['elements'][0]['duration']['value']) / 60);  
              if ($diff > 0) {
                $this->traffics[$key]["status"] = "list-group-item-danger";
                $this->traffics[$key]["extra_duration"] = "+ ".$diff ." min";
                $this->traffics[$key]["duration"]= $this->translate($result['rows'][0]['elements'][0]['duration_in_traffic']['text']);
              }
            }
        }

        return $this->traffics;
    }

    public function getNextEvent($gcal_url) 
    {
        $gcalUrl = $gcal_url.'&key='.getenv('GMAP_KEY').'&timeMin='.urlencode(date('c'));
        $data = array();
        $ch = curl_init($gcalUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $result = json_decode(curl_exec($ch), true); 
        if(empty($result['items'][0]['location'])) {
            return $data;
        }

        $data = array('name'=>$result['items'][0]['summary'], 'adress'=>$result['items'][0]['location']);
        
        return $data;
    }

    public function translate($string) 
    {
        return str_replace(array("hours","hour","mins"), array('h','h', 'min'), $string);
    }


    public function render()
    {
        $traffics = $this->getTraffics();
        if(empty($traffics)) {
            return '';
        }
        $html = '';
        $html = '<div class="card"><div class="card-header"> <h3><i class="fas fa-car"></i>Trafic</h3></div><div class="card-body text-dark text-center"><ul class="list-group list-group-flush text-center">';
        //$html .= '<li class="list-group-item list-group-item-success"><i class="fas fa-home"></i> vers prochain evenement (titre) : x min (+ 0 min) - x,x km</li>';

        foreach ($traffics as $traffic) {
            $html .='<li class="list-group-item '.$traffic['status'].'"><i class="fas fa-home"></i> vers '.$traffic['name'].' : '. $traffic['duration'].'('.$traffic['extra_duration'].') - '.$traffic['distance'].'</li>';
        }
        $html .= '</ul></div></div>'; 

        return $html;
    }
}