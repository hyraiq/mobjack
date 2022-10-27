<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class RequestHandler
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    /**
     * @template T of object
     *
     * @psalm-param    class-string<T> $intoModel
     *
     * @psalm-return   T
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
