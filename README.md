# API de clientes em PHP e MySQL

Projeto de aprendizagem com endpoints para criar, consultar, atualizar e eliminar clientes. A implementação usa PHP procedural, `mysqli` e respostas JSON; não utiliza um framework nem Composer.

## Requisitos

PHP com `mysqli` e um servidor MySQL/MariaDB local. Usar apenas dados de teste. Não existe autenticação ou controlo de acesso na API.

## Preparar a base de dados

O schema está em [database/schema.sql](database/schema.sql):

```bash
mysql -u SEU_UTILIZADOR -p < database/schema.sql
```

O script cria `soaf.customers`, com `id`, `name`, `email` e `phone`. Em [inc/dbcon.php](inc/dbcon.php), ajustar host, utilizador, palavra-passe e nome da base de dados. O valor original usa root sem palavra-passe: substituir por um utilizador local dedicado com permissões limitadas à base de dados de teste. Não publicar alterações que contenham credenciais reais.

## Executar localmente

Na raiz do repositório:

```bash
php -S 127.0.0.1:8080
```

O servidor PHP incorporado é apenas para desenvolvimento. A API não deve ser exposta à internet nesta configuração.

## Endpoints

| Método | Caminho | Dados |
| --- | --- | --- |
| GET | `/customers/read.php` | Lista de clientes |
| GET | `/customers/getCustomerbyID.php?id=1` | ID na query string |
| POST | `/customers/create.php` | JSON com name, email e phone |
| PUT | `/customers/update.php?id=1` | JSON completo com name, email e phone |
| DELETE | `/customers/delete.php?id=1` | ID na query string |

Exemplo de criação em Bash:

```bash
curl -i -X POST http://127.0.0.1:8080/customers/create.php -H 'Content-Type: application/json' -d '{"name":"Cliente de teste","email":"test@example.com","phone":"000000000"}'
curl -i http://127.0.0.1:8080/customers/read.php
```

Substituir `id=1` pelo ID criado no teu ensaio. Uma lista vazia devolve 404 nesta implementação. O endpoint de eliminação usa 204; os clientes não devem depender de um corpo JSON nessa resposta.

## Limitações conhecidas

O projeto ainda precisa de uma revisão funcional antes de uso público: autenticação, validação de JSON e campos, consultas preparadas, tratamento consistente de erros e preflight CORS. Escapar strings não substitui essas medidas. Os cabeçalhos CORS atuais não tornam a API segura.

A validação sintática com `php -l` não comprova a ligação à base de dados nem todos os comportamentos dos endpoints. Reproduzir os cinco casos com MySQL de teste antes de apresentar o projeto como validado.

## Limpeza

Parar o servidor com Ctrl+C. Remover apenas a base de dados/utilizador de teste quando já não forem necessários. Não publicar dumps com dados reais nem palavras-passe.
