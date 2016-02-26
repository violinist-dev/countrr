<?php

/**
 * @file
 * Contains \Drupal\barcode_count_field\Plugin\Field\FieldWidget\BarcodeFieldWidget.
 */

namespace Drupal\barcode_count_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'barcode_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "barcode_field_widget",
 *   label = @Translation("Barcode field widget"),
 *   field_types = {
 *     "barcode_count_field_type"
 *   }
 * )
 */
class BarcodeFieldWidget extends WidgetBase {
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'size' => 60,
      'placeholder' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    $elements['size'] = array(
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    );
    $elements['placeholder'] = array(
      '#type' => 'textfield',
      '#title' => t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    );

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t('Textfield size: !size', array('!size' => $this->getSetting('size')));
    if (!empty($this->getSetting('placeholder'))) {
      $summary[] = t('Placeholder: @placeholder', array('@placeholder' => $this->getSetting('placeholder')));
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = [];

    $element['code'] = [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->code) ? $items[$delta]->code : NULL,
      '#size' => $this->getSetting('size'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#maxlength' => $this->getFieldSetting('max_length'),
      '#description' => $this->t('Barcode'),
    ];

    $element['count'] = [
      '#type' => 'number',
      '#default_value' => isset($items[$delta]->count) ? $items[$delta]->count : NULL,
      '#placeholder' => $this->getSetting('placeholder'),
      '#description' => $this->t('Count'),
    ];

    return $element;
  }

}
