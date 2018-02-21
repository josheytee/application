<?php

namespace ntc\shop\navigation;

use app\core\component\Component;
use app\core\entity\Section;
use app\core\http\Request;
use app\core\view\form\Formbuilder;
use app\core\view\form\Submit;
use app\core\view\form\Text;

class Navigation extends Component
{

    private $themeManager;

    public function init(Request $request)
    {
//        dump($this->themeManager());
        $this->themeManager = $this->themeManager();
    }

    public function configure(Request $request, Formbuilder $builder)
    {
        $builder->add('name', Text::class);
        $builder->add('submit', Submit::class);
        return parent::configure($request, $builder);
    }

    public function processConfigure(Request $request, Formbuilder $builder)
    {

        if ($request->isValid(['name' => 'required']) === true) {
            dump($request->all());
            $this->themeManager->setConfig(['components' => [$this->getName() => $request->name]]);
        }
    }

    public function render()
    {
        $sections = Section::where('shop_id', $this->currentShop()->id)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();
        return $this->display('ntc/shop/navigation', compact('sections'));
    }

}
