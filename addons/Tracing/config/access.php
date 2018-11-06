<?php
return array(
	'modules' => array(
		'tracing' => array(
			'index' => AccountLevel::ANYONE,
			'sanctions'	=> AccountLevel::ANYONE,
			'mvpcardtrace'	=> AccountLevel::ANYONE,
			'manage' => AccountLevel::ADMIN,
			'managecmd' => AccountLevel::ADMIN,
		)
	),
)
?>
