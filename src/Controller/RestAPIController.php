<?php

namespace App\Controller;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class RestAPIController
 *
 * @package App\Controller
 */
class RestAPIController extends AbstractController
{
    /**
     * @param null $data
     * @param int $status
     * @param array $headers
     *
     * @return Response
     */
    protected function apiResponse($data = null, int $status = 200, array $headers = []): Response
    {
        try {
            $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        } catch (AnnotationException $exception) {
            return $this->apiErrorResponse('Something happened with the annotations');
        }

        $serializer = new Serializer(
            [new ObjectNormalizer($classMetadataFactory)],
            [new JsonEncoder()]
        );

        $data = $serializer->serialize($data, 'json', ['groups' => ['api']]);

        $headers['Content-Type'] = 'application/json';

        return new Response($data, $status, $headers);
    }

    /**
     * @param string $message
     * @param int $code
     *
     * @return Response
     */
    protected function apiErrorResponse(
        string $message = 'Something happened',
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR
    ): Response {
        return new JsonResponse($message, $code);
    }
}
