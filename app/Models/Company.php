<?php

namespace App\Models;


use http\Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Intervention\Image\Facades\Image;
use Log;


class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'logo','website'
    ];

    public function setLogoAttribute($logo)
    {
        if (is_string($logo)) {
            try {
                $extension = request()->logo->getClientOriginalExtension();
                $sha1      = sha1(request()->logo->getClientOriginalName());
                $filename  = date('Ymdhis') . '-' . $sha1 . rand(100 , 100000);

                Storage::disk('public')->put('images/avatar/' . $filename . '.' . $extension , File::get(request()->logo));
                $this->attributes['logo'] = File::create([
                    'title'             => $filename,
                    'original_filename' => $filename,
                    'extension'         => $extension,
                    'path'              => 'storage/images/avatar/' . $filename . "." . $extension,
                ])->id;
            } catch (Exception $exception) {
                Log::error('Can\'t save avatar', ['exception' => $exception]);
            }
        } elseif ($logo) {
            $this->attributes['logo'] = File::storeFile($logo)->id;
        }

    }
    public function logo()
    {
        return $this->belongsTo(File::class)->withDefault();
    }
}
