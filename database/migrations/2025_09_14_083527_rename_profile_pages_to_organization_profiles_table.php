<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('profile_pages', 'organization_profiles');
    }

    public function down(): void
    {
        Schema::rename('organization_profiles', 'profile_pages');
    }
};
