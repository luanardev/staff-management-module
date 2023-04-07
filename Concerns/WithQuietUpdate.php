<?php

namespace Lumis\StaffManagement\Concerns;

trait WithQuietUpdate
{
    /**
     * Update the model without firing any model events
     *
     * @param array $attributes
     * @param array $options
     *
     * @return mixed
     */
    public function updateQuietly(array $attributes = [], array $options = []): mixed
    {
        return static::withoutEvents(function () use ($attributes, $options) {
            return $this->update($attributes, $options);
        });
    }
}
