<?php

namespace App\Console\Commands;

use App\Models\KompetensiResult;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateKompetensiToKelulusan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:kompetensi-kelulusan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate participants who passed both general and special competencies to kelulusan table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all unique user IDs from the kompetensi_results table
        $userIds = KompetensiResult::distinct()->pluck('user_id');

        foreach ($userIds as $userId) {
            if (KompetensiResult::hasPassedRequiredCompetencies($userId)) {
                $user = User::find($userId);
                if ($user) {
                    // Ensure the 'nomor' field is not null
                    $nomor = $user->nomor ? (string) $user->nomor : '';
                    $name = $user->name ? (string) $user->name : '';
                    $programStudi = $user->program_studi ? (string) $user->program_studi : '';
                    $fakultas = $user->fakultas ? (string) $user->fakultas : '';
                    $instansi = $user->instansi ? (string) $user->instansi : '';

                    DB::table('kelulusan')->updateOrInsert(
                        ['nomor' => $nomor],
                        [
                            'user_id' => $user->id,
                            'nama' => $name,
                            'program_studi' => $programStudi,
                            'fakultas' => $fakultas,
                            'instansi' => $instansi,
                            'keterangan' => 'Lulus Semua Ujian',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                    $this->info("User {$name} (ID: {$userId}) has been migrated to kelulusan table.");
                }
            }
        }

        return 0;
    }
}
