<?php

namespace ntc\administrator\controller;

use app\core\controller\ListController;

/**
 * Description of Listing
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Listing extends ListController {

  public function columnDefinition() {
    return [
        'id_user' => 'title: ID | callback: idf',
        'firstname' => 'title: ID | callback: name'
    ];
  }

  public function name($param) {

  }

  public function idf($param) {

  }

}
