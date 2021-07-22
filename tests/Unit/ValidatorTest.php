<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use app\modules\Device\DeviceService;
use app\modules\Device\Dto\AddToPlatformSegmentDto;
use app\modules\Device\Dto\AddToSystemSegmentDto;
use app\modules\Device\Dto\CreateDeviceDto;
use app\modules\Device\Dto\RemoveFromPlatformSegmentDto;
use app\modules\Device\Dto\UpdateDeviceDto;
use app\modules\Device\Entities\Device;
use app\modules\Device\Repositories\InMemoryDeviceRepository;
use app\modules\Device\Validators\CreateDeviceDtoValidator;
use app\modules\Device\Validators\DtoValidatorFactory;
use app\modules\Device\Validators\UpdateDeviceDtoValidator;
use app\modules\Platform\Entities\Platform;
use app\modules\Platform\Repositories\InMemoryPlatformRepository;
use app\modules\SystemSegment\models\SystemSegmentNew;
use App\Tests\Bench\Data\LaravelValidator;
use App\Tests\Bench\Data\PushworldDTO;
use App\Tests\Bench\Data\SymphonyValidator;
use App\Tests\Bench\Data\Yii2Validator;
use Codeception\Test\Unit;
use Codeception\Util\Fixtures;
use Pushworld\DataTransferObject\DataTransferObject;
use Pushworld\ServiceManager\Services\Dictionary\DictionaryClient;

use yii\base\BaseObject;
use function Pushworld\Utils\uuid2bin;

class ValidatorTest extends Unit
{
    protected $tester;

    public function testYii2Validator(): void
    {
        $validator = new Yii2Validator();

        $this->assertTrue($validator->validateDto(Fixtures::get('validDTO')));
        $this->assertFalse($validator->validateDto(Fixtures::get('invalidDTO')));
    }

    public function testSymphonyValidator(): void
    {
        $validator = new SymphonyValidator();

        $this->assertTrue($validator->validateDto(Fixtures::get('validDTO')));
        $this->assertFalse($validator->validateDto(Fixtures::get('invalidDTO')));
    }

    public function testLaravelValidator(): void
    {
        $validator = new LaravelValidator();

        $this->assertTrue($validator->validateDto(Fixtures::get('validDTO')));
        $this->assertFalse($validator->validateDto(Fixtures::get('invalidDTO')));
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
                    'affectedUsers' => [1,2],
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
                    'userUuid'      => 'failed',
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
