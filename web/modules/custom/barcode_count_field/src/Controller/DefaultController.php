<?php

/**
 * @file
 * Contains \Drupal\barcode_count_field\Controller\DefaultController.
 */

namespace Drupal\barcode_count_field\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\RouteProvider;
use Drupal\views\Plugin\views\display\Page;

/**
 * Class DefaultController.
 *
 * @package Drupal\barcode_count_field\Controller
 */
class DefaultController extends ControllerBase {
  /**
   * history.
   *
   * @return string
   *   Return Hello string.
   */
  public function history($user) {
    $view_id = 'user_batch_history';
    $display_id = 'page_1';
    $class = 'Drupal\views\Plugin\views\display\Page';
    /** @var RouteProvider $route_provider */
    $route_provider = \Drupal::service('router.route_provider');
    $route = $route_provider->getRouteByName('view.user_batch_history.page_1');
    $build = $class::buildBasicRenderable($view_id, $display_id, [], $route);
    Page::setPageRenderArray($build);

    views_add_contextual_links($build, 'page', $display_id, $build);

    return $build;
  }

}
