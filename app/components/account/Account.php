<?php

namespace ntc\account;

use app\core\component\Component;

class Account extends Component {

  public function render() {
    return $this->display('ntc_account');
  }

}
