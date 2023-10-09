<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static MATH()
 * @method static static MUSIC()
 * @method static static ENGLISH()
 */
final class GradeSubjectEnum extends Enum
{
    public const MATH = "1";
    public const MUSIC = "2";
    public const ENGLISH = "3";
}
