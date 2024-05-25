<?php

declare(strict_types=1);

namespace Pushworld\Tools\DtoValidation;

use Pushworld\DataTransferObject\DTOInterface;

interface ValidatorInterface
{
    /**
     * @param DTOInterface $dto
     *
     * @return bool
     */
    public function validateDto(DTOInterface $dto): bool;

    /**
     * Validation rules for attributes.
     *
     * @return array
     */
    public function rules(): array;

    /**
     * Validation messages for attributes.
     *
     * @return array
     */
    public function messages(): array;

    /**
     * Returns the errors for all attributes or a single attribute.
     *
     * @param null $attribute
     *
     * @return array
     */
    public function getErrors($attribute = null): array;

    /**
     * Returns the errors for all attributes as a one-dimensional array.
     *
     * @return array
     */
    public function getErrorsSummary(): array;
}
