<?php

namespace Pages\Interfaces;

use Pages\Models\Page;
use Pages\Models\PageType;

interface PageInterface
{
    public function pageController(): string;
    // public function slug(): string;
    // public function title(): string;
    // public function description(): string;
    // public function parent(): ?Page;
}
