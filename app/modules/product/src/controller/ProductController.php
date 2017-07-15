<?php

namespace ntc\product\controller;

use app\core\controller\ControllerBase;
//use Symfony\Component\HttpFoundation\Response;
use app\core\http\Response;
use app\core\http\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\template\TemplateEngineInterface;
use app\core\view\link\LinkManager;

/**
 * Description of ProductController
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProductController extends ControllerBase {

  /**
   * @var LinkManager
   */
  private $link;
  protected $template_engine;
  protected $tab_display;
  private $default_tab = "Information";
  private $tpl_form;
  private $tpl_form_vars;
  private $available_tabs;

  public function __construct(TemplateEngineInterface $templateEngine, LinkManager $link) {
    $this->template_engine = $templateEngine;
    $this->link = $link;
    $this->tab_display;
    $this->tpl_form_vars['identifier'] = 1;
    $this->available_tabs_lang = array(
        'Information' => $this->l('Information'),
//        'Pack' => $this->l('Pack'),
//        'VirtualProduct' => $this->l('Virtual Product'),
        'Prices' => $this->l('Prices'),
        'Seo' => $this->l('SEO'),
        'Images' => $this->l('Images'),
        'Associations' => $this->l('Associations'),
        'Shipping' => $this->l('Shipping'),
//        'Combinations' => $this->l('Combinations'),
        'Features' => $this->l('Features'),
//        'Customization' => $this->l('Customization'),
        'Attachments' => $this->l('Attachments'),
        'Quantities' => $this->l('Quantities'),
        'Suppliers' => $this->l('Suppliers'),
        'Warehouses' => $this->l('Warehouses'),
    );
    $this->available_tabs = array('Quantities' => 6, 'Warehouses' => 14);
    $this->available_tabs = array_merge($this->available_tabs, array(
        'Information' => 0,
//        'Pack' => 7,
//        'VirtualProduct' => 8,
        'Prices' => 1,
        'Seo' => 2,
        'Associations' => 3,
        'Images' => 9,
        'Shipping' => 4,
//        'Combinations' => 5,
        'Features' => 10,
//        'Customization' => 11,
        'Attachments' => 12,
        'Suppliers' => 13,
    ));
    asort($this->available_tabs, SORT_NUMERIC);
    $this->tpl_form_vars['product_tabs'] = $this->available_tabs;
  }

  public static function inject(ContainerInterface $container) {
    return new static(
            $container->get('template.engine'), $container->get('link.manager')
    );
  }

  public function index() {
    return new Response('hello index page');
  }

  public function initContent($tab) {

    $product_tabs = array();
    $this->tab_display = $tab;
// tab_display defines which tab to display first
    if (!method_exists($this, 'initForm' . $this->tab_display)) {
      $this->tab_display = $this->default_tab;
    }

    if (method_exists($this, 'initForm' . $this->tab_display)) {
      $this->tpl_form = strtolower($this->tab_display) . '.tpl';
    }
    foreach ($this->available_tabs as $product_tab => $value) {

      $product_tabs[$product_tab] = array(
          'id' => $product_tab,
          'selected' => (strtolower($product_tab) == strtolower($this->tab_display) ),
          'name' => $this->available_tabs_lang[$product_tab],
          'href' => $this->link->route('admin.product.add', $product_tab),
      );
    }
    $this->tpl_form_vars['product_tabs'] = $product_tabs;
  }

  public function renderForm($tab) {
//      echo $this->tab_display;
    $manager = $this->getContainer()->get('entity.manager')->getRepository('model\Product')->find(1);
    $this->object = $manager;
    if (!method_exists($this, 'initForm' . $this->tab_display)) {
      return;
    }
//      $this->initPack($this->object);

    $this->{'initForm' . $tab}($this->object);
    $this->tpl_form_vars['product'] = $this->object;
//    $this->tpl_form_vars['tabs_preloaded'] = $this->available_tabs;
  }

  public function add(Request $request) {
    $this->initContent($request->tab);
    $this->renderForm($request->tab);
    return $this->render($this->getTemplate(__DIR__, 'form.tpl'), $this->tpl_form_vars);
  }

  public function edit(Request $request) {

    return $this->render($this->getTemplate(__DIR__, 'form.tpl'), $this->tpl_form_vars);
  }

  public function initFormInformation($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->object = $product;
//    $data->assign('product_type', (int) Tools::getValue('type_product', $product->getType()));
//      $data->assign('is_in_pack', (int) Pack::isPacked($product->id));

    $data->assign(array(
//      'ad' => dirname($_SERVER['PHP_SELF']),
//      'iso_tiny_mce' => $iso_tiny_mce,
//      'check_product_association_ajax' => $check_product_association_ajax,
//      'id_lang' => $this->context->language->id,
        'product' => $product,
//      'token' => $this->token,
//      'currency' => $currency,
//      'link' => $this->context->link,
//      'PS_PRODUCT_SHORT_DESC_LIMIT' => Configuration::get('PS_PRODUCT_SHORT_DESC_LIMIT') ? Configuration::get('PS_PRODUCT_SHORT_DESC_LIMIT') : 400
    ));
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormPrices($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->object = $product;
    $data->assign([
        'product' => $product,
    ]);
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormAssociations($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->object = $product;
    $data->assign([
        'product' => $product,
    ]);
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormQuantities($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormWarehouses($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormAttachments($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormSeo($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormImages($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));

    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormShipping($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));

    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormPack($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormVirtualProduct($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));

    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormCombinations($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));

    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormFeatures($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));
    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormSuppliers($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));

    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initFormCustomization($product) {
    $data = $this->template_engine->makeTemplate($this->getTemplate(__DIR__, $this->tpl_form));

    $this->tpl_form_vars['custom_form'] = $data->fetch();
  }

  public function initPack(Product $product) {

  }

}
