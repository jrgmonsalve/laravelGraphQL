<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 21/10/2018
 * Time: 7:31 PM
 */

namespace App\GraphQL\Type;

use App\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoriesType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Categories',
        'description'   => 'A type',
        'model'         => Category::class,
    ];

    /**
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
            'photo' => [
                'type' => Type::string(),
                'description' => 'Name of image file'
            ],
            // relational field
//            'category_products' => [
//                'type' => GraphQL::type('category_products'),
//                'description' => 'Products in this category'
//            ]
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
}
