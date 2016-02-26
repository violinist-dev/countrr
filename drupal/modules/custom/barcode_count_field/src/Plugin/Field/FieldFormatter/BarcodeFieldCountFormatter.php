<?php

/**
 * @file
 * Contains \Drupal\barcode_count_field\Plugin\Field\FieldFormatter\BarcodeFieldCountFormatter.
 */

namespace Drupal\barcode_count_field\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'barcode_field_count_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "barcode_field_count_formatter",
 *   label = @Translation("Barcode field count formatter"),
 *   field_types = {
 *     "barcode_count_field_type"
 *   }
 * )
 */
class BarcodeFieldCountFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      // Implement default settings.
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return array(
      // Implement settings form.
    ) + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $elements[$delta] = ['#markup' => $this->viewValue($item)];
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    $code = $item->getValue('code');
    return sprintf('%s: %d', $code['code'], $code['count']);
    return nl2br(SafeMarkup::checkPlain($item->value));
  }

}
