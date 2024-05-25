<?php

declare(strict_types=1);

namespace App\Tests\Bench\Data;

use Pushworld\DataTransferObject\DTOInterface;
use Pushworld\Tools\DtoValidation\ValidatorInterface;
use pushworld\ValidationTools\UUIDValidator;
use yii\base\Model;

use function implode;

class Yii2Validator extends Model implements ValidatorInterface
{
    public $checkoutId;

    public $completedAt;

    public $completedBy;

    public $userIp;

    public $userUuid;

    public $affectedUsers;

    /**
     * @inheritDoc
     */
    public function validateDto(DTOInterface $dto): bool
    {
        $this->setAttributes($dto->toArray(), false);

        return $this->validate();
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            ['checkoutId', 'integer'],
            ['completedAt', 'integer'],
            ['completedBy', 'string'],
            ['userUuid', 'string'],
            [
                'userUuid',
                UUIDValidator::class,
            ],
            ['userIp', 'ip', 'ipv6' => false],
            ['affectedUsers', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getErrors($attribute = null): array
    {
        return parent::getErrors($attribute);
    }

    /**
     * @inheritDoc
     */
    public function getErrorsSummary(): array
    {
        return parent::getErrorSummary(true);
    }

    /**
     * @inheritDoc
     */
    public function getErrorsSnippet(): string
    {
        return implode('; ', $this->getErrorsSummary());
    }
}
