<?php

namespace app\core\view;

use app\core\view\Renderable;
use app\core\template\TemplateEngineInterface;
use app\core\theme\ThemeManagerInterface;
use app\core\http\Response;

/**
 * Description of ViewManager
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ViewManager implements Renderable {

  protected $template_engine;
  protected $theme_manager;

  public function __construct(TemplateEngineInterface $templateEngine, ThemeManagerInterface
  $themeManager) {
    $this->template_engine = $templateEngine;
    $this->theme_manager = $themeManager;
  }

  public function display($content = null, $tpl = null) {
    $this->theme_manager = new ThemeManager();
    $smarty = Context::smarty();
    foreach ($this->theme_manager->getActiveTheme() as $path) {
      $template = $path . DS . 'templates' . DS . $tpl;
      $tpl = $smarty->createAndFetch($template, $content);
    }
    return new Response($tpl);
  }

  public function render($template, $data = null) {
    $active_theme = $this->theme_manager->getActiveTheme();

    $this->template_engine->output($template, $data);
  }

}
