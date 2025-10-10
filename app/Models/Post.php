<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ["category", "user", "photos"];

    //Accessors
    //laravel 9
    // protected function title(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => strtoupper($value),
    //     );
    // }

    //laravel 8
    protected function getTimeAttribute()
    {
        return "<p class='text-sm mb-0 text-nowrap'><i class='bi bi-calendar'></i>
                                {$this->created_at->format('j M Y')}</p>
                            <p class='text-sm mb-0'><i class='bi bi-clock'></i>
                                {$this->created_at->format('g : m A')}</p>";
    }

    //Mutators

    protected function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function scopeSearch($query)
    {
        return $query->when(request("s"), function ($q) {
            $search = request("s");
            $q->orWhere("title", "like", "%$search%");
            $q->orWhere("description", "like", "%$search%");
        });
    }
}
