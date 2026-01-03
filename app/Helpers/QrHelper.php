<?php

namespace App\Helpers;

use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class QrHelper
{
    public static function generateToFile(string $text, string $filePath, int $size = 300): void
    {
        // Gunakan GDLibRenderer (bukan ImageRenderer + GdImageBackEnd)
        $renderer = new GDLibRenderer($size);
        $writer = new Writer($renderer);
        $writer->writeFile($text, $filePath);
    }
}
