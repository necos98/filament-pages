<?php

namespace Pages\Filament\Support;

use Filament\Resources\Pages\EditRecord as PagesEditRecord;

class EditPage extends PagesEditRecord
{
    protected function getForms(): array
    {

        $form = $this->form(static::getResource()::form(
            $this->makeForm()
                ->operation('edit')
                ->model($this->getRecord())
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
