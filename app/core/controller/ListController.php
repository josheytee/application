<?php

namespace app\core\controller;

/**
 * This implementation uses the '_list' request attribute to determine
 * the controller to execute and uses the request attributes to determine
 * the controller method arguments. *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class ListController extends ControllerBase {

  protected $headings;

  public function processHead() {
    return array_keys($this->columnDefinition());
  }

  public function _constructQuery() {
    $keys = array_keys($this->columnDefinition());
    foreach ($keys as $key) {

    }
  }

  public function _constructJION($alias) {

  }

  public function process() {
    $listing = $this->columnDefinition();
    $this->headings = array_keys($listing);
//    dump($this->headings);
    $processed_fields = implode(',', $this->headings);
//    dump($processed_fields);
    foreach ($listing as $fields => $exp) {
      $parts = explode('|', $exp);
//      dump($parts);
      foreach ($parts as $part) {
        list($rule, $value) = explode(':', $part);
        $rule = trim($rule);
        $value = is_string($value) ? trim($value) : $value;
//        dump($rule);
//        dump($value);
        if ($rule == 'callback') {
          call_user_func([$this, $value], '1');
        }
      }
    }
  }

  public function processBody() {
    $doctrine = $this->doctrine();
    $findBy = $doctrine->getRepository('model\User')->findBy($this->processBody());
//    $findBy = $doctrine->getRepository('model\User')->findAll();
    dump($findBy);
  }

  public function listing() {

    $this->process();
    $return['library'] = '';
    $return['content'] = $this->rendertrait(
            [
        'headings' => $this->processHead(),
        'form_body' => $this
            ], 'list/listing.tpl');
    return $return;
  }

  abstract function columnDefinition();
}
