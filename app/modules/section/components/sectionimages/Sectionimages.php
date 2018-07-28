<?php

namespace ntc\section\sectionimages;

use app\core\component\Component;
use app\core\entity\Section;
use app\core\http\Request;

class Sectionimages extends Component
{

    public function render(Request $request)
    {
        $section = Section::where('url', $request->section_url)->first();
        $images = $section->images;
        return $this->display('ntc/section/sectionimages', compact('images'));
    }

    public function renderWithParams($images)
    {
        return $this->display('ntc/section/sectionimages', compact('images'));

    }
}