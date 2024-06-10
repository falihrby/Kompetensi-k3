<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peserta;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordsToPlainText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:passwords-plaintext';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all passwords to plain text in Peserta model';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pesertas = Peserta::all();

        foreach ($pesertas as $peserta) {
            $peserta->password = 'newpassword'; // Set a default plain text password or convert if possible
            $peserta->save();
        }

        $this->info('Passwords have been updated to plain text.');

        return 0;
    }
}
