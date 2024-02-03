# Pré requisitos para executar o projeto
- Ter PHP8 e composer instalado na máquina
- Caso apresente algum erro durante o processo relacionado a alguma extensão do PHP, terá que ser feita a instalação manualmente.

# Executaando em localhost

- Copiar .env a partir do env-example dentro daa raiz do projeto
- Execute os comandos:

     composer update
    composer require laravel/sail --dev
    php artisan sail:install 
     marcar mysql

./vendor/bin/sail up  // use -d para ocultar os logs da execução 

 docker exec -it crud-client_laravel.test_1 bash 

 npm install
npm run build 

 php artisan migrate 

    yes para criar tabela

 php artisan db:seed 


Login: root@teste.com
senha: root1
