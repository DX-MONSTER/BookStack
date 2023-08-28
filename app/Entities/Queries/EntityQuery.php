<?php

namespace App\Entities\Queries;

use App\Auth\Permissions\PermissionApplicator;
use App\Entities\EntityProvider;

abstract class EntityQuery
{
    protected function permissionService(): PermissionApplicator
    {
        return app()->make(PermissionApplicator::class);
    }

    protected function entityProvider(): EntityProvider
    {
        return app()->make(EntityProvider::class);
    }
}
