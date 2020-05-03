<?php

namespace App\Models;

use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Image;

/**
 * \Designfy\Template\Models\File
 *
 * @property int         $id
 * @property string|null $title
 * @property string|null $original_filename
 * @property string|null $extension
 * @property string      $path
 * @property string|null $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereExtension($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereOriginalFilename($value)
 * @method static Builder|File wherePath($value)
 * @method static Builder|File whereTitle($value)
 * @method static Builder|File whereType($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @mixin Eloquent
 */
class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'original_filename',
        'extension',
        'path',
    ];

    /**
     * Check if file exist.
     *
     * @return bool
     */
    public function isFound()
    {
        return \File::isFile(public_path('storage/' . $this->path));
    }

    /**
     * Check if file not exist.
     *
     * @return bool
     */
    public function isNotFound()
    {
        return !$this->isFound();
    }

    /**
     * Add uploaded file to storage.
     *
     * @param UploadedFile $uploadedFile
     * @param null         $title
     *
     * @return File|null
     */
    public static function storeFile(UploadedFile $uploadedFile, $title = null)
    {
        $file = new self();
        try {
            $file->path = $uploadedFile->store('files', 'public');
            $file->original_filename = $uploadedFile->getClientOriginalName();
            $file->title = $title ?? $uploadedFile->getClientOriginalName();
            $file->extension = $uploadedFile->extension();
            $file->type = File::guessFileType(mime_content_type(storage_path('app/public/' . $file->path)));
            if (!$file->save()) {
                throw new Exception(__('Error while saving file'));
            }
        } catch (Exception $e) {
            self::removeFile($file->path);
            return null;
        }
        return $file;
    }

    /**
     * Get mime type.
     *
     * @return string
     */
    public function getMime()
    {
        if (!\File::isFile(public_path('storage/' . $this->path))) {
            return 'image/png'; // Defualt image mime type.
        }
        return mime_content_type(public_path('storage/' . $this->path));
    }

    /**
     * Delete file from storage, and delete sizes if its image.
     *
     * @param $path
     */
    public static function removeFile($path)
    {
        $path = \File::name($path);
        $files = glob(storage_path('app/public/') . explode('.', $path)[0] . "*");
        foreach ($files as $file) {
            try {
                unlink($file);
            } catch (Exception $exception) {
            }
        }
    }

    /**
     * Resize image.
     *
     * @param array|null  $size              Array of Width * Height.
     * @param string|null $overrideExtension New file extension.
     *
     * @return string URL
     */
    public function getUrl($size = null, $overrideExtension = null)
    {
        if (!\File::isFile(public_path('storage/' . $this->path))) {
            return $this->getDefaultImage($size);
        }

        if (array_search($this->getMime(), ['image/svg', 'image/svg+xml'])) {
            return asset('storage/' . ($this->path ?? ''));
        }

        if (!$size && !$overrideExtension) {
            return asset('storage/' . ($this->path ?? ''));
        }

        $absolute_path = public_path('storage/' . $this->path);
        $dir = \File::dirname($absolute_path);
        $subDirectory = substr($dir, strpos($dir, 'storage') + strlen('storage'));
        $ext = $overrideExtension ?: \File::extension($absolute_path);
        $name = \File::name($absolute_path);
        [$width, $height] = $size;
        $new_name = "{$name}_{$width}_{$height}.{$ext}";

        $new_path = "{$dir}/{$new_name}";
        if (!\File::exists($new_path)) {
            if ($size) {
                Image::make($absolute_path)->fit($width, $height)->save($new_path, 70);
            } else {
                Image::make($absolute_path)->save($new_path, 70);
            }
        }
        return asset("storage/$subDirectory/$new_name");
    }

    /**
     * Delete file from storage and database.
     *
     * @return bool|null
     * @throws Exception
     */
    public function delete()
    {
        try {
            self::removeFile($this->path);
        } catch (Exception $e) {
            \Log::error('Delete file error: ' . $e->getMessage());
        }

        return parent::delete();
    }

    /**
     * Get cropped Default image.
     *
     * @param array|null $size Array of Width * Height.
     *
     * @return string URL
     */
    public function getDefaultImage($size)
    {
        if (!\File::isFile(public_path(config('dashboard.default_image_path')))) {
            return null;
        }

        if (!$size) {
            return asset(config('dashboard.default_image_path'));
        }

        $absolute_path = public_path(config('dashboard.default_image_path'));
        [$width, $height] = $size;
        $new_name = "default_{$width}_{$height}.png";
//        $new_path = public_path("img/$new_name");
        $new_path = public_path("storage/$new_name");
        if (!\File::exists($new_path)) {
            Image::make($absolute_path)->fit($width, $height)->save($new_path, 100);
        }
        return asset("storage/$new_name");
    }

    /**
     * file type
     *
     * @param $mime_type
     *
     * @return string
     */
    public static function guessFileType($mime_type)
    {
        if (in_array($mime_type, ['text/plain', 'text/html', 'text/css', 'text/javascript'])) {
            return 'text';
        }

        if (in_array($mime_type, ['image/gif', 'image/png', 'image/jpeg', 'image/bmp', 'image/webp'])) {
            return 'image';
        }

        if (in_array($mime_type, ['audio/midi', 'audio/mpeg', 'audio/webm', 'audio/ogg', 'audio/wav'])) {
            return 'audio';
        }

        if (in_array($mime_type, ['video/webm', 'video/ogg', 'video/mp4', 'video/3gpp', 'video/quicktime'])) {
            return 'video';
        }

        if (in_array($mime_type, ['application/pdf'])) {
            return 'pdf';
        }

        if (in_array($mime_type, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
            return 'msword';
        }

        if (in_array($mime_type, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])) {
            return 'msexcel';
        }

        return 'error';
    }

    // public function getThumb()
    // {
    //     $type = $this->type;
    //     if ($type == 'image') {
    //         return asset('storage/' . $this->path);
    //     } elseif ($type == 'pdf') {
    //         return asset('img/pdf.png');
    //     } else {
    //         return asset('img/file.png');
    //     }
    // }
}
