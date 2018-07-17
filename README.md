 

# TrophyBundle
Ce bundle est une "amélioration" du tutoriel de [grafikart](https://www.youtube.com/watch?v=P6MjPMRjJvo)

## Installation

```shell
$ composer require vectorxhd/trophy-bundle
```

## Configuration
```php
<?php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = [
        // ...
        new VectorXHD\TrophyBundle\VectorXHDTrophyBundle(),
    ];
}
```

```yaml
# app/config/config.yml
vectorxhd_trophy:  
    user_class: AppBundle\Entity\User
```
Il faut aussi implémenter `UserTrophyInterface` sur votre entité `user_class`

## Ajouter un badge 
Voici l'exemple d'un badge utiliser pour les commentaire
```php
$badge = new Badge();  
$badge->setName("Premier badge");  
$badge->setActionName('comment');  
$badge->setActionCount(1);
```

## Exemple d'utilisation
```php
// Recuperer le manager
/** @var TrophyManager $trophyManager */  
$trophyManager = $this->get('vectorxhd_trophy.manager.trophy');

// Debloquage d'un trophée
$trophyManager->checkAndUnlock($user, 'comment', $commentsUserCount);
```

La méthode `checkAndUnlock` a besoin de

 - L'instance de l'utilisateur (`$this->getUser();`)
 - Le nom de l'action
 - Le nombre de fois que l'action c'est produite

Dans cette exemple `$commentsUserCount` correspond qu nombre de commentaire poser par l'utilisateur.

## Événement
Il y a deux événement dispatch 

 - `TrophyUnlockedEvent::PRE_CREATE`
 - `TrophyUnlockedEvent::POST_CREATE`
 
Cette événement dispose de plusieurs getter
 - `getBadgeUnlock`
 - `getBadge`
 - `getUser`

## Todo

 - Ajouter des test
 - Ajouter le bundle sur packagist
 - Tester sur plusieurs version de symfony

