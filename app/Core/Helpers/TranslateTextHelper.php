<?php
namespace App\Core\Helpers;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateTextHelper
{
public static function translate($text, $sourceLanguage = 'es', $targetLanguage = 'en')
{
$tr = new GoogleTranslate();
$tr->setSource($sourceLanguage);
$tr->setTarget($targetLanguage);
return $tr->translate($text);
}
}
?>