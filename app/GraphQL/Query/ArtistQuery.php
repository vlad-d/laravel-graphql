<?php


namespace App\GraphQL\Query;


use App\Models\Artist;
use Rebing\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;


class ArtistQuery extends Query
{
    protected $attributes = [
        'name' => 'artist'
    ];

    public function type()
    {
        return GraphQL::type('Artist');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function rules(array $args = [])
    {
        return [
            'id' => ['required', 'integer', 'min:1']
        ];
    }

    public function resolve($root, $args)
    {
        return Artist::findOrFail($args['id']);

    }
}
