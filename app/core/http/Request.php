<?php

namespace app\core\http;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as BaseRequest;

/**
 * Description of Request
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Request extends BaseRequest {

  public static function createFromBase(BaseRequest $request) {
    if ($request instanceof static) {
      return $request;
    }
    $content = $request->content;
    $request = (new static())->duplicate($request->query->all(), $request->request->all(), $request->attributes->all(), $request->cookies->all(), $request->files->all(), $request->server->all());
    $request->content = $content;
    $request->request = $request->getInputSource();
    return $request;
  }

  /**
   * Determine if the request is sending JSON.
   *
   * @return bool
   */
  public function isJson() {
    return $this->contains($this->headers->get('CONTENT_TYPE'), ['/json', '+json']);
  }

  /**
   * Get the JSON payload for the request.
   *
   * @param  string  $key
   * @param  mixed   $default
   * @return mixed
   */
  public function json($key = null, $default = null) {
    if (!isset($this->json)) {
      $this->json = new ParameterBag((array) json_decode($this->getContent(), true));
    }

    if (is_null($key)) {
      return $this->json;
    }

//    return data_get($this->json->all(), $key, $default);
    return ($this->json->all());
  }

  /**
   * Determine if a given string contains a given substring.
   *
   * @param  string  $haystack
   * @param  string|array  $needles
   * @return bool
   */
  public static function contains($haystack, $needles) {
    foreach ((array) $needles as $needle) {
      if ($needle != '' && strpos($haystack, $needle) !== false) {
        return true;
      }
    }

    return false;
  }

  /**
   * Create a new Illuminate HTTP request from server variables.
   *
   * @return static
   */
  public static function capture() {
    static::enableHttpMethodParameterOverride();

    return static::createFromBase(BaseRequest::createFromGlobals());
  }

  /**
   * Get the input source for the request.
   *
   * @return \Symfony\Component\HttpFoundation\ParameterBag
   */
  protected function getInputSource() {
    if ($this->isJson()) {
      return $this->json();
    }

    return $this->getMethod() == 'GET' ? $this->query : $this->request;
  }

  /**
   * Check if an input element is set on the request.
   *
   * @param  string  $key
   * @return bool
   */
  public function __isset($key) {
    return !is_null($this->__get($key));
  }

  public function __get($key) {
    $all = $this->all();

    if (array_key_exists($key, $all)) {
      return $all[$key];
    } else {
      return $this->get($key);
    }
  }

  /**
   * Retrieve an input item from the request.
   *
   * @param  string  $key
   * @param  string|array|null  $default
   * @return string|array
   */
  public function input($key = null, $default = null) {
    $input = $this->getInputSource()->all() + $this->query->all();
    return $input;
//    return data_get($input, $key, $default);
  }

  /**
   * Get an array of all of the files on the request.
   *
   * @return array
   */
  public function allFiles() {
    $files = $this->files->all();
    return $files;
//    return $this->convertedFiles ? $this->convertedFiles : $this->convertedFiles = $this->convertUploadedFiles($files);
  }

  /**
   * Get all of the input and files for the request.
   *
   * @return array
   */
  public function all() {
    return array_replace_recursive($this->input(), $this->allFiles());
  }

}
