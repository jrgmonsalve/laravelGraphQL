<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 21/10/2018
 * Time: 7:18 PM
 */

namespace App\GraphQL\Query;


use App\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class CategoriesQuery extends Query
{
    protected $attributes = [
        'name'           => 'Categories Query',
        'description'    => 'A query of categories',

    ];
    public function type()
    {
        // result of query with pagination laravel
        return GraphQL::paginate('categories');
    }

    /**
     * Arguments enables to make filters
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            'photo' => [
                'name' => 'photo',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields)
    {
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id',$args['id']);
            }
            if (isset($args['name'])) {
                $query->where('name',$args['name']);
            }
            if (isset($args['photo'])) {
                $query->where('photo',$args['photo']);
            }
        };
        $categories = Category::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate();
        return $categories;
    }
}
