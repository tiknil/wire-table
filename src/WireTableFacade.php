<?php

namespace Tiknil\WireTable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tiknil\WireTable\Skeleton\SkeletonClass
 */
class WireTableFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'wire-table';
    }
}
