<?php

namespace App;

class Config
{
	public int $limitDefault;

	public function __construct(
		public string $dbHost = '127.0.0.1',
		public string $dbPort = '3306',
		public string $dbName = 'mcp',
		public string $dbUser = 'mcp',
		public string $dbPass = ''
	) {
		$this->dbHost = getenv('DB_HOST') ?: $dbHost;
		$this->dbPort = getenv('DB_PORT') ?: $dbPort;
		$this->dbName = getenv('DB_NAME') ?: $dbName;
		$this->dbUser = getenv('DB_USER') ?: $dbUser;
		$this->dbPass = getenv('DB_PASS') ?: $dbPass;
	}
}
