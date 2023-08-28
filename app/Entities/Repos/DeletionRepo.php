<?php

namespace App\Entities\Repos;

use App\Actions\ActivityType;
use App\Entities\Models\Deletion;
use App\Entities\Tools\TrashCan;
use App\Facades\Activity;

class DeletionRepo
{
    private TrashCan $trashCan;

    public function __construct(TrashCan $trashCan)
    {
        $this->trashCan = $trashCan;
    }

    public function restore(int $id): int
    {
        /** @var Deletion $deletion */
        $deletion = Deletion::query()->findOrFail($id);
        Activity::add(ActivityType::RECYCLE_BIN_RESTORE, $deletion);

        return $this->trashCan->restoreFromDeletion($deletion);
    }

    public function destroy(int $id): int
    {
        /** @var Deletion $deletion */
        $deletion = Deletion::query()->findOrFail($id);
        Activity::add(ActivityType::RECYCLE_BIN_DESTROY, $deletion);

        return $this->trashCan->destroyFromDeletion($deletion);
    }
}
