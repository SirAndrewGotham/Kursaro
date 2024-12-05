<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'pages';

//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $slug = Str::slug($model->title);
            $originalSlug = $slug;
            $count = 2;
            while (static::whereSlug($slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $model->slug = $slug;
        });
    }

    public static $searchable = [
        'title',
        'content',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'is_default',
        'page_id',
        'language_id',
        'title',
        'slug',
        'content',
        'views',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function pagePages(): HasMany
    {
        return $this->hasMany(self::class, 'page_id', 'id');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(self::class, 'page_id', 'id');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(self::class, 'page_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'page_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
