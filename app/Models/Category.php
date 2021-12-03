<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    // mass assignment
    protected $guarded = ['id'];

    public function getNamaKategoriAttribute()
    {
        return $this->name;
    }

    public function getCreatedAtWithFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
    }

    public function getUpdatedAtWithFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
    }

    //scope function
    public function scopeGetAllCategoryWithPagination()
    {
        return $this->select(DB::raw('name as kategori, slug as dash, id, created_at, updated_at'))
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(1);
    }

    public function books()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'category_id', 'book_id');
    }
}
