<?php


namespace ntc\administrator\controller;

use app\core\controller\ControllerBase;
use app\core\http\Request;

class AdminUtilityController extends ControllerBase
{
    public function FileUpload(Request $request)
    {
      dump($request->all());
    }
}