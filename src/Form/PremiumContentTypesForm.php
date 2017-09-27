<?php

namespace Drupal\makina\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\NodeType;

/**
 * Class PremiumContentTypesForm.
 */
class PremiumContentTypesForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'makina.premiumcontenttypes',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'premium_content_types_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('makina.premiumcontenttypes');
    dpm($config->getRawData());
    $node_types = NodeType::loadMultiple();
    $options = [];
    foreach($node_types as $node_type_id => $node_type){
      $options[$node_type_id] = $node_type->label();
    }

    $default_value = $config->get('content_types');
    $form['content_types'] = array(
      '#type' => 'checkboxes',
      '#title' => 'Types de contenu pour lesquels le premium est activé',
      '#options' => $options,
      '#default_value' => (isset($default_value) ? $default_value : [])
    );

    $form['testusr'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'user',
      '#title' => 'test auto user'
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    //parent::validateForm($form, $form_state);
    $selected = $form_state->getValue('content_types');
    if($selected['page'] === 'page'){
      $form_state->setErrorByName('content_types', t('You should not select \'page\' content type'));
    }
    dpm($form_state->getValue('testusr'));
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $vals = $form_state->getValue('content_types');
    $conf = $this->config('makina.premiumcontenttypes');
    $conf->set('content_types', $vals);
    $conf->save();
    $form_state->setRedirect('system.admin_config');
  }

}
