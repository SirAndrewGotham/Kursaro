<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'languages';

    public static $searchable = [
        'code',
        'name',
        'english',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'default',
        'fallback',
        'code',
        'regional',
        'script',
        'dir',
        'flag',
        'name',
        'english',
        'slug',
        'available',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function languageHomes()
    {
        return $this->hasMany(Home::class, 'language_id', 'id');
    }

    public function languageCategories()
    {
        return $this->hasMany(Category::class, 'language_id', 'id');
    }

    public function languageCourses()
    {
        return $this->hasMany(Course::class, 'language_id', 'id');
    }

    public function languageProspects()
    {
        return $this->hasMany(Prospect::class, 'language_id', 'id');
    }

    public function languageBanners()
    {
        return $this->belongsToMany(Banner::class);
    }
}
