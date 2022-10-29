<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Simple helper class to parse a request body into a type safe model. It utilises the Symfony Serializer in order to
 * validate the data correctly handles an invalid request body by throwing a BadRequestHttpException which is caught
 * by Symfony and turned into a HTTP 400 response.
 */
final class RequestHandler
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    /**
     * @template       T of object
     *
     * @psalm-param    class-string<T> $intoModel
     *
     * @psalm-return   T
     *
     * @throws BadRequestHttpException
     */
    public function parse(Request $request, string $intoModel): object
    {
        $content = $request->getContent();

        try {
            $model = $this->serializer->deserialize($content, $intoModel, 'json');
        } catch (ExceptionInterface $e) {
            throw new BadRequestHttpException(
                \sprintf('Unable to correctly deserialise: %s', $e->getMessage()),
                $e
            );
        }

        return $model;
    }
}
