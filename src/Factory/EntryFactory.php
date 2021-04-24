<?php

namespace App\Factory;

use App\Entity\Entry;
use App\Repository\EntryRepository;
use Doctrine\ORM\EntityManagerInterface;

class EntryFactory extends AbstractFactory
{
    public function __construct(
        EntryRepository $entryRepository,
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entryRepository, $entityManager);
    }

    protected function createEntity($attributes)
    {
        $attributesProcessed = $this->processAttributes($attributes);

        $entry = new Entry();
        $entry->setTitle($attributesProcessed['title']);
        $entry->setContent($attributesProcessed['content']);
        $entry->setPath($attributesProcessed['path']);

        return $entry;
    }

    private function processAttributes($attributes)
    {
        return [
            'title' => $attributes['title'],
            'content' => $attributes['content'],
            'path' => $this->buildPath($attributes['title'])
        ];
    }

    private function buildPath($string)
    {
        return str_replace(" ", "-", strtolower($string));
    }
}