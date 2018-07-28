<?php

namespace ntc\section\section;

use app\core\component\Component;
use app\core\entity\Section as SectionModel;
use app\core\http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Section extends Component
{
    public function render(Request $request)
    {
        $section_url = $request->section_url;
        $section = SectionModel::where('url', $section_url)->first();
        $name = $section->name;
        $images = $section->images;
        $products = $section->products;
        return $this->display('ntc/section/section', [
            'name' => $name,
            'images' => $images,
            'products' => $products
        ]);
    }

}