<?php
return array(
	// Example server configuration. You may have more arrays like this one to
	// specify multiple server groups (however they should share the same login
	// server whilst they are allowed to have multiple char/map pairs).
	array(
		'ServerName'     => 'RuneMidgard',
		// Global database configuration (excludes logs database configuration).
		'DbConfig'       => array(
			//'Socket'     => '/tmp/mysql.sock',
			//'Port'       => 3306,
			//'Encoding'   => 'utf8', // Connection encoding -- use whatever here your MySQL tables collation is.
			'Convert'    => 'utf8',
				// -- 'Convert' option only works when 'Encoding' option is specified and iconv (http://php.net/iconv) is available.
				// -- It specifies the encoding to convert your MySQL data to on the website (most likely needs to be utf8)
			'Hostname'   => '127.0.0.1',
			'Username'   => '-----',
			'Password'   => '-----',
			'Database'   => 'RMmain',
			'Persistent' => true,
			'Timezone'   => null // Example: '+0:00' is UTC.
			// The possible values of 'Timezone' is as documented from the MySQL website:
			// "The value can be given as a string indicating an offset from UTC, such as '+10:00' or '-6:00'."
			// "The value can be given as a named time zone, such as 'Europe/Helsinki', 'US/Eastern', or 'MET'." (see below continuation!)
			// **"Named time zones can be used only if the time zone information tables in the mysql database have been created and populated."
		),
		// This is kept separate because many people choose to have their logs
		// database accessible under different credentials, and often on a
		// different server entirely to ensure the reliability of the log data.
		'LogsDbConfig'   => array(
			//'Socket'     => '/tmp/mysql.sock',
			//'Port'       => 3306,
			//'Encoding'   => null, // Connection encoding -- use whatever here your MySQL tables collation is.
			'Convert'    => 'utf8',
				// -- 'Convert' option only works when 'Encoding' option is specified and iconv (http://php.net/iconv) is available.
				// -- It specifies the encoding to convert your MySQL data to on the website (most likely needs to be utf8)
			'Hostname'   => '127.0.0.1',
			'Username'   => '-----',
			'Password'   => '-----',
			'Database'   => 'RMlog',
			'Persistent' => true,
			'Timezone'   => null // Possible values is as described in the comment in DbConfig.
		),
		// Login server configuration.
		'LoginServer'    => array(
			'Address'  => '127.0.0.1',
			'Port'     => 6900,
			'UseMD5'   => true,
			'NoCase'   => true, // rA account case-sensitivity; Default: Case-INsensitive (true).
			'GroupID'  => 0,    // Default account group ID during registration.
			//'Database' => 'ragnarok'
		),
		'CharMapServers' => array(
			array(
				'ServerName'      => 'RuneMidgard',
				'Renewal'         => false,
				'MaxCharSlots'    => 9,
				'DateTimezone'    => null, // Specifies game server's timezone for this char/map pair. (See: http://php.net/timezones)
				//'ResetDenyMaps'   => 'sec_pri', // Defaults to 'sec_pri'. This value can be an array of map names.
				//'Database'        => 'ragnarok', // Defaults to DbConfig.Database
				'ExpRates' => array(
					'Base'        => 500, // Rate at which (base) exp is given
					'Job'         => 500, // Rate at which job exp is given
					'Mvp'         => 500  // MVP bonus exp rate
				),
				'DropRates' => array(
					// The rate the common items (in the ETC tab, besides card) are dropped
					'Common'      => 300,
					'CommonBoss'  => 300,
					// The rate healing items (that restore HP or SP) are dropped
					'Heal'        => 300,
					'HealBoss'    => 300,
					// The rate usable items (in the item tab other then healing items) are dropped
					'Useable'     => 300,
					'UseableBoss' => 300,
					// The rate at which equipment is dropped
					'Equip'       => 300,
					'EquipBoss'   => 300,
					// The rate at which cards are dropped
					'Card'        => 1000,
					'CardBoss'    => 100,
					// The rate adjustment for the MVP items that the MVP gets directly in their inventory
					'MvpItem'     => 300
				),
				'CharServer'      => array(
					'Address'     => '127.0.0.1',
					'Port'        => 6121
				),
				'MapServer'       => array(
					'Address'     => '127.0.0.1',
					'Port'        => 5121
				),
				// -- WoE days and times --
				// First parameter: Starding day 0=Sunday / 1=Monday / 2=Tuesday / 3=Wednesday / 4=Thursday / 5=Friday / 6=Saturday
				// Second parameter: Starting hour in 24-hr format.
				// Third paramter: Ending day (possible value is same as starting day).
				// Fourth (final) parameter: Ending hour in 24-hr format.
				// ** (Note, invalid times are ignored silently.)
				'WoeDayTimes'   => array(
					array(0, '21:00', 0, '22:30'), // Example: Starts Sunday 21:00 PM and ends Sunday 23:00 PM
				),
				// Modules and/or actions to disallow access to during WoE.
				'WoeDisallow'   => array(
					array('module' => 'character', 'action' => 'online'),  // Disallow access to "Who's Online" page during WoE.
					array('module' => 'character', 'action' => 'mapstats') // Disallow access to "Map Statistics" page during WoE.
				)
			)
		)
	)
);
?>