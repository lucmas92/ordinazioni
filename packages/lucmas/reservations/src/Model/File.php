<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class File
 * @package App
 *
 * @property int $id
 * @property string mime_type
 * @property string extension
 * @property string filename
 * @property int size
 *
 * @method int static isUsedBy
 *
 * @method static File find(mixed $id)
 * @method static \Illuminate\Database\Eloquent\Builder where(string|array $column, string $relation = null, mixed $value = null)
 */
class File extends Model
{
    use AuditableWithDeletesTrait, SoftDeletes;

    protected $fillable = ['filename', 'filename_original', 'extension', 'mime_type', 'size', 'hash'];

    protected static function boot() {
        parent::boot();
        static::created(function (File $file) {
            if (in_array($file->extension, ['jpg', 'png', 'gif'])) {
                $folderPath = Storage::disk('private')->path('thumbnails') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, str_split($file->id)) . DIRECTORY_SEPARATOR;
                if (!is_dir($folderPath))
                    mkdir($folderPath, 0777, true);

                $source = Storage::disk('private')->path('files' . DIRECTORY_SEPARATOR . "{$file->filename}");

                File::createThumbnail($source, $folderPath, $file->id, $file->extension);

            }//se il sistema operativo non è Linux non creo le miniature per i pdf altrimenti avrei un errore
            elseif ($file->extension == 'pdf' && config('image.create-pdf-thumbnails') && preg_match('(Linux)', php_uname('s'))) {
                $folderPath = Storage::disk('private')->path('thumbnails') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, str_split($file->id)) . DIRECTORY_SEPARATOR;
                if (!is_dir($folderPath))
                    mkdir($folderPath, 0777, true);

                $initial = Storage::disk('private')->path('files' . DIRECTORY_SEPARATOR . $file->filename) . '[0]';

                $dest = storage_path('private'. DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR) . "{$file->id}.png";
                $exec = "convert -flatten $initial $dest";
                shell_exec($exec);

                $source = Storage::disk('private')->path('thumbnails' . DIRECTORY_SEPARATOR . "{$file->id}.png");

                if (Storage::exists($source)) {
                    File::createThumbnail($source, $folderPath, $file->id, 'png');

                    Storage::disk('private')->delete('thumbnails' . DIRECTORY_SEPARATOR . "{$file->id}.png");
                }
                else
                    logger("Thumbnail was not created for file with id {$file->id}. This might occur when ImageMagick is not installed or configuration files prevent access to pdf files due to security issues");
            }
        });
    }

    public static function createThumbnail($source, $folderPath, $fileName, $extension) {
        list($image_width, $image_height, $type) = getimagesize($source);

        switch ($type) {
            case IMAGETYPE_JPEG:
            case IMAGETYPE_JPEG2000: $sourceImage = imagecreatefromjpeg($source); break;
            case IMAGETYPE_PNG: $sourceImage = imagecreatefrompng($source); break;
            case IMAGETYPE_GIF: $sourceImage = imagecreatefromgif($source); break;
        }

        foreach (config('image.values') as $suffix => $val) {
            $newWidth = config('image.thumbnailWidth') * $val;
            $newHeight = config('image.thumbnailHeight') * $val;
            $width = null;
            $height = null;

            if($image_width / $image_height >= $newWidth / $newHeight) {
                $width = $newWidth;
                $height = (int) (($width * $image_height) / $image_width);
            }
            else {
                $height = $newHeight;
                $width = (int) (($height * $image_width) / $image_height);
            }

            $position_x = (int) (($newWidth - $width) / 2);
            $position_y = (int) (($newHeight - $height) / 2);

            $newImage = imagecreatetruecolor($newWidth, $newHeight);

            $color = imagecolorallocate($newImage, 255, 255, 255);

            imagefill($newImage, 0, 0, $color);

            imagecopyresampled($newImage, $sourceImage, $position_x, $position_y, 0, 0, $width, $height, $image_width, $image_height);

            if (!file_exists($folderPath))
                mkdir($folderPath, 0777, true);

            $dest = "$folderPath{$fileName}$suffix.{$extension}";
            switch($type) {
                case IMAGETYPE_JPEG:
                case IMAGETYPE_JPEG2000: imagejpeg($newImage, $dest, 80); break;
                case IMAGETYPE_PNG: imagepng($newImage, $dest, 9); break;
                case IMAGETYPE_GIF: imagegif($newImage, $dest); break;
            }
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function isUsedBy(int $id) {
        return app()->make('AttachmentCategory')::where('file_id', '=', $id)->count()
            + app()->make('AttachmentProduct')::where('file_id', '=', $id)->count()
            + app()->make('ImageProduct')::where('file_id', '=', $id)->count()
            + app()->make('ImageCategory')::where('file_id', '=', $id)->count();
    }

    public function getFormattedSizeAttribute()
    {
        $value = $this->size;
        if ($value < 999)
            return "$value b";
        if ($value < 999999)
            return bcdiv($value, 1000, 2) . ' KB';
        return bcdiv($value, 1000000, 2) . ' MB';
    }
}
