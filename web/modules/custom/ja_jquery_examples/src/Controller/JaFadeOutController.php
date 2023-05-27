<?php

namespace Drupal\ja_jquery_examples\Controller;

use Drupal\Core\Controller\ControllerBase;

class JaFadeOutController extends ControllerBase {

  public function fadeout() {
    $build['text'] = [
      '#markup' => '<p>' . $this->t('Lorem ipsum dolor sit amet, consectetur
        adipiscing elit. Duis tristique enim lorem, quis imperdiet ante luctus non.
        Phasellus sapien neque, placerat sed odio ut, efficitur tincidunt dui.') . '</p>',
    ];

    $build['temp_text'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#attributes' => [
        'class' => 'fadeout',
      ],
      '#value' => $this->t('This text will disappear in 5 seconds...'),
      '#attached' => [
        'library' => [
          'ja_jquery_examples/ja_jquery.js',
        ],
      ],
    ];

    // Añadiendo la dependencia con la librería core/drupalSettings,
    // podemos añadir variables al código
    // JavaScript desde PHP.

    // .libraries.yml

    // cuddly-slider:
    // version: 1.x
    // js:
    // js/cuddly-slider.js: {}
    // dependencies:
    // - core/jquery
    // - core/drupalSettings

    // Desde PHP, igual que añadimos la librería con #attached, también podemos pasar los parámetros al
    // código JavaScript:

    // $build['#attached']['library'][] = 'example_module/cuddly-slider';
    // $build['#attached']['drupalSettings']['example_module']['cuddlySlider']['foo'] = 'bar';

    // Dentro del archivo JS, se podrá acceder a la variable 'foo' de esta forma:
    // drupalSettings.example_module.cuddlySlider.foo
    // En este ejemplo el valor de la variable será 'bar'.

    $build['paragraph_1'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#attributes' => [
        'class' => 'paragraph_1',
      ],
      '#value' => $this->t('paragraph_1 example jquery'),
    ];

    $build['paragraph_2'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#attributes' => [
        'class' => 'paragraph_2',
      ],
      '#value' => $this->t('paragraph_2 examplee.... vanilla js')
    ];


    return $build;
  }

}
