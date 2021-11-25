<?php

namespace App\StringRevert;

/**
 * Punctuation to match
 * @var array
 */
const MAP = ['.', ',', '!', '?', ';', ':'];

/**
 * Method reverses a string
 * @param  string $string
 * @return string
 */
function revertCharacters(string $string): string
{
    $words = explode(" ", $string);

    $reverseString = array_reduce($words, function ($acc, $word) {
        $acc[] = revertWord($word);
        return $acc;
    }, []);

    return implode(" ", flatten($reverseString));
}

/**
 * Method reverses a char
 * @param  string $string
 * @return array
 */
function revertWord(string $string): array
{
    $listChars = explode(" ", $string);

    foreach ($listChars as $word) {
        $chars = mb_str_split($word);

        $cleanChars = cleanChars($chars);
        $reversed = array_reverse($cleanChars);

        $lastChar = $reversed[count($reversed) - 1] ?? 0;
        $index = count($reversed) - 1;

        if ($lastChar === mb_strtoupper($lastChar)) {
            $reversed[$index] = mb_strtolower($lastChar);
            $reversed[0] = mb_strtoupper($reversed[0]);
        }
        if ($chars) {
            $reversed[] = addPunctuation($chars);
        }

        $result[] = implode("", $reversed);
    }

    return $result;
}

/**
 * Method to add punctuation
 * @param  array $chars
 * @return string
 */
function addPunctuation(array $chars): string
{
    $punctuation = array_filter($chars, function ($el) {
        return in_array($el, MAP);
    });
    return implode(" ", $punctuation);
}

/**
 * Method remove punctuation
 * @param  array $chars
 * @return array
 */
function cleanChars(array $chars): array
{
    return array_filter($chars, function ($el) {
        return !in_array($el, MAP);
    });
}

/**
 * Method flatten array
 * @param  string|array $items
 * @return array
 */
function flatten($items): array
{
    if (!is_array($items)) {
        return [$items];
    }

    return array_reduce($items, function ($acc, $item) {
        return array_merge($acc, flatten($item));
    }, []);
}
