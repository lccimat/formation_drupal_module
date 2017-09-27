<?php
/**
 * Created by PhpStorm.
 * User: mlecain
 * Date: 27/09/2017
 * Time: 11:14
 */

namespace Drupal\makina\Routing\RouteSubscriber;


use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class NodeEditSubscriber extends RouteSubscriberBase  {

  /**
   * Alters existing routes for a specific collection.
   *
   * @param \Symfony\Component\Routing\RouteCollection $collection
   *   The route collection for adding routes.
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('entity.node.edit_form')) {
      //dpm($route->getDefault('_form'));
      //$route->setDefault('_form', '\Drupal\form_overwrite\Form\NewUserLoginForm');
    }
  }

}