<?php

namespace App\Services;

use App\Models\Faq;

class FaqsService
{
    public static function hasQuestions()
    {
        return Faq::published()->count() > 0;
    }

    public static function get()
    {
        return Faq::published()->get();
    }
}