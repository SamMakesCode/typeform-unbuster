<?php

namespace SamMakesCode\TypeformUnbuster;

use Cassandra\Date;

class TypeformAnswer
{
    public function __construct(
        private readonly \stdClass $answer
    ) {}

    public function getType(): string
    {
        return $this->answer->type;
    }

    public function getValue(): mixed
    {
        if ($this->getType() === 'text') {
            return $this->getText();
        } else if ($this->getType() === 'date') {
            return $this->getDate();
        } else if ($this->getType() === 'file_url') {
            return $this->getFileURL();
        }
    }

    public function getText(): string
    {
        return $this->answer->text;
    }

    public function getDate(): \DateTime
    {
        return new \DateTime($this->answer->date);
    }

    public function getFileURL(): string
    {
        return $this->answer->file_url;
    }
}
