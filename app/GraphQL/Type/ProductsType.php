<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 21/10/2018
 * Time: 7:31 PM
 */

namespace App\GraphQL\Type;

use App\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductsType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Products',
        'description'   => 'A type',
        'model'         => Product::class,
    ];

    /**
     *
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the category.'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of category.'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Description of product.'
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'Price of product.'
            ],
            'photo1' => [
                'type' => Type::string(),
                'description' => 'photo1 Name of image file'
            ],
            'photo2' => [
                'type' => Type::string(),
                'description' => 'photo2 Name of image file'
            ],
            'photo3' => [
                'type' => Type::string(),
                'description' => 'photo3 Name of image file'
            ],
            // relational field
            'category' => [
                'type' => GraphQL::type('categories'),//is defined by the table's name
                'description' => 'Product\'s category'
            ]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()

    protected function resolveNameField($root, $args)
    {
        return strtolower($root->name);
    }

    protected function resolvePhotoField($root, $args)
    {
        return strtolower($root->photo);
    }

    protected function resolvePriceField($root, $args)
    {
        return $root->price;
    }
}
