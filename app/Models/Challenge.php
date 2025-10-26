<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'level',
        'encrypted_flag',
        'hints',
        'is_active',
    ];

    protected $casts = [
        'hints' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Encrypt and set the flag
     */
    public function setFlagAttribute($value)
    {
        $this->attributes['encrypted_flag'] = Crypt::encrypt($value);
    }

    /**
     * Decrypt and get the flag
     */
    public function getFlagAttribute()
    {
        return isset($this->attributes['encrypted_flag'])
            ? Crypt::decrypt($this->attributes['encrypted_flag'])
            : null;
    }

    /**
     * Get challenges by level
     */
    public static function getByLevel($level)
    {
        return self::where('level', $level)->where('is_active', true)->get();
    }

    /**
     * Verify if submitted flag is correct
     */
    public function verifyFlag($submittedFlag)
    {
        return $submittedFlag === $this->flag;
    }
}
