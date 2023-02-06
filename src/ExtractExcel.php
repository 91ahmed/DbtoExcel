<?php
	
	namespace Database\Excel;

	use Database\Excel\Connect;

	class ExtractExcel extends Connect
	{
		private $pdo;
		private $data;

		private $driver = 'mysql';
		private $host = '127.0.0.1';
		private $username = 'root';
		private $password = '';
		private $database = '';
		private $port = 3306;
		private $charset = 'utf8';
		private $sslmode = 'disable';

		private $table;
		private $columns;

		public function __construct (array $config)
		{
			$this->driver = (isset($config['driver'])) ? $config['driver'] : $this->driver;
			$this->host = (isset($config['host'])) ? $config['host'] : $this->host;
			$this->username = (isset($config['username'])) ? $config['username'] : $this->username;
			$this->password = (isset($config['password'])) ? $config['password'] : $this->password;
			$this->database = (isset($config['database'])) ? $config['database'] : $this->database;
			$this->port = (isset($config['port'])) ? $config['port'] : $this->port;
			$this->charset = (isset($config['charset'])) ? $config['charset'] : $this->charset;
			$this->sslmode = (isset($config['sslmode'])) ? $config['sslmode'] : $this->sslmode;

			$pdo = new Connect();
			$pdo->setConfig('driver', $this->driver);
			$pdo->setConfig('host', $this->host);
			$pdo->setConfig('username', $this->username);
			$pdo->setConfig('password', $this->password);
			$pdo->setConfig('database', $this->database);
			$pdo->setConfig('port', $this->port);
			$pdo->setConfig('charset', $this->charset);
			$pdo->setConfig('sslmode', $this->sslmode);
			$this->pdo = $pdo->connect();
		}

		public function table (string $table)
		{
			$this->table = $table;
		}

		public function columns (string $columns = '*')
		{
			$this->columns = $columns;
		}

		public function execute ()
		{
			$stmt = $this->pdo->prepare("SELECT {$this->columns} FROM {$this->table}");
			$stmt->execute();
			$this->data = $stmt->fetchAll();

			if (empty($this->data)) {
				throw new Exception("No data found in {$this->table} table", 1);
			} else {
				ob_start();
				header('Content-Type: text/html; charset=utf-8');
				$this->html();
				$filename = 'export_'.date('dmY').'_xls_'.time().'.xls';
				header("Content-Type: application/ms-excel");
				header("Content-Disposition:attachment; filename={$filename}");
				ob_end_flush();
				exit();
			}
		}

		public function html ()
		{
			echo "<table style='visibility:hidden;>";
				echo "<thead>";
					echo "<tr>";
						foreach(array_keys($this->data[0]) as $column)
						{
							echo "<th><b>".$column."</b></th>";
						}
					echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
					foreach ($this->data as $value)
					{
						echo "<tr>";
							foreach (array_values($value) as $key => $data)
							{
								echo "<td>".$data."</td>";
							}
						echo "</tr>";
					}
				echo "</tbody>";
			echo "</table>";
		}
	}
?>