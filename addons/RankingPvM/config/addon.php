<?php

return array(
    'MenuItems' => array(
        'RankingLabel' => array(
    		'PVM'  => array( 'module' => 'rankingpvm&action=instance'),
    	),
    ),
    'SubMenuItems'	=> array(
        'rankingpvm'		=> array(
            'instance'	=> 'Instance',
            'mvp'	    => 'MVP',
        ),
    ),
    'Instances'=> array(
        'The Forest' => 'The Forest',
        'Undead' => 'Old Cemetery',
        'Old Glast Heim' =>	'Old Glast Heim',
        'Celine Dwelling' =>	'Celine\'s Dwelling',
        'Octopus Cave' =>	'Octopus Cave',
    ),
    'InstancesImages'=> array(
        'The Forest' => 'https://static.rune-midgard.com/assets/Rune-Midgard_instance_1_TheForest.gif',
        'Undead' => 'https://static.rune-midgard.com/assets/Rune-Midgard_instance_2_OldCemetery.gif',
        'Old Glast Heim' =>	'https://static.rune-midgard.com/assets/Rune-Midgard_instance_3_OldGlastHeim.gif',
        'Celine Dwelling' =>	'https://static.rune-midgard.com/assets/Rune-Midgard_instance_4_CelinesDwelling.gif',
        'Octopus Cave' =>	'https://static.rune-midgard.com/assets/Rune-Midgard_instance_5_Octopus_Cave.gif',
    ),
    'InstancesRankingTypes'=> array(
        'AllTime' => 'All Time',
        'Current' => 'Current Month',
    ),
    'MVPRankingTypes'=> array(
        'AllTime' => 'All Time',
        'Current' => 'Current Month',
    )
);