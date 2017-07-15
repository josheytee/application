<?php

namespace app\core\http;

use Symfony\Component\HttpFoundation\Response as BaseResponse;

/**
 * Description of Response
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Response extends BaseResponse {

  protected $original;

  /**
   * Get the original response content.
   *
   * @return mixed
   */
  public function getOriginalContent() {
    return $this->original;
  }

  /**
   * Set a header on the Response.
   *
   * @param  string  $key
   * @param  string  $value
   * @param  bool    $replace
   * @return $this
   */
  public function header($key, $value, $replace = true) {
    $this->headers->set($key, $value, $replace);

    return $this;
  }

  /**
   * Set the content on the response.
   *
   * @param  mixed  $content
   * @return $this
   */
  public function setContent($content) {
    $this->original = $content;

    // If the content is "JSONable" we will set the appropriate header and convert
    // the content to JSON. This is useful when returning something like models
    // from routes that will be automatically transformed to their JSON form.
    if ($this->shouldBeJson($content)) {
      $this->header('Content-Type', 'application/json');

      $content = $this->morphToJson($content);
    }

    // If this content implements the "Renderable" interface then we will call the
    // render method on the object so we will avoid any "__toString" exceptions
    // that might be thrown and have their errors obscured by PHP's handling.
//    elseif ($content instanceof Renderable) {
//      $content = $content->render();
//    }

    return parent::setContent($content);
  }

  /**
   * Morph the given content into JSON.
   *
   * @param  mixed   $content
   * @return string
   */
  protected function morphToJson($content) {
//    if ($content instanceof Jsonable) {
//      return $content->toJson();
//    }

    return json_encode($content);
  }

  /**
   * Determine if the given content should be turned into JSON.
   *
   * @param  mixed  $content
   * @return bool
   */
  protected function shouldBeJson($content) {
    return
//    $content instanceof Jsonable ||
            $content instanceof \ArrayObject ||
            $content instanceof \JsonSerializable ||
            is_array($content);
  }

}
