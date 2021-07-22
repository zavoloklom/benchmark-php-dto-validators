<?php

declare(strict_types=1);

namespace App\Tests\Bench\Data;

use Pushworld\DataTransferObject\DTOInterface;
use Pushworld\Tools\DtoValidation\ValidatorInterface;
use pushworld\ValidationTools\validators\UuidValidator;
use yii\base\Model;

class Yii2Validator extends Model implements ValidatorInterface
{
    public $checkoutId;
    public $completedAt;
    public $completedBy;
    public $userIp;
    public $userUuid;
    public $affectedUsers;

    public function validateDto(DTOInterface $dto): bool
    {
        $this->setAttributes($dto->toArray(), false);

        return $this->validate();
    }

    public function rules(): array
    {
        return [
            ['checkoutId', 'integer'],
            ['completedAt', 'integer'],
            ['completedBy', 'string'],
            [
                'userUuid',
                UuidValidator::class,
            ],
            ['userIp', 'ip', 'ipv6' => false],
            ['affectedUsers', 'each', 'rule' => ['integer']],
        ];

    }

    public function messages(): array
    {
        return [];
    }

    public function getErrors($attribute = null): array
    {
        return parent::getErrors($attribute);
    }

    public function getErrorsSummary(): array
    {
        return parent::getErrorSummary(true);
    }
}
