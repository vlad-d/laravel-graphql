<?php


namespace App\GraphQL\Type;


use App\Models\Artist;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQlType;

class ArtistType extends GraphQlType
{
    protected $attributes = [
        'name' => 'Artist',
        'description' => 'The Artist',
        'model' => Artist::class
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the Artist',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the Artist'
            ],
            'bornIn' => [
                'type' => Type::string(),
                'description' => 'The year the artist was born'
            ]
        ];
    }

    protected function resolveBornInField(Artist $root, $args)
    {
        return (string)optional($root->born_on)->year;
    }
}