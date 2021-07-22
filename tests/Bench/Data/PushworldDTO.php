<?php

declare(strict_types=1);

namespace App\Tests\Bench\Data;

use Pushworld\DataTransferObject\DataTransferObject;

class PushworldDTO extends DataTransferObject
{
    /** @var int */
    public $checkoutId;

    /** @var int */
    public $completedAt;

    /** @var string */
    public $completedBy;

    /** @var string */
    public $userIp;

    /** @var string */
    public $userUuid;

    /** @var array<int> */
    public $affectedUsers;

    /** @var null Свойство для тестирования */
    public static $staticProperty = null;

    /** @var null Свойство для тестирования */
    protected $protectedProperty = null;

    /**
     * @param array $params
     *
     * @return PushworldDTO
     */
    public static function fromWebhook(array $params): PushworldDTO
    {
        return new self(
            [
                'checkoutId'    => $params['id'],
                'completedAt'   => $params['completed_at'],
                'completedBy'   => $params['completed_by'],
                'userIp'        => $params['user_ip'],
                'userUuid'      => $params['user_uuid'],
                'affectedUsers' => $params['affected_users'] ?? [],
            ]
        );
    }
}
