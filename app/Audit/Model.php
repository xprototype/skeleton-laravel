<?php

namespace App\Audit;

use App\Domains\Common\Prototype as Common;
use Illuminate\Database\Eloquent\JsonEncodingException;
use OwenIt\Auditing\Models\Audit;
use function App\Helper\is_binary;

/**
 * Class Prototype
 * @package App\Audit
 */
class Model extends Audit
{
    /**
     * Cast the given attribute to JSON.
     *
     * @param  string $key
     * @param  mixed $value
     * @return string
     */
    protected function castAttributeAsJson($key, $value)
    {
        foreach ($value as $index => $content) {
            if (!is_binary($content)) {
                continue;
            }
            $value[$index] = Common::decodeUuid($content);
        }

        $value = $this->asJson($value);

        if ($value === false) {
            throw JsonEncodingException::forAttribute(
                $this, $key, json_last_error_msg()
            );
        }

        return $value;
    }
}
