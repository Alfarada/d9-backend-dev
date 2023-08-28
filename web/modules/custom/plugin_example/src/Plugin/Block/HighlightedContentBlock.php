<?php

namespace Drupal\plugin_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Form\FormStateInterface;

/**
 * @Block(
 *   id="highlighted_content_block_example",
 *   admin_label= @Translation("Highlighted Content Example")
 * )
 */
class HighlightedContentBlock extends BlockBase {
  public function build(): array {
    return [
      '#markup' => '<span>' . $this->t('Hightlighted') . '</span>'
    ] ;
  }

  public function blockForm($form, FormStateInterface $form_state): array {
    $form['block_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Display message'),
      '#default_value' => $this->configuration['block_message']
    ];

    $range = range(1, 10);
    $form['block_node_number'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of nodes'),
      '#default_value' => $this->configuration['node_number'],
      '#options' => array_combine($range, $range)
    ];

    return $form;
  }

}