<?php

namespace SamMakesCode\TypeformUnbuster;

class TypeformDefinition
{
    public function __construct(
        private readonly \stdClass $definition,
    ) {}

    public function eachField(\Closure $closure): void
    {
        foreach ($this->definition->fields as $field) {
            $closure(new TypeformField($field));
        }
    }

    public function eachFieldFiltered(array $fieldIds, \Closure $closure): void
    {
        foreach ($fieldIds as $fieldId) {
            try {
                $closure($this->getFieldFromId($fieldId));
            } catch (\InvalidArgumentException) {
                continue;
            }
        }
    }

    public function getFieldFromTitle(string $title): TypeformField
    {
        foreach ($this->definition->fields as $field) {
            if ($field->title !== $title) {
                continue;
            }

            return new TypeformField($field);
        }

        throw new \InvalidArgumentException('No field with title "' . $title . '". Did someone change the TypeForm form?');
    }

    public function getFieldFromId(string $fieldId): TypeformField
    {
        foreach ($this->definition->fields as $field) {
            if ($field->id !== $fieldId) {
                continue;
            }

            return new TypeformField($field);
        }

        throw new \InvalidArgumentException('No field with ID "' . $fieldId . '". Did someone change the TypeForm form?');
    }
}
