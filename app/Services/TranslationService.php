<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;


class TranslationService
{
    /**
     * Translates specified fields from the source language to all other supported languages.
     *
     * @param string $lang The source language code.
     * @param array $data The data array containing the fields to translate.
     * @param array $fields An array of fields to translate.
     * @return array The updated data array with translated fields.
     */
    public static function translateFields($lang, $data, $fields)
    {
        $languages = ['ka', 'en', 'ru']; // Supported languages

        foreach ($fields as $field) {
            $sourceField = $field . '_' . $lang;
            if (isset($data[$sourceField])) {
                foreach ($languages as $targetLang) {
                    if ($targetLang != $lang) {
                        $targetField = $field . '_' . $targetLang;
                        $data[$targetField] = GoogleTranslate::trans($data[$sourceField], $targetLang, $lang);
                    }
                }
            }
        }

        return $data;
    }

    public static function translateFieldsParentKey($lang, $data, $fieldsToTranslate)
    {
        foreach ($fieldsToTranslate as $parentKey => $fields) {
            foreach ($fields as $field) {
                $sourceField = "{$field}_{$lang}";
                if (isset($data[$parentKey][$sourceField])) {
                    $sourceText = $data[$parentKey][$sourceField];
                    foreach (['ka', 'en', 'ru'] as $targetLang) {
                        if ($targetLang !== $lang) {
                            $targetField = "{$field}_{$targetLang}";
                            $data[$parentKey][$targetField] = GoogleTranslate::trans($sourceText, $targetLang, $lang);
                        }
                    }
                }
            }
        }
        return $data;
    }

}
