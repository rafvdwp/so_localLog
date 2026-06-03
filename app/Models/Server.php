<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function logEntries()
    {
        return $this->hasMany(LogEntry::class);
    }
}