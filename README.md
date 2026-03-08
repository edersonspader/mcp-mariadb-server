# MCP MariaDB Server

Servidor MCP (Model Context Protocol) para execução segura de consultas SQL em bancos de dados MariaDB/MySQL.

O Model Context Protocol (MCP) permite que aplicações de IA se conectem a servidores externos para acessar ferramentas e recursos. Este servidor expõe uma ferramenta para executar SQL diretamente no banco de dados configurado.

## Funcionalidades

- Execução de consultas SQL (SELECT, INSERT, UPDATE, DELETE, DDL, etc.).
- Configuração via variáveis de ambiente.
- Logging de todas as operações em `var/logs/mcp.log`.

## Instalação

```bash
composer install
```

## Configuração

Copie o arquivo `.env.example` para `.env` e ajuste as variáveis conforme necessário:

```bash
cp .env.example .env
```

Variáveis de ambiente:
- `DB_HOST` (padrão: 127.0.0.1) - Host do banco de dados
- `DB_PORT` (padrão: 3306) - Porta do banco de dados
- `DB_NAME` (padrão: mcp) - Nome do banco de dados
- `DB_USER` (padrão: mcp) - Usuário do banco
- `DB_PASS` (padrão: vazio) - Senha do banco

## Execução

```bash
composer serve
# ou
php server.php
```

O servidor é executado via STDIO, aguardando conexões MCP.

## Ferramenta disponível

### `exec`

Executa uma consulta SQL no banco de dados configurado.

**Parâmetros:**
- `sql` (string, obrigatório) — A consulta SQL a ser executada.

**Retorno:**
- Para consultas SELECT: array com as linhas retornadas.
- Para INSERT/UPDATE/DELETE: `{ "affected": N }` com o número de linhas afetadas.

## Integração com VS Code

Para usar este servidor MCP no VS Code com o GitHub Copilot, edite o `settings.json` e adicione:

```json
{
  "github.copilot.chat.mcp.servers": {
    "mariadb": {
      "command": "php",
      "args": ["server.php"],
      "cwd": "/caminho/absoluto/para/o/projeto",
      "env": {
        "DB_HOST": "127.0.0.1",
        "DB_PORT": "3306",
        "DB_NAME": "mcp",
        "DB_USER": "mcp",
        "DB_PASS": ""
      }
    }
  }
}
```

Substitua `/caminho/absoluto/para/o/projeto` pelo caminho real do diretório do projeto e ajuste as variáveis de ambiente conforme necessário.

## Segurança

- O arquivo `.env` nunca deve ser commitado no repositório.

## Logs

Os logs são gravados em `var/logs/mcp.log`.