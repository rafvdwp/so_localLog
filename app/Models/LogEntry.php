<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogEntry extends Model
{
    protected $fillable = ['server_id', 'level', 'message', 'source_file', 'logged_at'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}