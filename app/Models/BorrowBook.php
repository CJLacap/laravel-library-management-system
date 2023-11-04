<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBook extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function librarian(){
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $casts = [
        'due_at' => 'datetime',
        'returned_at' => 'datetime'
    ];
    
    
}
