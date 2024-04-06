<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    // mass assignment

    //protected $guarded = []

    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at'
    // ];

    # eager loading
    // protected $with = ['user:id,name,image', 'comments.user:id, name, image'];

    # eager load with count

    protected $withCount = ['likes'];

    protected $fillable = [
        'content',
        'user_id'
    ];


    public function comments(){
        return $this -> hasMany(Comment::class, 'idea_id', 'id');
    }

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function likes(){
        return $this -> belongsToMany(User::class, 'idea_like')->withTimestamps();
    }

    // scopes

    public function scopeSearch(Builder $query, $search = ''): void{
       $query->where('content', 'like', '%' . $search . '%');
    }
}
