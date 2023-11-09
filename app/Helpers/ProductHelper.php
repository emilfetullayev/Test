<?php

namespace App\Helpers;

class ProductHelper
{
    public static function prepareProductData($request)
    {
        $data = [];
        $locales = ['az', 'ru', 'en'];

        foreach ($locales as $locale) {
            $data['title'][$locale] = $request->input("title.$locale", '');
            $data['description'][$locale] = $request->input("description.$locale", '');
        }

        $productData = [
            'title' => $data['title'],
            'description' => $data['description'],
        ];

        return $productData;
    }
}
