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
        Schema::table('attendances', function (Blueprint $table) {
            if (!Schema::hasColumn('attendances', 'clock_in')) {
                $table->time('clock_in')->nullable()->after('tanggal');
            }
            if (!Schema::hasColumn('attendances', 'clock_out')) {
                $table->time('clock_out')->nullable()->after('clock_in');
            }
            if (!Schema::hasColumn('attendances', 'work_duration')) {
                $table->string('work_duration')->nullable()->comment('Durasi jam kerja real (HH:MM)')->after('clock_out');
            }
            if (!Schema::hasColumn('attendances', 'late_minutes')) {
                $table->integer('late_minutes')->default(0)->comment('Menit keterlambatan masuk')->after('work_duration');
            }
            if (!Schema::hasColumn('attendances', 'early_leave_minutes')) {
                $table->integer('early_leave_minutes')->default(0)->comment('Menit pulang cepat')->after('late_minutes');
            }
            if (!Schema::hasColumn('attendances', 'discipline_points')) {
                $table->integer('discipline_points')->default(0)->comment('Akumulasi poin pelanggaran')->after('early_leave_minutes');
            }
            if (!Schema::hasColumn('attendances', 'action_taken')) {
                $table->string('action_taken')->default('Tidak Ada')->comment('Teguran Lisan, Pembinaan, SP1, SP2, SP3')->after('discipline_points');
            }
            if (!Schema::hasColumn('attendances', 'incentive_penalty_pct')) {
                $table->integer('incentive_penalty_pct')->default(0)->comment('Potongan insentif disiplin (%)')->after('action_taken');
            }
            if (!Schema::hasColumn('attendances', 'notes')) {
                $table->text('notes')->nullable()->comment('Keterangan pelanggaran/poin')->after('incentive_penalty_pct');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $columnsToDrop = array_filter([
                'clock_in',
                'clock_out',
                'work_duration',
                'late_minutes',
                'early_leave_minutes',
                'discipline_points',
                'action_taken',
                'incentive_penalty_pct',
                'notes'
            ], function($column) {
                return Schema::hasColumn('attendances', $column);
            });

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};