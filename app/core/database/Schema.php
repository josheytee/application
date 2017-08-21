<?php

namespace app\core\database;

use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Description of Schema
 *
 * @author adapter
 */
class Schema {

    /**
     * List of field types
     */
    const TYPE_INT = 1;
    const TYPE_BOOL = 2;
    const TYPE_STRING = 3;
    const TYPE_FLOAT = 4;
    const TYPE_DATE = 5;
    const TYPE_HTML = 6;
    const TYPE_NOTHING = 7;
    const TYPE_SQL = 8;

    /**
     * List of data to format
     */
    const FORMAT_COMMON = 1;
    const FORMAT_LANG = 2;
    const FORMAT_SHOP = 3;

    /**
     * List of association types
     */
    const HAS_ONE = 1;
    const HAS_MANY = 2;

    public $definition = array(
        'table' => 'product',
        'primary' => 'id_product',
        'multilang_shop' => true, 'multilang' => true,
        'fields' => array(
            /* Classic fields */
            'id_category' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'name' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'required' => true, 'size' => 128),
            //ment to be self::TYPE_HTML for decriptions
            'description' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml'),
            'location' => array('type' => self::TYPE_STRING, 'validate' => 'isReference', 'size' => 64),
            'width' => array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
            'height' => array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
            'depth' => array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
            'weight' => array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
            'quantity_discount' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'is_virtual' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            /* Shop fields */
            'active' => array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
            'minimal_quantity' => array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedInt'),
            'quantity' => array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedInt'),
            'price' => array('type' => self::TYPE_FLOAT, 'shop' => true, 'validate' => 'isPrice', 'required' => true),
            'online_only' => array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
            'wholesale_price' => array('type' => self::TYPE_FLOAT, 'shop' => true, 'validate' => 'isPrice'),
            'meta_description' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
            'show_price' => array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
            'available_date' => array('type' => self::TYPE_DATE, 'shop' => true, 'validate' => 'isDateFormat'),
            'available_for_order' => array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
            'condition' => array('type' => self::TYPE_STRING, 'shop' => true, 'validate' => 'isGenericName', 'values' => array('new', 'used', 'refurbished'), 'default' => 'new'),
            'meta_keywords' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
            'meta_title' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 128),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate')
        )
    );

    public function build($filename, $defination) {
        $dumper = new Dumper();
        $yaml = $dumper->dump($definition, 2);
        file_put_contents(__DIR__ . '/../../model/schema/product_schema.yml', $yaml);
    }

    public function collect($filename) {
        try {
            $yaml = new Parser();
            $value = $yaml->parse(file_get_contents(__DIR__ . '/../../model/schema/' . $filename));
            return $value;
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
    }

}
