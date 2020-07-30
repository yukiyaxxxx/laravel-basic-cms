<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class InquiryType
 * @package App\Enums
 */
final class InquiryType extends Enum
{
    const TYPE1 = 'type1';
    const TYPE2 = 'type2';
    const TYPE3 = 'type3';

    /**
     * Get the description for an enum value
     *
     * @param  int  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::TYPE1:
                return '種別1';
                break;
            case self::TYPE2:
                return '種別2';
                break;
            case self::TYPE3:
                return '種別3';
                break;
            default:
                return self::getKey($value);
        }
    }

}
