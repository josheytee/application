<?php

namespace ntc\section\sectionproductlist;

use app\core\component\Component;
use app\core\entity\Product;
use app\core\entity\Section;
use app\core\http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Sectionproductlist extends Component
{
    private $url;
    private $section;
    private $sectionProducts = [];

    public function init(Request $request)
    {
        if (!isset($request->url)) {
            throw new NotFoundHttpException("url does not exist");
        }
        $this->url = $request->url;
        $this->section = Section::where('url', $this->url)
            ->where('shop_id', $this->currentShop()->id)
            ->first();
        if (is_null($this->section)) {
            throw new NotFoundHttpException("section " . $request->url . " does not exist");
        }
        $this->sectionProducts = Product::where('section_id', $this->section->id ?? 0)->get();
    }

    public function render()
    {
        return $this->display('ntc/section/sectionproductlist', [
            'section' => $this->section,
            'sectionProducts' => $this->sectionProducts
        ]);
    }

}
