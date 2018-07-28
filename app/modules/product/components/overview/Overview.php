<?php

namespace ntc\product\overview;

use app\core\component\Component;
use app\core\entity\Product;
use app\core\http\Request;

class Overview extends Component
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
        return $this->display('ntc/product/overview', [
            'name' => $this->product->name,
            'description' => $this->product->description,
            'price' => $this->product->price,
            'images' => $this->product->images,
        ]);
    }

}