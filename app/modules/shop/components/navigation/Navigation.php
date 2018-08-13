<?php

namespace ntc\shop\navigation;

use app\core\component\Component;
use app\core\entity\Section;
use app\core\entity\Shop;
use app\core\http\Request;
use app\core\view\form\Formbuilder;
use app\core\view\form\Submit;
use app\core\view\form\Text;

class Navigation extends Component
{

    private $themeManager;
    private $shop_url;

    public function init(Request $request)
    {
        $this->shop_url = $request->get('shop_url');
        $this->themeManager = $this->themeManager();
    }

    public function configure(Request $request, Formbuilder $builder)
    {
        $builder->add('name', Text::class);
        $builder->addSubmit('submit');
        return parent::configure($request, $builder);
    }

    public function processConfigure(Request $request, Formbuilder $builder)
    {

        if ($request->isValid(['name' => 'required']) === true) {
            dump($request->all());
            $this->themeManager->setConfig(['components' => [$this->getName() => $request->name]]);
        }
    }

    public function render(Request $request)
    {
        $this->init($request);
        if (isset($this->shop_url)) {
            $shop = Shop::where('url', $this->shop_url)->first();
            $sections = $shop->sections()
                ->orderBy('name', 'asc')
                ->take(10)
                ->get();
            return $this->display('ntc/shop/navigation', ['sections' => $sections,
                'shop_url' => $this->shop_url]);
        }
    }

}
