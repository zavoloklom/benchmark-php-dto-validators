<?php

declare(strict_types=1);

namespace App\Tests\Bench\Benchmark;

use App\Tests\Bench\Data\LaravelValidator;
use App\Tests\Bench\Data\PushworldDTO;
use App\Tests\Bench\Data\SymphonyValidator;
use App\Tests\Bench\Data\Yii2Validator;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use Pushworld\DataTransferObject\DataTransferObject;
use yii\base\BaseObject;


/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class DTOValidationBench
{
    /** @var PushworldDTO */
    private $validDTO;

    /** @var PushworldDTO */
    private $invalidDTO;

    public function __construct()
    {
        $this->invalidDTO = new PushworldDTO(
            [
                'checkoutId'    => 'string',
                'completedAt'   => 'string',
                'completedBy'   => 5,
                'userIp'        => '12.11',
                'userUuid'      => 'failed',
                'affectedUsers' => [2, 'string'],
            ]
        );

        $this->validDTO = new PushworldDTO(
            [
                'checkoutId'    => 1,
                'completedAt'   => 1626962147,
                'completedBy'   => 'Username',
                'userIp'        => '185.137.232.39',
                'userUuid'      => 'd57c8cbc-7faa-4c2f-81f0-a76ada23dbe1',
                'affectedUsers' => [1, 2],
            ]
        );
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchSymphonyValidatorValid(): void
    {
        $validator = new SymphonyValidator();
        $validator->validateDto($this->validDTO);
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchSymphonyValidatorInvalid(): void
    {
        $validator = new SymphonyValidator();
        $validator->validateDto($this->invalidDTO);
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchLaravelValidatorValid(): void
    {
        $validator = new LaravelValidator();
        $validator->validateDto($this->validDTO);
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchLaravelValidatorInvalid(): void
    {
        $validator = new LaravelValidator();
        $validator->validateDto($this->invalidDTO);
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchYii2ValidatorValid(): void
    {
        $validator = new Yii2Validator();
        $validator->validateDto($this->validDTO);
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchYii2ValidatorInvalid(): void
    {
        $validator = new Yii2Validator();
        $validator->validateDto($this->invalidDTO);
    }
}
