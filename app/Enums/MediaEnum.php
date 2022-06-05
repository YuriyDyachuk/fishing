<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self width()
 * @method static self height()
 * @method static self formatPNG()
 * @method static self formatMP4()
 * @method static self formatXFLV()
 * @method static self formatMPEGURL()
 * @method static self formatMP2T()
 * @method static self format3GPP()
 * @method static self formatQUICKTIME()
 * @method static self formatXMS()
 * @method static self formatWMV()
 */
class MediaEnum extends Enum
{
    public static function values(): array
    {
        return [
            'width'             => 854,
            'height'            => 480,
            'formatPNG'         => 'png',
            'formatMP4'         => 'video/mp4',
            'formatXFLV'        => 'video/x-flv',
            'formatMPEGURL'     => 'application/x-mpegURL',
            'formatMP2T'        => 'video/MP2T',
            'format3GPP'        => 'video/3gpp',
            'formatQUICKTIME'   => 'video/quicktime',
            'formatXMS'         => 'video/x-msvideo',
            'formatWMV'         => 'video/x-ms-wmv',
        ];
    }

    public static function mediaMimeType(): array
    {
        return explode(
            ',',
            implode(',', [
                self::formatMP4()->value,
                self::formatXFLV()->value,
                self::formatMPEGURL()->value,
                self::formatMP2T()->value,
                self::format3GPP()->value,
                self::formatQUICKTIME()->value,
                self::formatXMS()->value,
                self::formatWMV()->value,
            ])
        );
    }
}