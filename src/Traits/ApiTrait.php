<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiTrait
{
    protected function okResponse($content = null)
    {
        return $this->getResponse('okResponse', $content);
    }

    protected function badRequestResponse($content = null)
    {
        return $this->getResponse('badRequest', $content);
    }

    protected function notFoundResponse($content = null)
    {
        return $this->getResponse('notFound', $content);
    }

    protected function createdResponse($content = null)
    {
        return $this->getResponse('created', $content);
    }

    private function getResponse($responseName, $content = null)
    {
        $response = new Response();
        $statusCodes = $this->getStatusCodes();
        $response->setStatusCode($statusCodes[$responseName]);

        if ($content) {
            $response->setContent(json_encode($content, true));
        }

        return $response;
    }

    private function getStatusCodes()
    {
        return [
            'okResponse' => Response::HTTP_OK,
            'badRequest' => Response::HTTP_BAD_REQUEST,
            'notFound' => Response::HTTP_NOT_FOUND,
            'created' => Response::HTTP_CREATED,
        ];
    }
}