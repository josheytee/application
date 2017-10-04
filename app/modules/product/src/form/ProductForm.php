<?php


namespace ntc\product\form;


use app\core\controller\FormGroup;
use app\core\entity\ProductImage;
use app\core\entity\Section;


class ProductForm extends FormGroup {

    function definition() {
        return [
          'information' => new InformationForm(),
          'prices' => new PriceForm(),
          'seo' => new SEOForm(),
          'quantity' => new QuantitiesForm(),
          'associations' => new AssociationForm(),
          'images' => new ImageForm()
        ];
    }

    public function attributes() {
        return ['enctype' => 'multipart/form-data'];

    }

    function getDependencies() {
        return [
          'section' => Section::class,
          'images' => ProductImage::class];
    }

    function title() {
        return '';
    }
}