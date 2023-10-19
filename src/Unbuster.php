<?php

namespace SamMakesCode\TypeformUnbuster;

class Unbuster
{
    public static function createFromObject(\stdClass $response): TypeformResponse
    {
        return new TypeformResponse($response);
    }

    /**
     * Warning: This will never fail, so if you get the field title wrong, you won't know
     * @param TypeformResponse $response
     * @param string $fieldTitle
     * @return string|null
     */
    public static function fieldValueFromTitleOrNull(TypeformResponse $response, string $fieldTitle): ?string
    {
        $definition = $response->getDefinition();
        $value = null;
        try {
            $field = $definition->getFieldFromTitle($fieldTitle);
            $value = $response->getAnswerForField($field)->getValue();
        } catch (\InvalidArgumentException $invalidArgumentException) {
            // Do nothing
        }

        return $value;
    }
}
