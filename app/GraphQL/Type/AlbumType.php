<?php


namespace App\GraphQL\Type;


use App\Models\Album;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQlType;
use GraphQL;

class AlbumType extends GraphQlType
{
    protected $attributes = [
        'name' => 'Album',
        'description' => 'An Album',
        'model' => Album::class
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of an Album'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the Album'
            ],
            'releaseYear' => [
                'type' => Type::string(),
                'description' => 'The year the album was released'
            ],
            'songs' => [
                'type' => Type::listOf(GraphQL::type('Song')),
                'description' => 'A list of Album\' Songs'
            ],
            'artist' => [
                'type' => GraphQL::type('Artist'),
                'description' => 'The Artist that created the Album',
                'selectable' => false
            ]
        ];
    }


    public function resolveReleaseYearField(Album $root, $args)
    {
        return (string)$root->release_date->year;
    }

}