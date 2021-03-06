<?php

namespace api\app;

use api\app\type\Mutation;
use api\app\type\object\Category;
use api\app\type\object\Product;
use api\app\type\object\Section;
use api\app\type\object\Shop;
use api\app\type\object\User;
use api\app\type\Query;
use api\app\type\scalar\Email;
use GraphQL\Examples\Blog\Type\Field\HtmlField;
use GraphQL\Examples\Blog\Type\Scalar\UrlType;
use GraphQL\Type\Definition\Type;

/**
 * Description of Types
 *
 * @author Tobi
 */
class Types
{

    private static $user;
    private static $shop;
    private static $category;
    private static $section;
    private static $product;
    private static $query;
    private static $mutation;

    public static function user()
    {
        return self::$user ?: (self::$user = new User());
    }

    public static function shop()
    {
        return self::$shop ?: (self::$shop = new Shop());
    }

    public static function category()
    {
        return self::$category ?: (self::$category = new Category());
    }

    public static function section()
    {
        return self::$section ?: (self::$section = new Section());
    }

    public static function product()
    {
        return self::$product ?: (self::$product = new Product());
    }

    public static function query()
    {
        return self::$query ?: (self::$query = new Query());
    }

    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new Mutation());
    }

// Custom Scalar types:
    private static $urlType;
    private static $email;

    public static function email()
    {
        return self::$email ?: (self::$email = new Email());
    }

    /**
     * @return UrlType
     */
    public static function url()
    {
        return self::$urlType ?: (self::$urlType = new UrlType());
    }

    /**
     * @param $name
     * @param null $objectKey
     * @return array
     */
    public static function htmlField($name, $objectKey = null)
    {
        return HtmlField::build($name, $objectKey);
    }

    public static function listOf($type)
    {
        return Type::listOf($type);
    }

}
