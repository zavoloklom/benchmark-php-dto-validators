<?php

declare(strict_types=1);

namespace pushworld\ValidationTools;

use Ramsey\Uuid\Uuid;
use yii\validators\Validator;

use function sprintf;

class UUIDValidator extends Validator
{
    /**
     * @inheritDoc
     */
    public function validateAttribute($model, $attribute)
    {
        if (Uuid::isValid($model->{$attribute})) {
            return;
        }

        $this->addError($model, $attribute, sprintf('Attribute %s should meet UUID format', $attribute));
    }
}
