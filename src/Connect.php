<?php
	
	namespace Database\Excel;
	
	/**
	 *	PDO Database Connection
	 */
	class Connect
	{
		/** 
		 *	@var hold PDO instance 
		 */
		private $instance;

		/** 
		 *	@var array to store DSN connection details 
		 */
		private $config = array(
			'driver' => 'mysql', // [pgsql - mysql - sqlsrv]
			'host' => '127.0.0.1', // [localhost - Server Name in SQL]
			'username' => 'root',
			'password' => '',
			'database' => '',
			'port' => 3306, // [mysql(3306) - postgres(5432) - sqlserver(1433)]
			'charset' => 'utf8',
			'sslmode' => 'disable', // [disable - require]
		);

		/**
		 *	Setter function to change DSN configurations
		 *
		 *	@param String $key ($this->config[$key])
		 *	@param String $value ($this->config[$key] = $value)
		 *
		 *	@return void
		 */
		public function setConfig (String $key, String $value): void
		{
			$this->config[$key] = $value;
		}

		/**
		 *	Connect to mysql database server
		 *	@return void
		 */
		public function mysql (): void
		{
			$options = [
				\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
			];

			$this->instance = new \PDO("mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['database']};charset={$this->config['charset']}", $this->config['username'], $this->config['password'], $options);
		}

		/**
		 *	Connect to postgresql database server
		 *	@return void
		 */
		public function postgresql (): void
		{
			$this->instance = new \PDO("pgsql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['database']};sslmode=disable", $this->config['username'], $this->config['password']);
		}

		/**
		 *	Connect to mssql database server
		 *	@return void
		 */
		public function sqlserver ()
		{
			// Server: AHMED | Port: 1433 | Database: Northwind | Username: '' | Password: ''
			$this->instance = new \PDO("sqlsrv:Server={$this->config['host']},{$this->config['port']};Database={$this->config['database']}", $this->config['username'], $this->config['password']);

			// Using PDO_sqlsrv is way slower than through PDO_odbc.
			// If you want to use the faster PDO_ODBC you can use:
			/*
			$this->instance = new \PDO("odbc:Driver={SQL Server};Server={$this->config['host']};Database={$this->config['database']}, $this->config['username'], $this->config['password']");
			*/
		}

		/**
		 *	Set PDO arrtibutes
		 *	@return void
		 */
		public function PdoConfig ():void
		{
			$this->instance->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
			$this->instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
			$this->instance->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_NATURAL);
		}

		/**
		 *	Coonect to database
		 *	@return PDO instance
		 */
		public function connect ()
		{
			try {
				if ($this->config['driver'] == 'mysql') {
					$this->mysql();
				} elseif ($this->config['driver'] == 'pgsql'){
					$this->postgresql();
				} elseif ($this->config['driver'] == 'sqlsrv') {
					$this->sqlserver();
				}
			} catch (Exception $e) {
				exit($e->getMessage());
			}

			$this->PdoConfig();

			return $this->instance;	
		}
	}
?>