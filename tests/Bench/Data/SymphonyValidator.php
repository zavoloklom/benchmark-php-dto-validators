<?php

declare(strict_types=1);

namespace App\Tests\Bench\Data;

use Pushworld\DataTransferObject\DTOInterface;
use Pushworld\Tools\DtoValidation\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class SymphonyValidator implements ValidatorInterface
{
    /** @var ConstraintViolationListInterface Список всех ошибок */
    private $errors;

    public function validateDto(DTOInterface $dto): bool
    {
        $this->errors = Validation::createValidator()->validate($dto->toArray(), $this->rules());

        return count($this->errors) === 0;

    }

    public function rules(): array
    {
        return [
            new Assert\Collection([
                'checkoutId' => [
                    new Assert\Type('int')
                ],
                'completedAt' => [
                    new Assert\Type('int')
                ],
                'completedBy' => [
                    new Assert\Type('string')
                ],
                'userUuid' => [
                    new Assert\Uuid(),
//                    new Assert\NotNull(),
                ],
                'userIp'   => [
                    new Assert\Ip(null, Assert\Ip::V4),
//                    new Assert\NotNull(),
                ],
                'affectedUsers' => [
                    new Assert\Type('array'),
                    new Assert\All([
                        new Assert\NotBlank(),
                        new Assert\Type('integer'),
                    ]),
                ],
            ]),
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
