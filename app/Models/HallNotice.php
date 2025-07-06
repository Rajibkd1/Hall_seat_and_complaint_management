<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallNotice extends Model
{
    use HasFactory;

    protected $primaryKey = 'notice_id';
    
    protected $fillable = [
        'title',
        'notice_type',
        'description',
        'date_posted',
        'admin_id',
        'valid_from',
        'valid_until',
        'status',
        'attachment'
    ];

    protected $casts = [
        'date_posted' => 'datetime',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('notice_type', $type);
    }
}
