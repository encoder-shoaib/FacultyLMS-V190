<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn('courses', 'masterclass_settings')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->text('masterclass_settings')->nullable()->after('faq_image_media_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('courses', 'masterclass_settings')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->dropColumn('masterclass_settings');
            });
        }
    }
};
