<?php
/**
 * Created by PhpStorm.
 * User: Johan
 * Date: 21/10/2018
 * Time: 7:18 PM
 */

namespace App\GraphQL\Query;


use App\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ProductsQuery extends Query
{
    protected $attributes = [
        'name'           => 'Products Query',
        'description'    => 'A query of products',

    ];
    public function type()
    {
        // result of query with pagination laravel
        return GraphQL::paginate('products');
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
            'description' => [
                'name' => 'description',
                'type' => Type::string()
            ],
            'price' => [
                'name' => 'price',
                'type' => Type::float()
            ],
            'photo1' => [
                'name' => 'photo1',
                'type' => Type::string()
            ],
            'photo2' => [
                'name' => 'photo2',
                'type' => Type::string()
            ],
            'photo3' => [
                'name' => 'photo3',
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
            if (isset($args['price'])) {
                $query->where('price',$args['price']);
            }
            if (isset($args['photo1'])) {
                $query->where('photo1',$args['photo1']);
            }
            if (isset($args['photo2'])) {
                $query->where('photo2',$args['photo2']);
            }
            if (isset($args['photo3'])) {
                $query->where('photo3',$args['photo3']);
            }
        };
        $products = Product::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate();
        return $products;
    }
}
