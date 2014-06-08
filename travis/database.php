<?php
class DATABASE_CONFIG {

	private $_identities = array(
		'mysql' => array(
			'datasource' => 'Database/Mysql',
			'host' => '127.0.0.1',
			'login' => 'travis'
		),
		'pgsql' => array(
			'datasource' => 'Database/Postgres',
			'host' => '127.0.0.1',
			'login' => 'postgres',
			'database' => 'cakephp_test',
			'schema' => array(
				'default' => 'public',
				'test' => 'public'
			)
		),
		'sqlite' => array(
			'datasource' => 'Database/Sqlite',
			'database' => array(
				'default' => ':memory:',
				'test' => '/tmp/cakephp_test.db'
			)
		)
	);

	public $default = array(
		'persistent' => false,
		'host' => '',
		'login' => '',
		'password' => '',
		'database' => 'cakephp_test',
		'prefix' => ''
	);

	public $test = array(
		'persistent' => false,
		'host' => '',
		'login' => '',
		'password' => '',
		'database' => 'cakephp_test',
		'prefix' => ''
	);

	public function __construct() {
		$db = 'mysql';
		if (!empty($_SERVER['DB'])) {
			$db = $_SERVER['DB'];
		}

		foreach (array('default', 'test') as $source) {
			$config = array_merge($this->{$source}, $this->_identities[$db]);
			if (is_array($config['database'])) {
				$config['database'] = $config['database'][$source];
			}
			if (!empty($config['schema']) && is_array($config['schema'])) {
				$config['schema'] = $config['schema'][$source];
			}
			$this->{$source} = $config;
		}
	}

}
