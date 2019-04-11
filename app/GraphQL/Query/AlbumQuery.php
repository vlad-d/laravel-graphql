<?php


namespace App\GraphQL\Query;


use App\Models\Album;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class AlbumQuery extends Query
{

    protected $attributes = [
        'name' => 'Album'
    ];

    public function type()
    {
        return GraphQL::type('Album');
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

    public function resolve($root, $args, SelectFields $fields)
    {
        return Album::findOrFail($args['id']);
    }

}