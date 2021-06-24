<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiTrait
{
    protected function okResponse($content = null): Response
    {
        return $this->getResponse('okResponse', $content);
    }

    protected function badRequestResponse($content = null): Response
    {
        return $this->getResponse('badRequest', $content);
    }

    protected function notFoundResponse($content = null): Response
    {
        return $this->getResponse('notFound', $content);
    }

    protected function createdResponse($content = null): Response
    {
        return $this->getResponse('created', $content);
    }

    protected function noContentResponse(): Response
    {
        return $this->getResponse('noContent');
    }

    private function getResponse($responseName, $content = null): Response
    {
        $response = new Response();
        $statusCodes = $this->getStatusCodes();
        $response->setStatusCode($statusCodes[$responseName]);

        if ($content) {
            $response->setContent(json_encode($content, true));
        }

        return $response;
    }

    private function getStatusCodes(): array
    {
        return [
            'okResponse' => Response::HTTP_OK,
            'badRequest' => Response::HTTP_BAD_REQUEST,
            'notFound' => Response::HTTP_NOT_FOUND,
            'created' => Response::HTTP_CREATED,
            'noContent' => Response::HTTP_NO_CONTENT,
        ];
    }
}