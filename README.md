# [TEST] DemoChat 😻

DemoChat est une application (très) basique de messagerie instantanée développée pour tester le protocole [Mercure](https://github.com/dunglas/mercure) introduit par Kevin Dunglas lors du Symfony Live de Paris 2019. 

L’application suit une architecture orientée API avec, côté backend, une API REST développée avec Symfony 4, et côté frontend, une application développée avec Vue.js. L’API est consommée à l’aide de la librairie [Axios](https://github.com/axios/axios). 

### Avantages d’une architecture orientée API :  
- Décorrélation complète du backend et frontend. On utilise Symfony pour se concentrer uniquement sur la couche métier de notre application,
- Délégation des autres traitements au client, permettant d’alléger la charge serveur et d’améliorer ses performances,
- L’API pourra être consommée aussi bien par un site web, une application mobile, un objet connecté… 

### Pourquoi Vue.js ? 
- Vue.js est un framework front bien documenté,
- Disposant d'une communauté active,
- Facile et rapide à prendre en main,
- Possédant de nombreuses librairies permettant de créer rapidement de belles interfaces sans avoir besoin de compétences graphiques particulières (ex : le système de composants Material design Vuetify, utilisé ici),
- On l’appréciera notamment pour son système de composants permettant une meilleure structuration et maintenabilité des projets,
- La gestion des formulaires est enfin largement simplifiée (adieu, Form) grâce à un système de liaison de données bidirectionnelle entre le DOM et les données JavaScript.

### Le composant Mercure en quelques mots : 
Le [composant Mercure](https://symfony.com/doc/current/components/mercure.html) permet de mettre en place un système de notifications instantanées sur Symfony. Ce système repose sur le protocole Open Source Mercure. Il se compose d’un *Hub* en son centre permettant de centraliser des informations envoyées par le serveur (via des requêtes HTTP POST), et de les dispatcher en temps réel aux clients abonnés via la technologie [server sent events](https://developer.mozilla.org/fr/docs/Server-sent_events/Using_server-sent_events) (les clients reçoivent des mises à jour automatiques à partir d’une connexion HTTP via l’interface EventSource, aujourd’hui nativement supportée par la plupart des navigateurs). Les informations peuvent également être envoyées au hub à l’aide du composant Messenger, pour une gestion des traitements asynchrone.

En savoir plus sur le protocole Mercure : https://github.com/dunglas/mercure

*Note :* ce projet ne fait qu’effleurer les fonctionnalités offertes par le composant. On retiendra notamment la capacité à cibler les clients à qui dispatcher une information grâce à un système d’autorisation via JWT. Les possibilités sont immenses et laissent imaginer de nombreux usages (mise à jour d'un fil d'actualité, d'un résultat sportif, d'un stock produit...)

### Exécuter l’application en local : 
*Prérequis :* l’outil [Docker-compose](https://docs.docker.com/compose/install/#prerequisites) doit préalablement être installé sur votre machine afin de mettre en place l’environnement de développement du projet.

Exécutez la commande suivante depuis la racine du projet : 
```
$ make install  # installe et démarre le projet 
```

Puis, éditez votre fichier hosts:
```
$ sudo [nano|vim|...]  /etc/hosts
# ajoutez la ligne suivante
127.0.0.1 demochat.local www.demochat.local
```
Demochat est désormais disponible à l’adresse suivante (site non sécurisé) : http://www.demochat.local:8080/

### Améliorations possibles : 
- Chargement de l’historique des messages en lazy loading,
- Système d’authentification via JWT,
- Envoi de fichiers multimédias,
- … 
