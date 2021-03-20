## Bem-vindo ao Meu Remédio, uma aplicação para cadastro e controle de horários de medicamentos em uso e seus respectivos usuários

### Requisitos para rodar a aplicação:

- PHP 7+ com as extensões: PDO, Mbstring, Tokenizer, OpenSSL, XML
- Composer
- Laravel 8

### Passos para rodar a aplicação:

- A partir da raiz do projeto, baixar as dependências do projeto: $ composer update;

- A partir de uma instância MariaDB, execute o script "database.sql" (no SGBD) contido na raiz do projeto;

- Configure o arquivo ".env" com as devidas credenciais de conexão com o banco de dados, conforme ".env-example";

- A partir da raiz do projeto, rode as migrations: $ php artisan migrate;

- A partir da raiz do projeto, rode o servidor embutido: $ php artisan serve;



