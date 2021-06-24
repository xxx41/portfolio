<?php

namespace App\Controller\Api;

use App\Factory\EntryFactory;
use App\Traits\ApiTrait;
use App\Traits\RequestTrait;
use App\Transformer\EntryTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entry", name="entry_")
 */
class EntryController extends AbstractController
{
    use ApiTrait;
    use RequestTrait;

    private $entryFactory;

    public function __construct(EntryFactory $entryFactory)
    {
        $this->entryFactory = $entryFactory;
    }

    /**
     * @Route("/find-all", name="find_all", methods={"GET"})
     */
    public function getEntry(EntryTransformer $entryTransformer): Response
    {
        $data = $this->entryFactory->getAll(['createdAt' => 'DESC']);
        $data = $entryTransformer->transform($data);

        return $this->okResponse($data);
    }

    /**
     * @Route("/create", name="create", methods={"PUT"})
     */
    public function createEntry(Request $request): Response
    {
        $data = $this->getContent($request);
        $created = $this->entryFactory->create($data['fields']);

        if (!empty($created->hasErrors())) {
            return $this->badRequestResponse($created->getFirstError());
        }

        return $this->okResponse();
    }

    /**
     * @Route("/edit", name="edit", methods={"PUT"})
     */
    public function editEntry(Request $request): Response
    {
        $data = $this->getContent($request);
        $edited = $this->entryFactory->edit($data['id'], $data['fields']);

        if (!empty($edited->hasErrors())) {
            return $this->badRequestResponse($edited->getFirstError());
        }

        return $this->okResponse();
    }

    /**
     * @Route("/delete", name="delete", methods={"DELETE"})
     */
    public function deleteEntry(Request $request): Response
    {
        $entryId = $this->getParam($request, 'entryId');
        $deleted = $this->entryFactory->remove($entryId);

        if (!empty($deleted->hasErrors())) {
            return $this->badRequestResponse($deleted->getFirstError());
        }

        return $this->noContentResponse();
    }
}
