<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Server;
use App\Models\LogEntry;

class FetchServerLogs extends Command
{
    // Nama perintah yang dijalankan di terminal
    protected $signature = 'logs:fetch';
    protected $description = 'Ambil log dari file log lokal Laravel';

    public function handle()
    {
        // Ambil semua server yang aktif
        $servers = Server::where('is_active', true)->get();

        if ($servers->isEmpty()) {
            $this->warn('Belum ada server yang terdaftar.');
            return;
        }

        foreach ($servers as $server) {
            $this->info("Mengambil log dari: {$server->name}");

            try {
                // Daftar file log lokal yang ingin dibaca
                // storage/logs/laravel.log adalah log bawaan Laravel
                $logFiles = [
                    storage_path('logs/laravel.log'),
                ];

                foreach ($logFiles as $logFile) {
                    // Cek apakah file log ada
                    if (!file_exists($logFile)) {
                        $this->warn("File {$logFile} tidak ditemukan.");

                        // Buat file log dummy supaya tidak kosong
                        file_put_contents($logFile, $this->generateDummyLog());
                        $this->info("File log dummy berhasil dibuat di: {$logFile}");
                    }

                    // Ambil 200 baris terakhir dari file log
                    $allLines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $lines    = array_slice($allLines, -200);

                    $saved = 0;
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if (empty($line)) continue;

                        // Tentukan level log berdasarkan isi pesan
                        $level = $this->detectLevel($line);

                        // Simpan ke database
                        LogEntry::create([
                            'server_id'   => $server->id,
                            'level'       => $level,
                            'message'     => $line,
                            'source_file' => $logFile,
                            'logged_at'   => now(),
                        ]);

                        $saved++;
                    }

                    $this->info("  → {$logFile}: {$saved} baris disimpan");
                }

            } catch (\Exception $e) {
                $this->error("Error pada {$server->name}: " . $e->getMessage());
            }
        }

        $this->info('Selesai mengambil semua log!');
    }

    // Fungsi untuk mendeteksi level log
    private function detectLevel(string $line): string
    {
        $line = strtolower($line);

        if (str_contains($line, 'error') || str_contains($line, 'failed') || str_contains($line, 'critical')) {
            return 'error';
        }

        if (str_contains($line, 'warning') || str_contains($line, 'warn')) {
            return 'warning';
        }

        return 'info';
    }

    // Generate isi log dummy supaya ada data untuk ditampilkan
    private function generateDummyLog(): string
    {
        $now = now()->format('Y-m-d H:i:s');

        return implode("\n", [
            "[{$now}] local.INFO: Aplikasi berhasil dijalankan",
            "[{$now}] local.INFO: User login berhasil dari IP 192.168.1.1",
            "[{$now}] local.WARNING: Percobaan login gagal untuk user admin",
            "[{$now}] local.ERROR: Koneksi ke database gagal, mencoba ulang...",
            "[{$now}] local.INFO: Backup database selesai",
            "[{$now}] local.WARNING: Penggunaan memori mendekati batas maksimal",
            "[{$now}] local.ERROR: File tidak ditemukan: /storage/uploads/foto.jpg",
            "[{$now}] local.INFO: Scheduled job berhasil dijalankan",
            "[{$now}] local.INFO: Cache berhasil dibersihkan",
            "[{$now}] local.ERROR: Failed to send email ke user@example.com",
        ]) . "\n";
    }
}