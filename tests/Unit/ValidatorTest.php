<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Tests\Bench\Data\LaravelValidator;
use App\Tests\Bench\Data\PushworldDTO;
use App\Tests\Bench\Data\SymphonyValidator;
use App\Tests\Bench\Data\Yii2Validator;
use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use Pushworld\DataTransferObject\DataTransferObject;
use yii\base\BaseObject;

class ValidatorTest extends Unit
{
    protected $tester;

    public function testYii2Validator(): void
    {
        $validator = new Yii2Validator();

        $this->assertTrue($validator->validateDto(Fixtures::get('validDTO')));
        $this->assertFalse($validator->validateDto(Fixtures::get('invalidDTO')));

//        var_dump($validator->getErrorsSummary());
//        var_dump($validator->getErrors());
//        var_dump($validator->getErrorsSnippet());
//        exit();
    }

    public function testSymphonyValidator(): void
    {
        $validator = new SymphonyValidator();

        $this->assertTrue($validator->validateDto(Fixtures::get('validDTO')));
        $this->assertFalse($validator->validateDto(Fixtures::get('invalidDTO')));

//        var_dump($validator->getErrorsSummary());
//        var_dump($validator->getErrors());
//        var_dump($validator->getErrorsSnippet());
//        exit();
    }

    public function testLaravelValidator(): void
    {
        $validator = new LaravelValidator();

        $this->assertTrue($validator->validateDto(Fixtures::get('validDTO')));
        $this->assertFalse($validator->validateDto(Fixtures::get('invalidDTO')));

//        var_dump($validator->getErrorsSummary());
//        var_dump($validator->getErrors());
//        var_dump($validator->getErrorsSnippet());
//        exit();
    }

    /** @inheritDoc */
    protected function _before() // @phpcs:ignore
    {
        Fixtures::add(
            'validDTO',
            new PushworldDTO(
                [
                    'checkoutId'    => 1,
                    'completedAt'   => 1626962147,
                    'completedBy'   => 'Username',
                    'userIp'        => '185.137.232.39',
                    'userUuid'      => 'd57c8cbc-7faa-4c2f-81f0-a76ada23dbe1',
                    'affectedUsers' => [1, 2],
                ]
            )
        );
        Fixtures::add(
            'invalidDTO',
            new PushworldDTO(
                [
                    'checkoutId'    => 'string',
                    'completedAt'   => 'string',
                    'completedBy'   => 5,
                    'userIp'        => '12.11',
                    'userUuid'      => 3,
                    'affectedUsers' => [2, 'string'],
                ]
            )
        );
    }

    /** @inheritDoc */
    protected function _after() // @phpcs:ignore
    {
        Fixtures::cleanup();
    }
}
