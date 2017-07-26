<?php

namespace Drupal\geolocation_address_bridge\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AdminSettingsForm.
 *
 * @package Drupal\geolocation_address_bridge\Form
 */
class AdminSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'geolocation_address_bridge.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admin_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('geolocation_address_bridge.adminsettings');
    $form['gab_form_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Form Id'),
      '#description' => $this->t('The form ID that you&#039;d like to make the Address to Geolocation for. Do not add the trailing _form or _edit_form '),
      '#maxlength' => 128,
      '#size' => 64,
      '#default_value' => $config->get('gab_form_id'),
    ];
    $form['gab_geolocation_field_machine_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Geolocation Field Machine Name'),
      '#description' => $this->t('The field machine name for the Geolocation field of the above form.'),
      '#maxlength' => 128,
      '#size' => 64,
      '#default_value' => $config->get('gab_geolocation_field_machine_name'),
    ];
      $form['gab_address_field_machine_name'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Address Field Machine Name'),
          '#description' => $this->t('The field machine name for the Address field of the above form.'),
          '#maxlength' => 128,
          '#size' => 64,
          '#default_value' => $config->get('gab_address_field_machine_name'),
      ];

      $form['gab_address_default_lon'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Default Longitude'),
          '#description' => $this->t('This will be used when there is no result be Google is found on the first save.'),
          '#maxlength' => 128,
          '#size' => 64,
          '#default_value' => $config->get('gab_address_default_lon'),
      ];
      $form['gab_address_default_lat'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Default Latitude'),
          '#description' => $this->t('This will be used when there is no result be Google is found on the first save.'),
          '#maxlength' => 128,
          '#size' => 64,
          '#default_value' => $config->get('gab_address_default_lat'),
      ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('geolocation_address_bridge.adminsettings')
      ->set('gab_form_id', $form_state->getValue('gab_form_id'))
      ->set('gab_geolocation_field_machine_name', $form_state->getValue('gab_geolocation_field_machine_name'))
      ->set('gab_address_field_machine_name', $form_state->getValue('gab_address_field_machine_name'))
      ->set('gab_address_default_lon', $form_state->getValue('gab_address_default_lon'))
      ->set('gab_address_default_lat', $form_state->getValue('gab_address_default_lat'))
      ->save();
  }

}
