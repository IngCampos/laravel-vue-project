<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_sections', function (Blueprint $table) {
            $table->id();
            $table->boolean('isInternational'); //or Nacional
            $table->integer('number');
            $table->year('year');
            $table->timestamps();
        });

        Schema::table('tenders', function (Blueprint $table) {
            $table->foreignId('tender_section_id')->after('link')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenders', function (Blueprint $table) {
            $table->dropForeign(['tender_section_id']);
        });

        Schema::dropIfExists('tender_sections');
    }
}
