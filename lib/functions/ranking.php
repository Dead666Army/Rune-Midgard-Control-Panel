<?php
    function getLastWoeDate()
    {
        $woeDay = 'Sunday';
        $woe_date = new DateTime('last '.$woeDay);
        if ( date('l') == $woeDay && date('H') >= 21) //include today
        {
            $woe_date = new DateTime('today');
        }
        return $woe_date;
    }
    function searchForId($id, $array) {
        foreach ($array as $struct) {
            if ($struct->id == $id) {
                return true;
            }
        }
        return false;
     }
?>
