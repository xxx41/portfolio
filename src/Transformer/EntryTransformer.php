<?php

namespace App\Transformer;

use App\Entity\Entry;

class EntryTransformer extends AbstractTransformer
{

    public function __construct() {
        parent::__construct(Entry::class);
    }

    public function getAttributes(): array
    {
        return [
            'id',
            'title',
            'content',
            'createdAt',
            'updatedAt',
            'enabled',
            'path'
        ];
    }
}