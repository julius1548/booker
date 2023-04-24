<?php

namespace Bookkeeper\Booker\Actions;

use Bookkeeper\Booker\Models\AvailabilityTimeline;
use Bookkeeper\Interface\Contracts\Abstracts\Actions\IndexAction;

class IndexAvailabilityTimelinesAction extends IndexAction
{

    function model(): string
    {
        return AvailabilityTimeline::class;
    }
}
