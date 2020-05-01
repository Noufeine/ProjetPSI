#MEMBRES DU GROUPE 
Noufeine AHMED Aniss ELARJ Chelson SUPREME 

#ENVIRONNEMENT UTILISES 
Laravel 7 pour le coté PHP Bootstrapp 4 pour le coté CSS Phpmyadmin(wamp) pour la BD 

#LANCEMENT DU PROJET
Pour faire fonctionner Laravel, Il faut installer composer par la commande (sur le terminal):
$ composer global require laravel/installer
Pour plus de détails : https://laravel.com/docs/7.x/installation

Cloner ensuite ce projet dans le terminal en faisant : 
$ git init
$ git clone https://github.com/Nouf204/ProjetPSI

Dans le fichier .env modifier le host (DB_HOST), le port (DB_PORT), le nom de la base de données (DB_DATABASE), le username (DB_USERNAME) et le mot de passe (DB_PASSWORD). 

Lancement du projet par la commande (sur le terminal) :
$ cd projetpsi
$ php artisan serve

Aller ensuite dans le lien suivant : http://127.0.0.1:8000 pour visualiser le projet.

#CREATION DE LA BD
Importer la BD (bdpsi.sql) dans PHPMyAdmin.

#IMPORTATION 
Importer la feuille (ListePersonnes.xls) dans Le projet (dans la page import-individus.php) pour importer les individus.
Importer la feuille (Groupes.xls) dans Le projet (dans la page import-groupes.php) pour importer les groupes.

Si l'import/export ne marche pas, installer le package maatwebsit  par la commande (sur le terminal) : 
$ composer require maatwebsite/excel


Vous êtes maintenant prêts à utiliser notre Application 😊😊
