<?php

namespace ntc\section\card;

use app\core\component\Component;
use app\core\entity\Section;
use app\core\http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Card extends Component
{
   public function render(Request $request)
    {

        return $this->display('ntc/section/card', [
            'sections' => Section::all()
        ]);
    }

}