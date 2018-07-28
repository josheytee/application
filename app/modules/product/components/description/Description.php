<?php

namespace ntc\product\description;

use app\core\component\Component;
use app\core\entity\Product;
use app\core\http\Request;

class Description extends Component
{
    private $product;

    public function init(Request $request)
    {
        $id = $request->get('id');
        $this->product = Product::find($id);
    }

   public function render(Request $request)
    {
        $this->init($request);
        return $this->display('ntc/product/description');
    }

}