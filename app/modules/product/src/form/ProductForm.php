<?php


namespace ntc\product\form;


use app\core\controller\FormGroup;


class ProductForm extends FormGroup {

    function definition() {
        return [
            'information' => new InformationForm(),
            'price' => new PriceForm(),
            'seo' => new SEOForm(),
            'quantity' => new QuantitiesForm(),
            'associations' => new AssociationForm()
        ];
    }

    function title() {
        return '';
    }
}