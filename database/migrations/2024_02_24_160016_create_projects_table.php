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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string("project_title");
            $table->text("project_description");
            $table->text("project_qualification");
            $table->text("project_skill");
            $table->enum("job_type", ["onsite", "offsite"]);
            $table->enum("status", ["open", "closed"])->default("open");
            $table->timestamp("start_date");
            $table->date("end_date")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
