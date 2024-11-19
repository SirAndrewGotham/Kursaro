<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseFeature extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'course_features';

    public static $searchable = [
        'name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'feature_id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function featureCourseFeatures()
    {
        return $this->hasMany(self::class, 'feature_id', 'id');
    }

    public function feature()
    {
        return $this->belongsTo(self::class, 'feature_id');
    }
}
