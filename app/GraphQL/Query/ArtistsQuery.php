<?php


namespace App\GraphQL\Query;


use App\Models\Artist;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL;

class ArtistsQuery extends Query
{
    protected $attributes = [
        'name' => 'Artists query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Artist'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Artist::where('id', $args['id'])->get();
        }

        if (isset($args['name'])) {
            return Artist::where('name', 'like', "%{$args['name']}%")->get();
        }

        return Artist::all();
    }


}