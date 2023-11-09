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
        } else if ($this->getType() === 'choice') {
            return $this->getChoice();
        } else if ($this->getType() === 'choices') {
            return $this->getChoices();
        } else {
            throw new \Exception('Unhandled field type "' . $this->getType() . '".');
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

    public function getChoice(): string
    {
        return $this->answer->choice->label;
    }

    public function getChoices(): string
    {
        return implode(', ', $this->answer->choices->labels);
    }
}
