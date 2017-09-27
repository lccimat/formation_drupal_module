<?php
/**
 * Created by PhpStorm.
 * User: mlecain
 * Date: 26/09/2017
 * Time: 15:30
 */

namespace Drupal\makina\Routing\RouteSubscriber;


use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class DenyUserEditSubscriber extends RouteSubscriberBase  {

  /**
   * Alters existing routes for a specific collection.
   *
   * @param \Symfony\Component\Routing\RouteCollection $collection
   *   The route collection for adding routes.
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('entity.user.edit_form')) {
      $route->setRequirement('_access', 'FALSE');
    }
  }
}