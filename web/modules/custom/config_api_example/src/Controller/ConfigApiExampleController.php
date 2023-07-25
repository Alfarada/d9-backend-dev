<?php

namespace Drupal\config_api_example\Controller;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\State\StateInterface;

/**
 * Returns responses for config_api_example routes.
 */
class ConfigApiExampleController extends ControllerBase {

  /**
   * Constructs a VisitsCounterController object.
   *
   * @param \Drupal\Core\State\StateInterface $state
   *   The state object.
   */
  public function __construct(
    protected StateInterface $state,
    protected ConfigFactoryInterface $state_factory
  ) { }

  /**
   * {@inheritdoc}
   */
  public static function create(\Symfony\Component\DependencyInjection\ContainerInterface $container) {
    return new static(
      $container->get('state'),
      $container->get('config.factory')
    );
  }

  /**
   *
   * Aparentemente no se muestra correctamente la cantidad de visitantes
   * por que drupal almacena en cache la variable de estado y no la
   * vuelve a cargar a menos que se limpie la cache, por eso es mejor
   * almacenar ese contador en la base de datos.
   */
  public function build() {
    $count = $this->getVisitCount();

    // Increment the visit count.
    $count++;

    // Update the visit count in the state.
    $this->state->set('visits_counter.count', $count);

    // Return the visit count.
    return [
      '#markup' => $this->t("Number of visits: @count", ['@count' => $count]),
    ];
  }

  /**
   * Get the current visit count.
   *
   * @return int
   *   The visit count.
   */
  protected function getVisitCount() {
    return $this->state->get('visits_counter.count', 0);
  }

  public function getConfig(): array {
    /** esto devuelve un objeto inmutable */
    $config = \Drupal::config('system.date');
    dpm($config->get('timezone'));
    return [];
  }

  public function getConfigWithService(): array {

    // establecer variables de configuracion
    $config = $this->state_factory->getEditable('system.date');
    $config->set('country.default', 'EC');
    $timezone = ['warn' => TRUE, 'default' => 1, 'configurable' => 1];
    $config->set('timezone.user', $timezone);
    $config->save();

    // eliminar variables especificas de la configuracion
//    $config = $this->state_factory->getEditable('system.date');
//    $config->clear('country.default');
//    $config->clear('timezone.user');
//    $config->save();
//
    // eliminar todas las variables de configuracion
    // no se necesita llamar al metodo save()
//    $this->state_factory->getEditable('system.date')->delete();

    return [];
  }
}
