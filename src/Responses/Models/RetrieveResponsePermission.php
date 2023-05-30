<?php

declare(strict_types=1);

namespace OpenAI\Responses\Models;

final class RetrieveResponsePermission
{
    /** @var string */
    public string $id;

    /** @var string */
    public string $object;

    /** @var int */
    public int $created;

    /** @var bool */
    public bool $allowCreateEngine;

    /** @var bool */
    public bool $allowSampling;

    /** @var bool */
    public bool $allowLogprobs;

    /** @var bool */
    public bool $allowSearchIndices;

    /** @var bool */
    public bool $allowView;

    /** @var bool */
    public bool $allowFineTuning;

    /** @var string */
    public string $organization;

    /** @var string|null */
    public ?string $group;

    /** @var bool */
    public bool $isBlocking;

    private function __construct(
        string $id,
        string $object,
        int $created,
        bool $allowCreateEngine,
        bool $allowSampling,
        bool $allowLogprobs,
        bool $allowSearchIndices,
        bool $allowView,
        bool $allowFineTuning,
        string $organization,
        ?string $group,
        bool $isBlocking
    ) {
        $this->id = $id;
        $this->object = $object;
        $this->created = $created;
        $this->allowCreateEngine = $allowCreateEngine;
        $this->allowSampling = $allowSampling;
        $this->allowLogprobs = $allowLogprobs;
        $this->allowSearchIndices = $allowSearchIndices;
        $this->allowView = $allowView;
        $this->allowFineTuning = $allowFineTuning;
        $this->organization = $organization;
        $this->group = $group;
        $this->isBlocking = $isBlocking;
    }

    /**
     * @param  array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created'],
            $attributes['allow_create_engine'],
            $attributes['allow_sampling'],
            $attributes['allow_logprobs'],
            $attributes['allow_search_indices'],
            $attributes['allow_view'],
            $attributes['allow_fine_tuning'],
            $attributes['organization'],
            $attributes['group'],
            $attributes['is_blocking'],
        );
    }

    /**
     * @return array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'allow_create_engine' => $this->allowCreateEngine,
            'allow_sampling' => $this->allowSampling,
            'allow_logprobs' => $this->allowLogprobs,
            'allow_search_indices' => $this->allowSearchIndices,
            'allow_view' => $this->allowView,
            'allow_fine_tuning' => $this->allowFineTuning,
            'organization' => $this->organization,
            'group' => $this->group,
            'is_blocking' => $this->isBlocking,
        ];
    }
}
