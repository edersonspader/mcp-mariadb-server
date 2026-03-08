<?php

require __DIR__ . "/vendor/autoload.php";

use App\Config;
use App\MCPMariaDBServer;
use Mcp\Server;
use Mcp\Server\Transport\StdioTransport;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

$config = new Config();

$logger = new Logger('mcp');
$logger->pushHandler(new StreamHandler(__DIR__ . '/var/logs/mcp.log', Level::Debug));

$serverInstance = new MCPMariaDBServer($config);

$server = Server::builder()
    ->setServerInfo('mariadb-mcp', '1.0')
    ->setLogger($logger)
    ->addTool(
        fn(string $sql) => $serverInstance->exec($sql),
        'exec',
        'Execute SQL query on MariaDB database',
        null,
        [
            'type' => 'object',
            'properties' => [
                'sql' => [
                    'type' => 'string',
                    'description' => 'The SQL query to execute'
                ]
            ],
            'required' => ['sql']
        ]
    )
    ->build();

$server->run(new StdioTransport());
