<?php

/**
 * @file
 * Contains \Drupal\barcode_count_field\Plugin\Field\FieldType\BarcodeCountFieldType.
 */

namespace Drupal\barcode_count_field\Plugin\Field\FieldType;

use Behat\Mink\Exception\Exception;
use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslationWrapper;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'barcode_count_field_type' field type.
 *
 * @FieldType(
 *   id = "barcode_count_field_type",
 *   label = @Translation("Barcode count field type"),
 *   description = @Translation("Barcode count field type"),
 *   default_widget = "barcode_field_widget",
 *   default_formatter = "barcode_field_count_formatter"
 * )
 */
class BarcodeCountFieldType extends FieldItemBase {
  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return array(
      'max_length' => 255,
    ) + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Prevent early t() calls by using the TranslationWrapper.
    $properties['code'] = DataDefinition::create('string')
      ->setLabel(t('Barcode'))
      ->setRequired(TRUE);

    $properties['count'] = DataDefinition::create('integer')
      ->setLabel(t('Count'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = array(
      'columns' => array(
        'code' => array(
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
        ),
        'count' => array(
          'type' => 'int',
          'size' => 'normal',
          'unsigned' => TRUE,
        ),
      ),
    );

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();

    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $values['code'] = $random->word(mt_rand(1, $field_definition->getSetting('max_length')));
    $values['count'] = mt_rand(10, 1000);
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $elements = [];

    $elements['max_length'] = array(
      '#type' => 'number',
      '#title' => t('Maximum length'),
      '#default_value' => $this->getSetting('max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    );

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $code = $this->get('code')->getValue();
    $count = $this->get('count')->getValue();
    return $code === NULL || $code === '' || $count === NULL;
  }

}
