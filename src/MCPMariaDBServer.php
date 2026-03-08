<?php

namespace App;

class MCPMariaDBServer
{
	private \PDO $pdo;

	public function __construct(
		private Config $config
	) {
		$this->initDb();
	}

	private function initDb(): void
	{
		$dsn = sprintf(
			"mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
			$this->config->dbHost,
			$this->config->dbPort,
			$this->config->dbName
		);

		$this->pdo = new \PDO(
			$dsn,
			$this->config->dbUser,
			$this->config->dbPass,
			[
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
			]
		);
	}

	public function exec(string $sql): array
	{
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();

			if ($stmt->columnCount()) {
				return $stmt->fetchAll();
			} else {
				return ['affected' => $stmt->rowCount()];
			}
		} catch (\PDOException $e) {
			throw new \RuntimeException('Database error: ' . $e->getMessage());
		}
	}
}
