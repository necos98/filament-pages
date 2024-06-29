<?php

namespace Pages;

use Filament\Panel;
use Filament\PanelProvider;

class PagesPanelProvider implements PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        dd("a");
        return $panel
            ->id('blog')
            ->path('blog')
            ->resources([
                // ...
            ])
            ->pages([
                // ...
            ])
            ->widgets([
                // ...
            ])
            ->middleware([
                // ...
            ])
            ->authMiddleware([
                // ...
            ]);
    }
}
