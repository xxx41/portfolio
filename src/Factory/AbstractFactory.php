<?php

namespace App\Factory;

use App\Entity\Entry;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use App\Helper\ErroreableResponse;

abstract class AbstractFactory
{
    protected $repository;
    protected $entityManager;

    public function __construct($repository, $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->response = new ErroreableResponse();
    }

    protected abstract function saveEntity(array $attributes, Entry $entity = null): Entry;

    public function getAll(array $plugins = []): array
    {
        return $this->repository->findBy([], $plugins);
    }

    public function create(array $attributes): ErroreableResponse
    {
        $entry = $this->saveEntity($attributes);

        try {
            $this->entityManager->persist($entry);
            $this->entityManager->flush();
        } catch (\Throwable $th) {
            $this->response->setError($th->getMessage());
        }

        return $this->response;
    }

    public function edit(int $id, array $attributes): ErroreableResponse
    {
        $toEdit = $this->repository->findOneBy(['id' => $id]);
        $this->saveEntity($attributes, $toEdit);

        try {
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            $this->response->setError($e->getMessage());
        } catch (\Throwable $th) {
            $this->response->setError($th->getMessage());
        }

        return $this->response;
    }

    public function remove(int $id): ErroreableResponse
    {
        $toDelete = $this->repository->findOneBy(['id' => $id]);

        try {
            $this->entityManager->remove($toDelete);
            $this->entityManager->flush();
        } catch (\Throwable $th) {
            $this->response->setError($th->getMessage());
        }

        return $this->response;
    }
}