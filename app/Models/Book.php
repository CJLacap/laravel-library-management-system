<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
    
    public function bookCategories(): HasMany{
        return $this->hasMany(BookCategory::class);
    }
    public function borrowBooks(): HasMany{
        return $this->hasMany(BorrowBook::class)->where('status', 'borrowed');
    }

    public function bookLocations(): HasMany{
        return $this->hasMany(BookLocation::class);
    }

    


}
