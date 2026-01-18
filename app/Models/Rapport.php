<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'format',
        'parameters',
        'data',
        'file_path',
        'file_name',
        'file_size',
        'generated_by',
        'classe_id',
        'generated_at',
        'downloaded_at',
        'download_count',
    ];

    protected $casts = [
        'parameters' => 'array',
        'data' => 'array',
        'generated_at' => 'datetime',
        'downloaded_at' => 'datetime',
    ];

    // Relations
    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    // Scopes
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('generated_at', '>=', now()->subDays($days));
    }
}