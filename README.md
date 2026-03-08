# MCP MariaDB Server

> 🇧🇷 [Leia em Português](README.pt-BR.md)

MCP (Model Context Protocol) Server for secure execution of SQL queries on MariaDB/MySQL databases.

The Model Context Protocol (MCP) allows AI applications to connect to external servers to access tools and resources. This server exposes a tool to execute SQL directly on the configured database.

## Features

- SQL query execution (SELECT, INSERT, UPDATE, DELETE, DDL, etc.).
- Configuration via environment variables.
- Logging of all operations in `var/logs/mcp.log`.

## Installation

```bash
composer install
```

## Configuration

The server expects common database configuration via `.env`:

```env
DATABASE_HOST=localhost
DATABASE_PORT=3306
DATABASE_NAME=mcp
DATABASE_USER=root
DATABASE_PASSWORD=root
```
