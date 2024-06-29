<?php

namespace Pages\Filament\Support;

use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord as PagesCreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePage extends PagesCreateRecord
{
    protected function getForms(): array
    {
        
        $form = $this->form(static::getResource()::form(
            $this->makeForm()
                ->operation('create')
                ->model($this->getModel())
                ->statePath($this->getFormStatePath())
                ->columns($this->hasInlineLabels() ? 1 : 2)
                ->inlineLabel($this->hasInlineLabels()),
        ));
        
        $form->components(array_merge(
            static::getResource()::upperFields(),
            $form->getComponents()
        ));

        return [
            'form' => $form,
        ];
    }
}
