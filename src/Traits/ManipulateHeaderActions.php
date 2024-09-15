<?php

namespace Pages\Traits;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;

trait ManipulateHeaderActions
{
    public function pushToFirst(Action | ActionGroup $action)
    {
        $this->cachedHeaderActions = [
            $action,
            ...$this->cachedHeaderActions
        ];
    }

    public function pushToLast(Action | ActionGroup $action)
    {
        $this->cachedHeaderActions[] = $action;

        return $this;
    }
}
