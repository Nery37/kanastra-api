# Kanastra-api

Este projeto foi desenvolvido utilizando Laravel 9 e PHP 8.1.

## Pré-requisitos

- Docker e Docker Compose instalados.
- `make` instalado.
- Para usar o serviço de email, é necessário incluir suas respectivas credenciais no arquivo .env . (Obs: O projeto foi desenvolvido utilizando o Mailtrap.io como uma sandbox para testar o envio de emails.)

## Instruções de Uso

1. Clone o repositório.

2. Copie e logo depois altere o .env.example para .env.

3. Execute o comando de instalação:

   ```bash
   make install
   ```

4. Após a instalação, utilize o comando `make queue` para iniciar a fila.

## Postman

- O projeto possui uma collection na pasta 'collection', caso tenha interesse em testar os endpoints diretamente.

## Teste unitário e feature

- Para rodar os testes unitarios basta rodar o comando abaixo: 

  ```bash
   make test
   ```

## Comandos `make` disponíveis

Aqui estão os comandos disponíveis para gerenciamento e operações do container Docker:

- **install**: Executa uma série de ações para configurar o projeto. Inclui recriar os containers, instalar dependências via Composer e executar migrations e seeders.
  
  ```bash
  make install
  ```

- **up**: Inicia os containers do projeto.
  
  ```bash
  make up
  ```

- **down**: Para e remove os containers do projeto.
  
  ```bash
  make down
  ```

- **bash**: Acessa o terminal do container principal.
  
  ```bash
  make bash
  ```

- **build**: Constrói ou reconstrói os serviços.
  
  ```bash
  make build
  ```

- **force-recreate**: Força a recriação dos containers e constrói-os.
  
  ```bash
  make force-recreate
  ```

- **composer-install**: Instala as dependências do projeto via Composer.
  
  ```bash
  make composer-install
  ```

- **migrate**: Executa as migrations do projeto.
  
  ```bash
  make migrate
  ```

- **seed**: Executa as seeders do projeto.
  
  ```bash
  make seed
  ```

- **logs**: Exibe os logs dos containers.
  
  ```bash
  make logs
  ```

- **clear**: Limpa o cache e otimizações do Laravel.
  
  ```bash
  make clear
  ```

- **format**: Executa o lint e corrige os padrões de código.
  
  ```bash
  make format
  ```
