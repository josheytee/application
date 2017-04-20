<?php

namespace app\admin\page;

use app\core\Page;
use app\core\service\Graphql;
use app\core\exception\GraphqlException;

/**
 * Description of Product
 *
 * @author Tobi
 */
class Product extends Page {

    public function initPage() {
        parent::initPage();
        try {
            $query = '
  {
  shop(id: 1) {
    id
    name
    sections {
      name
      products {
        id
        name
        price
        section {
          name
        }
        availability
      }
    }
  }
}';
            $gr = new Graphql();
            $q = $gr->query($query);
            $raw = json_decode($q, true);
//var_dump($raw);
            $arrayFinder = new \Shudrum\Component\ArrayFinder\ArrayFinder($raw);
            $products = $arrayFinder->get('data.shop.sections.0.products');
            $s = [
                'fields' => [
                    'id' => [
                        'type' => 'hidden',
                        'class' => 'fixed-width-xl',
                        'label' => 'ID',
                        'name' => 'ID',
                        'hidden' => true
                    ],
                    'name' => [
                        'type' => 'text',
                        'class' => 'fixed-width-xl',
                        'label' => 'Name',
                        'name' => 'Name',
                        'required' => true
                    ],
                    'price' => [
                        'type' => 'number',
                        'class' => 'fixed-width-xl',
                        'label' => 'Price',
                        'name' => 'Price',
                        'required' => true
                    ],
                    'availability' => [
                        'type' => 'number',
                        'class' => 'fixed-width-xl',
                        'label' => 'Availability',
                        'name' => 'Availability',
                        'form' => 'textarea',
                        'callback' => function () {

                        }
                    ],
                    'actions' => [
                        'edit',
                        'preview',
                        'delete'
                    ]
                ]
            ];
            $options = [
                'name' => 'Product',
                'form' => [
                    'action' => '',
                    'method' => 'post',
                    'submit' => [
                            [
                            'value' => 'save',
                            'name' => 'Product',
                        ],
                            [
                            'value' => 'save and stay ',
                            'name' => 'Product',
                        ]
                    ]
                ]
            ];

            $this->registerComponent(new \app\admin\component\defaultbootstrap\EntityPack\EntityPack($s, $products, $options));
            $sma = '{  user {    current_shop {      id      name    }  }}';
            $this->registerComponent(new \app\admin\component\defaultbootstrap\TopNavPanel\TopNavPanel(), self::POSITION_HEADER);

            $this->setTheme(new \app\core\theme\AdminBootstrapTheme());
        } catch (GraphqlException $e) {
            var_dump($this->components);
            echo $e->getMessage();
        }
    }

}
