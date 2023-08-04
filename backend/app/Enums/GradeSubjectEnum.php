<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static MATH()
 * @method static static ENGLISH()
 * @method static static MUSIC()
 */
final class GradeSubjectEnum extends Enum
{
    public const MATH = 'Math';
    public const ENGLISH = 'English';
    public const MUSIC = 'Music';
}
