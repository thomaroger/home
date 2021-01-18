<?php 

class Trash {

    public static $days  = array(0=>'class="text-success"',
                                 1=>'class="text-warning"',
                                 2=>'style="color:#653208"',
                                 5=>'style="color:#653208"');

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