<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTunes;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{object: string, data: array<int, array{object: string, created_at: int, level: string, message: string}>}>
 */
final class ListEventsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{object: string, created_at: int, level: string, message: string}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /** @var string */
    public string $object;

    /** @var array<int, RetrieveResponseEvent> */
    public array $data;

    /**
     * @param  array<int, RetrieveResponseEvent>  $data
     */
    private function __construct(
        string $object,
        array $data
    ) {
        $this->object = $object;
        $this->data = $data;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, data: array<int, array{object: string, created_at: int, level: string, message: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $data = array_map(fn (array $result): RetrieveResponseEvent => RetrieveResponseEvent::from(
            $result
        ), $attributes['data']);

        return new self(
            $attributes['object'],
            $data,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(
                static fn (RetrieveResponseEvent $response): array => $response->toArray(),
                $this->data,
            ),
        ];
    }
}
