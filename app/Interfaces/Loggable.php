<?php

namespace App\Interfaces;

interface Loggable
{
    /**
     * Get the string descriptor for this item.
     */
    public function logDescriptor(): string;
}
