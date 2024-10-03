<?php

namespace SamMakesCode\TypeformUnbuster;

class TypeformField
{
    public function __construct(
        private readonly \stdClass $field,
    ) {}

    public function getId(): string
    {
        return $this->field->id;
    }

    public function getTitle(): string
    {
        return $this->field->title ?? $this->field->id;
    }

    public function getType(): string
    {
        return $this->field->type;
    }
}
