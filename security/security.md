# Stratégie de sécurité

## choix de la technologie

Pour votre application, nous avons défini une technologie pour une meilleure sécurité. Il s'agira du framework Symfony avec son langage en PHP.
Nous avons choisie celui-ci, car il fait partie du top 3 des frameworks PHP open source. C'est un framework constitué d’un ensemble de composants. Il est puissant, sécurisé, sur mesure et ne cesse d’évoluer. L'utilisation de bundles (groupe de produits) et de composants en fait une parfaite solution pour les sites web et les applications de toute taille et complexe. Il sera plus facilement maintenable.

Sous Symfony, le contrôle de la sécurité est simple et avancé. Ce framework dispose de plusieurs options de sécurité telle que SecurityBundle qui vous fournit toutes les fonctionnalités d’authentification et d’autorisation nécessaires afin de sécuriser votre connexion et votre navigation. Il y a également Doctrine pour interagir avec votre base de données.

## protection en profondeur

Comme expliquer dans le choix de la technologie, ce framework mets places tout un système pour vous protéger des injections XSS, nous utiliseront doctrine pour interagir avec la base de données qui protégez la base de données et contrer les injections SQLi.

## L’entête sécurisé (TLS / HTTP / HTTPS / CORS)

Nous avons mis en place la sécurité de l'entête pour le rendre HTTPS. Grâce au différend bundle de symphonie la gestion de sécurisation au niveau de la connexion et l'accès au page en fonction du rôle ce fait. Cela évitera qu'un utilisateur puisse accéder à une page administrateur.

## le moindre privilège

On applique ce système pour que seules les ressources demandées soient accessibles seulement au rôle défini. C'est pour cela qu'on va mettre en place un RBAC pour la gestion des rôles. Nous allons créer un rôle user, et administrateur qui auront accès qu'aux ressources qu'ils ont besoin.

## la RGPD

Vu qu'on a des données sensibles dans la base de données, une CGU sera écrite concernant le droit d'accès et de regard à leurs propres données.

## stratégie de sauvegarde

Pour l'enregistrement du mot de passe symphonie va hasch le mot de passe pour sécuriser le mot de passe avec un minimum de 6 caractères. 

## sécurisation de l'authentification

Le framework met en place un système d'authentification sécuriser.
