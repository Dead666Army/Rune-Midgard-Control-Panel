<?php
if (!defined('FLUX_ROOT')) {
    exit;
}

$title = "Instances Ranking";
$instances  = Flux::config('Instances')->toArray();
$instancesImages  = Flux::config('InstancesImages')->toArray();
$instanceFilter = $params->get('instanceFilter');
$rankingTypes = Flux::config('InstancesRankingTypes')->toArray();
$rankingTypesFilter = $params->get('rankingTypesFilter');
$datefilter="";

if (array_key_exists($instanceFilter, $instances)) {
    if(array_key_exists($rankingTypesFilter, $rankingTypes) && $rankingTypesFilter == "Current"){
        $dfirst = new DateTime('first day of this month');
        $dfirstFormat = $dfirst->format('Ymd');
        $dlast = new DateTime('last day of this month');
        $dlastFormat = $dlast->format('Ymd');
        $datefilter = "and it.date_instance between $dfirstFormat and  $dlastFormat "; 
    }


    $sql  = "select it.date_instance,it.temps,
    (select c1.name from instance_team itm1 left join `char` c1 on itm1.char_id = c1.char_id where itm1.team_id = it.team_id and itm1.team_nb = 1) as char1,
    (select c2.name from instance_team itm2 left join `char` c2 on itm2.char_id = c2.char_id where itm2.team_id = it.team_id and itm2.team_nb = 2) as char2,
    (select c3.name from instance_team itm3 left join `char` c3 on itm3.char_id = c3.char_id where itm3.team_id = it.team_id and itm3.team_nb = 3) as char3,
    (select c4.name from instance_team itm4 left join `char` c4 on itm4.char_id = c4.char_id where itm4.team_id = it.team_id and itm4.team_nb = 4) as char4,
    (select c5.name from instance_team itm5 left join `char` c5 on itm5.char_id = c5.char_id where itm5.team_id = it.team_id and itm5.team_nb = 5) as char5,
    (select c6.name from instance_team itm6 left join `char` c6 on itm6.char_id = c6.char_id where itm6.team_id = it.team_id and itm6.team_nb = 6) as char6,
    (select c7.name from instance_team itm7 left join `char` c7 on itm7.char_id = c7.char_id where itm7.team_id = it.team_id and itm7.team_nb = 7) as char7,
    (select c8.name from instance_team itm8 left join `char` c8 on itm8.char_id = c8.char_id where itm8.team_id = it.team_id and itm8.team_nb = 8) as char8 
    from instance_timer it 
    where it.instance_name like '%$instanceFilter' $datefilter and `difficulty` = 4 
    order by it.temps asc 
    LIMIT 0,50";
    $sth  = $server->connection->getStatement($sql);
    $sth->execute();
    $instanceTeams = $sth->fetchAll();

}