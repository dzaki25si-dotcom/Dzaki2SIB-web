<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    protected $fillable = [
    'first_name','last_name','birthday',
    'gender','email','phone'
    ];
public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
{
    foreach ($filterableColumns as $column) {
        if ($request->filled($column)) {
            $query->where($column, $request->input($column));
        }
    }
    return $query;
}
public function scopeSearch(Builder $query, $request, array $searchableColumns): Builder
{
    if ($request->filled('search')) {
        $searchTerm = $request->input('search');
        $query->where(function ($query) use ($searchTerm, $searchableColumns) {
            foreach ($searchableColumns as $column) {
                $query->orWhere($column, 'LIKE', "%{$searchTerm}%");
            }
        });
    }
    return $query;
}

}
