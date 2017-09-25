<?php


namespace ntc\product\form;


use app\core\controller\FormGroup;


class ProductForm extends FormGroup {

    function definition() {
        return [
            'information' => new InformationForm(),
            'prices' => new PriceForm(),
            'seo' => new SEOForm(),
            'quantity' => new QuantitiesForm(),
            'associations' => new AssociationForm()
        ];
    }

    public function attributes() {
        return ['enctype' => 'multipart/form-data'];

    }

    function title() {
        return '';
    }
}