<?php


namespace ntc\product\form;


use app\core\controller\FormGroup;
use app\core\entity\Product;

class ProductForm extends FormGroup {

    function definition() {
        return [
            'information' => new InformationForm(),
            'price' => new PriceForm(),
        ];
    }

    function title() {
        return '';
    }

    function model() {
        return Product::class;
    }

  
}