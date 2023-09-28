<?php

namespace SamMakesCode\TypeformUnbuster;

class TypeformResponse
{
    public function __construct(
        private readonly \stdClass $response,
    ) {}

    public function getEventId(): string
    {
        return $this->response->event_id;
    }

    public function getDefinition(): TypeformDefinition
    {
        return new TypeformDefinition($this->response->form_response->definition);
    }

    public function getAnswerForField(TypeformField $field): TypeformAnswer
    {
        foreach ($this->response->form_response->answers as $answer) {
            if ($answer->field->id !== $field->getId()) {
                continue;
            }

            return new TypeformAnswer($answer);
        }
    }
}
