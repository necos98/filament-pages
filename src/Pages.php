<?php

namespace Pages;

class Pages
{
    public function getLocaleTranslations()
    {
        return config("pages.locale_translations");
    }

    public function isEnabledLocale(string $lang): bool
    {
        return in_array($lang, $this->getLocaleTranslations());
    }
}
