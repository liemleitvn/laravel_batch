<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Table posts with the model
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'content',
        'picture',
        'status',
        'content',
        'approved_id',
        'category_id',
        'user_id',
        'post_like_count',
        'comment_like_count'
    ];

//    protected $appends = ['category','user'];
//
//    public function getCategoryAttribute() {
//        return Category::find($this->category_id)->name;
//    }
//
//    public function getUserAttribute() {
//        return User::find($this->user_id)->name;
//    }

    /**
     * Relative with categories table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relative with user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user () {
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    public function likesCounter() {
        return $this->belongsTo(LikesCounter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
