<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // 書き込み許可するカラム
    protected $fillable = [
        'user_id',
        'name',
    ];

    // グループは複数のメンバーを持つ
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    // グループは複数の支出記録を持つ
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
