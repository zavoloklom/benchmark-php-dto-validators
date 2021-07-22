<?php

declare(strict_types=1);

namespace App\Tests\Bench\Data;

use Pushworld\DataTransferObject\DTOInterface;
use Pushworld\Tools\DtoValidation\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validation;

use function count;
use function get_class;
use function implode;
use function is_array;
use function is_object;

class SymphonyValidator implements ValidatorInterface
{
    /** @var ConstraintViolationList Список всех ошибок */
    private $violations;

    /**
     * @inheritDoc
     */
    public function validateDto(DTOInterface $dto): bool
    {
        $this->violations = Validation::createValidator()->validate($dto->toArray(), $this->getConstraints());

        return count($this->violations) === 0;
    }

    /**
     * @inheritDoc
     */
    public function getErrors(?string $attribute = null): array
    {
        $errors = [];

        foreach ($this->violations as $violation) {
            if ($attribute !== null && $attribute !== $violation->getPropertyPath()) {
                continue;
            }

            $errors[$violation->getPropertyPath()] = $violation;
        }

        return $errors;
    }

    /**
     * @inheritDoc
     */
    public function getErrorsSummary(): array
    {
        $messages = [];

        foreach ($this->violations as $violation) {
            $root = $violation->getRoot();
            $class = 'Array';
            if (is_object($root)) {
                $class = 'Object(' . get_class($root) . ')';
            } elseif (is_array($root) === false) {
                $class = (string) $root;
            }

            $messages[$violation->getPropertyPath()] =
                $class . $violation->getPropertyPath() . ': ' . $violation->getMessage();
        }

        return $messages;
    }

    /**
     * @inheritDoc
     */
    public function getErrorsSnippet(): string
    {
        return implode('; ', $this->getErrorsSummary());
    }

    /**
     * List of constraints
     *
     * @return Assert\Collection
     */
    private function getConstraints(): Assert\Collection
    {
        return new Assert\Collection([
            'checkoutId'    => [new Assert\Type('int')],
            'completedAt'   => [new Assert\Type('int')],
            'completedBy'   => [new Assert\Type('string')],
            'userUuid'      => [
                new Assert\Type('string'),
                new Assert\Uuid(),
            ],
            'userIp'        => [
                new Assert\Ip(null, Assert\Ip::V4),
            ],
            'affectedUsers' => [
                new Assert\Type('array'),
                new Assert\All([
                    new Assert\Type('integer'),
                ]),
            ],
        ]);
    }
}
