<?php

namespace app\models\DTO\Traits;

/**
 * Trait ConvertToArrayTrait
 */
trait ConvertToArrayTrait
{
    /**
     * @return array
     */
    public function asArray(): array
    {
        $data = [];
        $props = array_keys(get_object_vars($this));

        foreach ($props as $name) {
            if (is_object($this->$name) && method_exists($this->$name, __FUNCTION__)) {
                $data[$name] = $this->$name->asArray();
            } else {
                $data[$name] = $this->$name;
            }
        }

        return $data;
    }
}
