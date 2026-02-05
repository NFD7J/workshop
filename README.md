# Workshops

Projet web permettant de gérer des workshops avec un système d’utilisateurs et d’administration.

---

## Prérequis

Avant de commencer, assurez-vous d’avoir installé l’un des environnements suivants :
- [XAMPP](https://www.apachefriends.org/fr/index.html)
- [WAMP](https://www.wampserver.com/)

👉 Dans ce guide, **XAMPP** est utilisé comme référence.

Lors de l’installation, veillez à activer les modules suivants :
- Apache
- PHP
- MySQL

---

## Installation

1. Lancez **XAMPP** et démarrez les services :
   - Apache
   - MySQL

2. Clonez le dépôt GitHub du projet dans le dossier suivant :  
c:/xampp/htdocs/  



3. Ouvrez votre navigateur et accédez à phpMyAdmin :  
https://localhost/phpmyadmin  



4. Créez une base de données nommée :  
workshop  



5. Sélectionnez la base de données **workshop**, puis :
- Allez dans l’onglet **Importer**
- Importez le fichier `exemple.sql` présent dans le dépôt
- Lancez l’importation

---

## Lancer le projet

Une fois l’installation terminée, ouvrez votre navigateur et rendez-vous sur :
https://localhost/  


---

## Comptes de test

### Administrateur (back-office)
- **Email** : admin@test.com  
- **Mot de passe** : 123  

### Utilisateur
- **Email** : user@test.com  
- **Mot de passe** : 1234  

---

## Notes

- Assurez-vous qu’Apache et MySQL sont bien démarrés avant d’accéder au site.
- En cas d’erreur, vérifiez le dossier du projet et la configuration de la base de données.




