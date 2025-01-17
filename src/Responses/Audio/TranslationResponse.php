<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
 */
final class TranslationResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    /** @var ?string */
    public ?string $task;

    /** @var ?string */
    public ?string $language;

    /** @var ?float */
    public ?float $duration;

    /** @var array<int, TranslationResponseSegment> */
    public array $segments;

    /** @var string */
    public string $text;

    /**
     * @param  array<int, TranslationResponseSegment>  $segments
     */
    private function __construct(
        ?string $task,
        ?string $language,
        ?float $duration,
        array $segments,
        string $text
    ) {
        $this->task = $task;
        $this->language = $language;
        $this->duration = $duration;
        $this->segments = $segments;
        $this->text = $text;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}  $attributes
     */
    public static function from($attributes): self
    {
        if (is_string($attributes)) {
            $attributes = ['text' => $attributes];
        }

        $segments = isset($attributes['segments']) ? array_map(fn (array $result): TranslationResponseSegment => TranslationResponseSegment::from(
            $result
        ), $attributes['segments']) : [];

        return new self(
            $attributes['task'] ?? null,
            $attributes['language'] ?? null,
            $attributes['duration'] ?? null,
            $segments,
            $attributes['text'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'task' => $this->task,
            'language' => $this->language,
            'duration' => $this->duration,
            'segments' => array_map(
                static fn (TranslationResponseSegment $result): array => $result->toArray(),
                $this->segments,
            ),
            'text' => $this->text,
        ];
    }
}
