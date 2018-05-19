<?php

namespace ntc\section\sections;

use app\core\component\Component;
use app\core\entity\Section;
use app\core\http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Sections extends Component
{
    private $name;

    public function init(Request $request)
    {
        if (!isset($request->url)) {
            throw new NotFoundHttpException();
        }
        $this->name = $request->url;
//        dump(Section::where('name', $this->name)->first());
//        dump($this->name);
    }

    public function render()
    {

        return $this->display('ntc/section/sections', [
            'name' => ''
        ]);
    }

}