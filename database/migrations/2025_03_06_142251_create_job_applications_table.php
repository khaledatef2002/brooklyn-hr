<?php

use App\Enum\InternshipRequestStatus;
use App\Enum\JobApplicationStatus;
use App\Enum\LanguageRate;
use App\Enum\MilitaryServiceValues;
use App\Enum\ReligionValues;
use App\Enum\SocialStatus;
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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->boolean('do_you_have_health_certificate');
            $table->string('phone_number');
            $table->enum('military_service', [MilitaryServiceValues::COMPLETED->value, MilitaryServiceValues::permenant->value, MilitaryServiceValues::postponed->value]);
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->enum('religion', [ReligionValues::islam->value, ReligionValues::chris->value, ReligionValues::juese->value]);
            $table->enum('social_status', [SocialStatus::SINGLE->value, SocialStatus::MARRIED->value, SocialStatus::WINDOWED->value, SocialStatus::DIVORCED->value]);
            $table->smallInteger('no_of_childs');
            $table->string('position');
            $table->boolean('ready_to_start');
            $table->boolean('any_crime');
            $table->float('expected_salary');
            $table->boolean('work_in_any_place');
            $table->boolean('any_health_problems');

            $table->string('cv');
            $table->enum('status', [JobApplicationStatus::ACCEPTED->value, JobApplicationStatus::PENDING->value, JobApplicationStatus::REJECTED->value])->default(JobApplicationStatus::PENDING->value);
            
            $table->enum('english_spoken', LanguageRate::getList());
            $table->enum('english_written', LanguageRate::getList());
            $table->enum('english_reading', LanguageRate::getList());
            $table->enum('english_comprehension', LanguageRate::getList());

            $table->enum('arabic_spoken', LanguageRate::getList());
            $table->enum('arabic_written', LanguageRate::getList());
            $table->enum('arabic_reading', LanguageRate::getList());
            $table->enum('arabic_comprehension', LanguageRate::getList());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
