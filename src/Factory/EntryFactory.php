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

    protected function saveEntity(array $attributes, Entry $entity = null): Entry
    {
        $attributesProcessed = $this->processAttributes($attributes);

        $entry = (!$entity) ? new Entry() : $entity;
        $entry->setTitle($attributesProcessed['title']);
        $entry->setContent($attributesProcessed['content']);
        $entry->setPath($attributesProcessed['path']);

        return $entry;
    }

    private function processAttributes(array $attributes): array
    {
        return [
            'title' => $attributes['title'],
            'content' => $attributes['content'],
            'path' => $this->buildPath($attributes['title'])
        ];
    }

    private function buildPath($string): string
    {
        // TODO: remove not allowed chars
        return str_replace(" ", "-", strtolower($string));
    }
}