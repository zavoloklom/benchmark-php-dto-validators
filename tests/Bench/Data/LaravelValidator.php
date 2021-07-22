<?php

declare(strict_types=1);

namespace App\Tests\Bench\Data;

use Pushworld\DataTransferObject\DTOInterface;
use Pushworld\Tools\DtoValidation\ValidatorInterface;
use Illuminate\Support\MessageBag;
use pushworld\ValidationTools\ValidatorFactory;

class LaravelValidator implements ValidatorInterface
{
    /** @var MessageBag Список всех ошибок */
    private $errors;

    public function validateDto(DTOInterface $dto): bool
    {
        $validator = (new ValidatorFactory())->make($dto->toArray(), $this->rules(), $this->messages());

        $this->errors = $validator->errors();

        return $validator->passes();
    }

    /**
     * @see https://laravel.com/docs/8.x/validation#available-validation-rules
     */
    public function rules(): array
    {
        return [
            'checkoutId' => ['integer'],
            'completedAt' => ['integer'],
            'completedBy' => ['string'],
            'userUuid' => ['string', 'size:36', 'uuid'],
            'userIp' => ['ipv4'],
            'affectedUsers.*' => ['integer'],
        ];

    }

    public function messages(): array
    {
        return [];
    }

    public function getErrors($attribute = null): array
    {
        return [];
    }

    public function getErrorsSummary(): array
    {
        return [];
    }
}
