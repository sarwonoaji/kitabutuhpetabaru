<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    public static function compress(
        $file,
        $folder = 'img/default',
        $maxSizeKB = 100,
        $maxWidth = 1200
    ) {
        $filename = uniqid('img_', true) . '.jpg';
        $destination = public_path($folder);

        // buat folder kalau belum ada
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        // resize hanya jika terlalu besar
        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        $quality = 85;
        $minQuality = 50;

        do {
            $encoded = $image->toJpeg($quality);
            $size = strlen($encoded);
            $quality -= 5;
        } while ($size > $maxSizeKB * 1024 && $quality >= $minQuality);

        file_put_contents($destination . '/' . $filename, $encoded);

        return $filename;
    }

    public static function delete($folder, $filename)
    {
        $path = public_path($folder . '/' . $filename);

        if ($filename && file_exists($path)) {
            unlink($path);
        }
    }
}