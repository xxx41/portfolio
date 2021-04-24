<?php

namespace App\Transformer;

use App\Transformer\TransformerInterface;

class AbstractTransformer implements TransformerInterface
{
    private $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function getAttributes() {}

    public function transform(array $objects)
    {
        return $this->transformEntities($objects, $this->getAttributes() ?? []);
    }

    protected function transformEntities($objects, array $keyList)
    {
        $result = [];
        foreach ($objects as $index => $object) {
            foreach ($keyList as $key) {
                $result[$index][$key] = $this->getAttribute($key, $object);
            }
        }

        return $result;
    }

    private function getAttribute($key, $object)
    {
        $methodString = 'get' . ucfirst($key);
        return (method_exists($this->entity, $methodString))
            ? $object->$methodString()
            : null;
    }
}