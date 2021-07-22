<?php

declare(strict_types=1);

namespace App\Tests\Bench\Data;

use Illuminate\Support\MessageBag;
use Pushworld\DataTransferObject\DTOInterface;
use Pushworld\Tools\DtoValidation\ValidatorInterface;
use pushworld\ValidationTools\ValidatorFactory;

use function call_user_func_array;
use function implode;

class LaravelValidator implements ValidatorInterface
{
    /** @var MessageBag Список всех ошибок */
    private $errors;

    /**
     * @inheritDoc
     */
    public function validateDto(DTOInterface $dto): bool
    {
        $validator = (new ValidatorFactory())->make($dto->toArray(), $this->getRules());

        $this->errors = $validator->errors();

        return $validator->passes();
    }

    /**
     * @inheritDoc
     */
    public function getErrors(?string $attribute = null): array
    {
        if ($attribute !== null) {
            return $this->errors->get($attribute);
        }

        return $this->errors->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getErrorsSummary(): array
    {
        return $this->errors->all();
    }

    /**
     * @inheritDoc
     */
    public function getErrorsSnippet(): string
    {
        return implode('; ', $this->getErrorsSummary());
    }

    /**
     * @see https://laravel.com/docs/8.x/validation#available-validation-rules
     */
    private function getRules(): array
    {
        return [
            'checkoutId'      => ['integer'],
            'completedAt'     => ['integer'],
            'completedBy'     => ['string'],
            'userUuid'        => ['string', 'uuid'],
            'userIp'          => ['ipv4'],
            'affectedUsers.*' => ['integer'],
        ];
    }
}
