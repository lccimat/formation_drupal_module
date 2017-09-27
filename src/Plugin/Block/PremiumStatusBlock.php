<?php

namespace Drupal\makina\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'PremiumStatusBlock' block.
 *
 * @Block(
 *  id = "premium_status",
 *  admin_label = @Translation("Statut premium de l'utilisateur"),
 * )
 */
class PremiumStatusBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['premium_status']['#theme'] = 'makina_premium_status_block_content';
    if(\Drupal::currentUser()->hasPermission('view_premium')){
      $build['premium_status']['#markup'] = 'Vous pouvez voir les contenus premium';
    }else{
      $build['premium_status']['#markup'] = 'Vous ne pouvez pas voir les contenus premium';
    }
    return $build;
  }

}
