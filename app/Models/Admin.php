<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins'; // Specify the table name

    protected $primaryKey = 'ID_ADMIN'; // Specify the primary key column

    public $timestamps = false; // Set to true if you have 'created_at' and 'updated_at'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NAMA_ADMIN',
        'EMAIL_ADMIN',
        'NOTELP_ADMIN',
        'ALAMAT_ADMIN',
        'PASSWORD_ADMIN',
        // Add other fillable columns
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'PASSWORD_ADMIN',
        // Add other hidden attributes
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'EMAIL_ADMIN_verified_at' => 'datetime',
        'PASSWORD_ADMIN'          => 'hashed', // Automatically hash the password
    ];
}
