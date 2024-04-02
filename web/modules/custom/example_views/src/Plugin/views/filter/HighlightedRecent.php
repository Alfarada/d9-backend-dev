<?php

namespace Drupal\example_views\Plugin\views\filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\filter\FilterPluginBase;

/**
 * @ViewsFilter ("highlighted_recent")
 */
class HighlightedRecent extends FilterPluginBase {

  public function adminSummary() { }

  protected function operatorForm(&$form, FormStateInterface $form_state) { }

  public function canExpose () {
    return FALSE;
  }

  public function query() {
    $table = $this->ensureMyTable();
    $currentTime = \Drupal::time()->getCurrentTime();
    // descontamos 3 días de la fecha actual
    $minTime = $currentTime - (3 * 24 * 3600);
    $snippet = "$table.highlighted = 1 AND node_field_data.changed > $minTime";
    $this->query->addWhereExpression($this->options['group'], $snippet);
  }
}