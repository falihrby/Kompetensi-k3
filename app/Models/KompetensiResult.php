<?php

namespace App\Models;

use App\Events\KompetensiResultCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KompetensiResult extends Model
{
    use HasFactory;

    const GENERAL_COMPETENCY = 'Kompetensi Umum';
    const SPECIAL_COMPETENCY = 'Khusus';
    const PASSED_STATUS = 'Lulus Ujian';

    protected $dispatchesEvents = [
        'created' => KompetensiResultCreated::class,
    ];

    protected $fillable = [
        'name', 'nomor', 'program', 'fakultas', 'instansi', 'kategori_ujian',
        'keterangan', 'waktu_mulai_ujian', 'waktu_selesai_ujian', 'total_questions',
        'jumlah_soal_benar', 'jumlah_soal_salah', 'user_id', 'ujian_ke_berapa',
    ];

    public static function hasPassedGeneralCompetency($participantId)
    {
        return self::where('user_id', $participantId)
            ->where('kategori_ujian', self::GENERAL_COMPETENCY)
            ->where('keterangan', self::PASSED_STATUS)
            ->exists();
    }

    public static function hasPassedSpecialCompetency($participantId)
    {
        return self::where('user_id', $participantId)
            ->where('kategori_ujian', 'LIKE', self::SPECIAL_COMPETENCY . '%')
            ->where('keterangan', self::PASSED_STATUS)
            ->exists();
    }

    public static function hasSpecialCompetencyData($participantId)
    {
        return self::where('user_id', $participantId)
            ->where('kategori_ujian', 'LIKE', self::SPECIAL_COMPETENCY . '%')
            ->exists();
    }

    public static function hasPassedRequiredCompetencies($participantId)
    {
        return self::hasPassedGeneralCompetency($participantId) && self::hasPassedSpecialCompetency($participantId);
    }

    public static function insertKelulusanIfPassed($participantId)
    {
        Log::info('Checking if user has passed required competencies', ['user_id' => $participantId]);

        if (self::hasPassedRequiredCompetencies($participantId)) {
            Log::info('User has passed required competencies', ['user_id' => $participantId]);
            $user = User::find($participantId);
            Log::info('User found', ['user' => $user]);

            if ($user) {
                DB::table('kelulusan')->updateOrInsert(
                    ['nomor' => (string) $user->nomor],
                    [
                        'user_id' => $user->id,
                        'nama' => (string) $user->name,
                        'program_studi' => (string) $user->program_studi,
                        'fakultas' => (string) $user->fakultas,
                        'instansi' => (string) $user->instansi,
                        'keterangan' => 'Lulus Semua Ujian',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
                Log::info('Kelulusan record inserted or updated', ['user' => $user]);
            } else {
                Log::warning('User not found', ['user_id' => $participantId]);
            }
        } else {
            Log::info('User did not pass required competencies', ['user_id' => $participantId]);
        }
    }
}
