<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cs extends Model
{
    use HasFactory;

    protected $table = 'cs'; // Specify the table name

    protected $primaryKey = 'ID_CS'; // Specify the primary key column

    public $timestamps = false; // Set to true if you have 'created_at' and 'updated_at'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NAMA_CS',
        'EMAIL_CS',
        'NOTELP_CS',
        'ALAMAT_CS',
        'PASSWORD_CS',
        // Add other fillable columns
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'PASSWORD_CS',
        // Add other hidden attributes
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'EMAIL_CS_verified_at' => 'datetime',
        'PASSWORD_CS'          => 'hashed', // Automatically hash the password
    ];
}
