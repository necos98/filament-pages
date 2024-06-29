<?php

namespace Pages;

class Pages
{
    public function getLocales()
    {
        return config("pages.available_locales");
    }
}
