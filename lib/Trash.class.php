<?php 

class Trash {

    public static $days  = array(4=>'style="color:#653208"');

    public function getTrash(){
        $return = "";
        $day = date('w');        
        if(!empty(Trash::$days[$day])) {
            $return = Trash::$days[$day];
        }

        if(empty($return)) {
            return $return;
        }

        $html = '<div class="position-absolute top-0 start-0"> <span '.$return.'><i class="fas fa-trash fa-3x"></i></span></div>';

        return $html;
    }
}