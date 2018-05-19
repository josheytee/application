<?php

namespace ntc\dashboard\controller;

use app\core\controller\ControllerBase;
use app\core\http\Response;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class DashBoardController extends ControllerBase
{

    public function index()
    {
        return $this->render('ntc/output',['output'=>'lemkzl']);
    }

}
