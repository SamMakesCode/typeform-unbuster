<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SamMakesCode\TypeformUnbuster\TypeformDefinition;
use SamMakesCode\TypeformUnbuster\TypeformField;
use SamMakesCode\TypeformUnbuster\Unbuster;

class UnbusterTest extends TestCase
{
    private function getResponse()
    {
        // TODO replace this text
        return Unbuster::createFromObject(json_decode());
    }

    public function testCanGetResponseId()
    {
        $this->assertEquals('', $this->getResponse()->getEventId());
    }

    public function testCanGetDefinition()
    {
        $this->assertInstanceOf(TypeformDefinition::class, $this->getResponse()->getDefinition());
    }

    public function testCanGetEachField()
    {
        $this->getResponse()->getDefinition()->eachField(function (TypeformField $field) {
            $this->assertInstanceOf(TypeformField::class, $field);
        });
    }

    public function testCanGetAnswerValue()
    {
        $typeformResponse = $this->getResponse();
        $typeformDefinition = $typeformResponse->getDefinition();

        $answer = $typeformResponse->getAnswerForField($typeformDefinition->getFieldFromTitle('Installer Full Name'));

        $this->assertEquals('Zamir Shaikh', $answer->getValue());
    }
}
