<?php

namespace App\Domains\Common\Prototype;

use Exception;
use Ramsey\Uuid\Uuid;

/**
 * Trait Binary
 * @package App\Domains\Common\Prototype
 */
trait Binary
{
    /**
     * @var array
     */
    protected $encoded = [];

    /**
     * @return array
     */
    public function getEncoded()
    {
        return $this->encoded;
    }

    /**
     * @return array
     * @throws Exception
     */
    public static function produceUuid(): array
    {
        $uuid = Uuid::uuid1();
        return [
            'id' => $uuid,
            'uuid' => static::encodeUuid($uuid),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function transformAudit(array $data): array
    {
        if (isset($data['auditable_id'])) {
            $data['auditable_id'] = static::decodeUuid($data['auditable_id']);
        }
        if (isset($data['user_id'])) {
            $data['user_id'] = static::encodeUuid($data['user_id']);
        }
        return $data;
    }
}
