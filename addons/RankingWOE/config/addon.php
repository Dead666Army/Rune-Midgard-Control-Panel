<?php
 
return array(

    'WOERankingLimit'    => 50,                            
    'WOERankingHideGroupLevel'  => AccountLevel::LOWGM,    
    
    'WOECharRankingThreshold'  => 0,                       // Number of days the character must have logged in within to be listed in character ranking. (0 = disabled)
    'WOEHideTempBannedCharRank'  => false,                 // Hide temporarily banned characters from ranking.
    'WOEHidePermBannedCharRank'  => true,                  // Hide permanently banned characters from ranking.'HidePermBannedCharRank'    =>
 
	'MenuItems' => array(
        'RankingLabel' => array(
    			'WOE'  => array('module' => 'rankingwoe&action=general'),
    		),
    ),
    'SubMenuItems'	=> array(
        'rankingwoe'		=> array(
            'general'	=> 'General',
            'items'		=> 'Items',
            'skills'	=> 'Skills',
        ),
    ),

    'WOERankingTypes'=> array(
        'Current' => 'Last Woe',
        'AllTime' => 'All Time',
    ),
    
    'FluxTables' => array(
        'char_woe' => 'char_woe',
    )
)
?>