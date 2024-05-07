<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'user_id',
        'content',
        // 'parent_id',
        'post_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }


   /**
     * Get the parent comment.
     */
    // public function parent()
    // {
    //     return $this->belongsTo(Comment::class, 'parent_id');
    // }

    /**
     * Get the replies (child comments).
     */
    // public function children()
    // {
    //     return $this->hasMany(Comment::class, 'parent_id');
    // }
}
