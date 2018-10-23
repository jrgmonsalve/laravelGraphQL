<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 22/10/2018
 * Time: 10:28 PM
 */

namespace App\GraphQL\Mutation;

use App\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class NewCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewCategory'
    ];
    public function type()
    {
        return GraphQL::type('categories');
    }
    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'photo' => [
                'name' => 'photo',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }
    public function resolve($root, $args)
    {

        $category = Category::create($args);

        return $category;
    }
}
