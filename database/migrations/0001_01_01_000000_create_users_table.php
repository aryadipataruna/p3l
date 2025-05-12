<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Standard users table (e.g., for admins or a general user type if needed)
        // If 'pembeli', 'penitip', 'organisasi' are your primary user types,
        // you might have separate tables for them instead of or in addition to this 'users' table.
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing BigInt primary key
            $table->string('name');
            $table->string('email')->unique(); // Email must be unique within this 'users' table
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken(); // For "remember me" functionality
            $table->timestamps();    // Adds created_at and updated_at columns
        });

        // Modified password_reset_tokens table to support multiple user types
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email');                     // User's email address
            $table->string('user_type');                 // Type of user (e.g., 'pembeli', 'penitip', 'organisasi')
            $table->string('token');                     // The password reset token
            $table->timestamp('created_at')->nullable(); // Timestamp when the token was created

            // Composite primary key: an email can have a token for each user_type
            $table->primary(['email', 'user_type']);

            // Index the token for faster lookups during password reset verification
            $table->index('token');
        });

        // Standard sessions table for managing user sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();                   // Session ID (string)
            $table->foreignId('user_id')->nullable()->index(); // Foreign key to users.id (if sessions are tied to the 'users' table)
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');               // Serialized session data
            $table->integer('last_activity')->index(); // Timestamp of last activity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
