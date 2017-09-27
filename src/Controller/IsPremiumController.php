<?php

namespace Drupal\makina\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\user\Entity\Role;
use Drupal\user\Entity\User;

/**
 * Class IsPremiumController.
 */
class IsPremiumController extends ControllerBase {

  /**
   * Showstatus.
   *
   * @return string
   *   Return Hello string.
   */
  public function showstatus() {
    if(\Drupal::currentUser()->hasPermission('view_premium')) {
      return [
        '#type' => 'markup',
        '#markup' => $this->t('You can view premium content')
      ];
    }else{
      return [
        '#type' => 'markup',
        '#markup' => $this->t('You cannot view premium content')
      ];
    }

  }
  /**
   * Showuserstatus.
   *
   * @return string
   *   Return Hello string.
   */
  public function showuserstatus(User $user) {
    if($user->hasPermission('view_premium')){
      return [
        '#type' => 'markup',
        '#markup' => $this->t('User %name can view premium content', ['%name'=>$user->getUsername()]),
      ];
    }else{
      return [
        '#type' => 'markup',
        '#markup' => $this->t('User %name cannot view premium content', ['%name'=>$user->getUsername()]),
      ];
    }
  }

  /**
   * Premiumpage.
   *
   * @return string
   *   Return Hello string.
   */
  public function premiumpage() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Lorem ipsum'),
    ];
  }


  public function listPremiumUsers(){

    $roles = Role::loadMultiple();
    $role_list = [];
    foreach ($roles as $role => $roleObj) {
      if ($roleObj->hasPermission("view_premium")) {
        $role_list[] = $role;
      }
    }

    $resultIds = \Drupal::entityQuery('user')->condition('roles', $role_list, 'IN')->execute();
    dpm($resultIds);
    $rows = [];
    $users = User::loadMultiple($resultIds);
    foreach($users as $uid => $uitem){
      $url = Url::fromRoute('entity.user.canonical', ['user' => $uid]);
      $row = [
        Link::fromTextAndUrl($uitem->getDisplayName(), $url)
      ];
      $rows[] = $row;
    }

    $table = [
      '#theme' => 'table',
      '#header' =>['Utilisateur'],
      '#rows' => $rows
    ];

    return ['tableau_utilisateurs' => $table];
  }

}
