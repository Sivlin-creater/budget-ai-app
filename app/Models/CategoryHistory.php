<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'action',
        'details',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
