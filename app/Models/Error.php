<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Error extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'code', 'file', 'line', 'message', 'trace'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function createError($exception)
    {
        Error::create([
            'user_id' => Auth::user()->id,
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
        DB::rollback();
        session()->flash('error', 'Webservice Bermasalah');
        return back();
    }
}
