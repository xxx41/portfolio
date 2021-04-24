<?php

namespace App\Controller\Api;

use App\Factory\EntryFactory;
use App\Helper\Helper;
use App\Traits\ApiTrait;
use App\Transformer\EntryTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entry", name="entry_")
 */
class EntryController extends AbstractController
{
    use ApiTrait;

    private $entryFactory;

    public function __construct(EntryFactory $entryFactory)
    {
        $this->entryFactory = $entryFactory;
    }

    /**
     * @Route("/find-all", name="find_all", methods={"GET"})
     */
    public function getEntry(
        EntryTransformer $entryTransformer
    )
    {
        $data = $this->entryFactory->getAll(['createdAt' => 'DESC']);
        $data = $entryTransformer->transform($data);

        return ($data) ? $this->okResponse($data) : $this->notFoundResponse();
    }

    /**
     * @Route("/save", name="save", methods={"PUT"})
     */
    public function saveEntry(Request $request)
    {
        $data = Helper::getDecodedContent($request);
        $this->entryFactory->create($data);

        return $this->okResponse();
    }
}
