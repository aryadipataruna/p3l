<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $table = 'owners'; // Specify the table name if it's not the plural of the class name

    protected $primaryKey = 'ID_OWNER'; // Specify the primary key column if it's not 'id'

    public $timestamps = false; // Set to true if you have 'created_at' and 'updated_at' columns

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NAMA_OWNER',
        'EMAIL_OWNER',
        'NOTELP_OWNER',
        'ALAMAT_OWNER',
        'PASSWORD_OWNER',
        // Add other columns that should be mass assignable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'PASSWORD_OWNER',
        // Add other sensitive attributes you want to hide
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'EMAIL_OWNER_verified_at' => 'datetime',
        'PASSWORD_OWNER'          => 'hashed', // Automatically hash the password when set
    ];
}
