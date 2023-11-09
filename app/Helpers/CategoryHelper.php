<?php

namespace App\Helpers;

class CategoryHelper
{
    public static function prepareCategoryData($request)
    {
        $nameData = [];
        $locales = ['az', 'ru', 'en'];

        foreach ($locales as $locale) {
            $nameData[$locale] = $request->input("name.$locale", '');
        }
        $parent_id = $request->input('parent_id');

        $categoryData = [
            'name' => $nameData,
            'parent_id' => is_null($parent_id) ? null : $parent_id,
        ];

        return $categoryData;
    }
}
