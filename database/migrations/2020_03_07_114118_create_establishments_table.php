<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('establishment_type_id');
            $table->string('name');
            $table->string('contact_name')->nullable();
            $table->string('mobile')->unique();
            $table->string('gst')->nullable();
            $table->string('pan')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('parent_establishment_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_registered')->default(false);
            $table->timestamp('registration_date')->nullable();
            $table->string('agreement')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('beat_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('establishment_status', function (Blueprint $table) {
            $table->unsignedBigInteger('establishment_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamp('updated_at');

            $table->primary(['establishment_id', 'status_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establishments');
        Schema::dropIfExists('establishment_status');
    }
}
