<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories'; // Tên bảng trong cơ sở dữ liệu

    // Định nghĩa các thuộc tính có thể được gán hàng loạt
    protected $fillable = ['name', 'description', 'image'];
}
