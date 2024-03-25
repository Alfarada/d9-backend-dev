<?php

namespace Drupal\example_views\Plugin\views\sort;

use Drupal\views\Plugin\views\sort\SortPluginBase;

/**
 * Ordenacion por destacado y fecha de modificacion desc
 *
 * @ViewsSort ("highlighted_order")
 */
class HighlightedOrder extends SortPluginBase {

  /**
   * Called to add  the sort to a query.
   */

  public function query() {
    $this->ensureMyTable();

    // los nodos destacados siempre se mostraran en primer lugar
    $this->query->addOrderBy('forcontu_node_highlighted', 'highlighted', 'DESC');
    // el orden por fecha se establece en la configuracion del filtro
    $this->query->addOrderBy('node_field_data', 'changed', $this->options['order']);
  }

}