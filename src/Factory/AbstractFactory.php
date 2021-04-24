<?php

namespace App\Factory;

abstract class AbstractFactory
{
    protected $repository;
    protected $entityManager;

    public function __construct($repository, $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    protected abstract function createEntity($attributes);

    public function getAll($plugins = []) {
        return $this->repository->findBy([], $plugins);
    }

    public function create($attributes)
    {
        $entry = $this->createEntity($attributes);
        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        return $entry;
    }

    public function remove($id) {
        $toDelete = $this->repository->findOneBy(['id' => $id]);
        return ($toDelete) ? $this->repository->remove($toDelete) : null;
    }

}