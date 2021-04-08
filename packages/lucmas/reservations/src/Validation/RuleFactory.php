<?php


namespace Lucmas\Reservations\Validation;

use Astrotomic\Translatable\Validation\RuleFactory as TranslatableRuleFactory;

class RuleFactory extends TranslatableRuleFactory {

    protected function replacePlaceholder(string $locale, string $value): string
    {
        //richiesta solo la lingua principale
        if (preg_match('(required)', $value) && $locale != config('translatable.locale')) {
            return '';
        }

        return parent::replacePlaceholder($locale, $value);
    }
}
