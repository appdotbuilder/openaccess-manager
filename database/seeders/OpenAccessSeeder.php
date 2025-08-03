<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPerangkat;
use App\Models\PaketInternet;
use App\Models\Wilayah;
use App\Models\Pelanggan;
use App\Models\PerangkatJaringan;
use App\Models\Tagihan;
use App\Models\MonitoringMikrotik;

class OpenAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Jenis Perangkat
        $jenisPerangkat = [
            ['nama' => 'ODC', 'deskripsi' => 'Optical Distribution Cabinet', 'icon' => '📡', 'is_active' => true],
            ['nama' => 'ODP', 'deskripsi' => 'Optical Distribution Point', 'icon' => '🔌', 'is_active' => true],
            ['nama' => 'Closure', 'deskripsi' => 'Fiber Optic Closure', 'icon' => '🔗', 'is_active' => true],
            ['nama' => 'Tiang', 'deskripsi' => 'Utility Pole', 'icon' => '🗼', 'is_active' => true],
            ['nama' => 'ONU', 'deskripsi' => 'Optical Network Unit', 'icon' => '📦', 'is_active' => true],
        ];

        foreach ($jenisPerangkat as $jenis) {
            JenisPerangkat::create($jenis);
        }

        // Seed Paket Internet
        $paketInternet = [
            [
                'nama_paket' => 'Home 10Mbps',
                'bandwidth_download' => '10Mbps',
                'bandwidth_upload' => '10Mbps',
                'harga_bulanan' => 150000,
                'deskripsi' => 'Paket internet rumahan 10Mbps unlimited',
                'is_active' => true
            ],
            [
                'nama_paket' => 'Home 20Mbps',
                'bandwidth_download' => '20Mbps',
                'bandwidth_upload' => '20Mbps',
                'harga_bulanan' => 250000,
                'deskripsi' => 'Paket internet rumahan 20Mbps unlimited',
                'is_active' => true
            ],
            [
                'nama_paket' => 'Business 50Mbps',
                'bandwidth_download' => '50Mbps',
                'bandwidth_upload' => '50Mbps',
                'harga_bulanan' => 500000,
                'deskripsi' => 'Paket internet bisnis 50Mbps dengan SLA',
                'is_active' => true
            ],
            [
                'nama_paket' => 'Enterprise 100Mbps',
                'bandwidth_download' => '100Mbps',
                'bandwidth_upload' => '100Mbps',
                'harga_bulanan' => 900000,
                'deskripsi' => 'Paket internet enterprise 100Mbps dedicated',
                'is_active' => true
            ],
        ];

        foreach ($paketInternet as $paket) {
            PaketInternet::create($paket);
        }

        // Seed Wilayah
        $wilayahData = [
            [
                'nama_wilayah' => 'Perumahan Griya Asri',
                'provinsi' => 'Jawa Barat',
                'kota' => 'Bandung',
                'kecamatan' => 'Sukajadi',
                'desa' => 'Pasteur',
                'koordinat_lat' => '-6.8952',
                'koordinat_lng' => '107.5731',
                'status' => 'completed'
            ],
            [
                'nama_wilayah' => 'Komplek Buah Batu',
                'provinsi' => 'Jawa Barat',
                'kota' => 'Bandung',
                'kecamatan' => 'Buah Batu',
                'desa' => 'Sekejati',
                'koordinat_lat' => '-6.9734',
                'koordinat_lng' => '107.6344',
                'status' => 'completed'
            ],
            [
                'nama_wilayah' => 'Dago Premium Residence',
                'provinsi' => 'Jawa Barat',
                'kota' => 'Bandung',
                'kecamatan' => 'Coblong',
                'desa' => 'Dago',
                'koordinat_lat' => '-6.8625',
                'koordinat_lng' => '107.6190',
                'status' => 'draft'
            ]
        ];

        foreach ($wilayahData as $wilayah) {
            Wilayah::create($wilayah);
        }

        // Seed Pelanggan dummy data
        $pelangganData = [
            [
                'kode_pelanggan' => 'PLG202401001',
                'nama' => 'Ahmad Hidayat',
                'email' => 'ahmad.hidayat@email.com',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Sukajadi No. 123, Bandung',
                'paket_internet_id' => 1,
                'wilayah_id' => 1,
                'username_pppoe' => 'ahmad123',
                'password_pppoe' => 'pass123',
                'ip_address' => '192.168.1.100',
                'status' => 'aktif',
                'tanggal_mulai' => now()->subMonths(6),
                'tanggal_berakhir' => now()->addMonths(6),
            ],
            [
                'kode_pelanggan' => 'PLG202401002',
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@email.com',
                'telepon' => '081234567891',
                'alamat' => 'Jl. Buah Batu No. 456, Bandung',
                'paket_internet_id' => 2,
                'wilayah_id' => 2,
                'username_pppoe' => 'siti456',
                'password_pppoe' => 'pass456',
                'ip_address' => '192.168.1.101',
                'status' => 'aktif',
                'tanggal_mulai' => now()->subMonths(3),
                'tanggal_berakhir' => now()->addMonths(9),
            ],
            [
                'kode_pelanggan' => 'PLG202401003',
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'telepon' => '081234567892',
                'alamat' => 'Jl. Pasteur No. 789, Bandung',
                'paket_internet_id' => 3,
                'wilayah_id' => 1,
                'username_pppoe' => 'budi789',
                'password_pppoe' => 'pass789',
                'ip_address' => '192.168.1.102',
                'status' => 'expired',
                'tanggal_mulai' => now()->subYear(),
                'tanggal_berakhir' => now()->subMonth(),
            ]
        ];

        foreach ($pelangganData as $pelanggan) {
            Pelanggan::create($pelanggan);
        }

        // Seed Tagihan
        foreach (Pelanggan::all() as $pelanggan) {
            // Create 3 months of billing history
            for ($i = 2; $i >= 0; $i--) {
                $periodeStart = now()->subMonths($i)->startOfMonth();
                $periodeEnd = now()->subMonths($i)->endOfMonth();
                
                Tagihan::create([
                    'pelanggan_id' => $pelanggan->id,
                    'nomor_tagihan' => 'INV' . now()->subMonths($i)->format('Ym') . str_pad((string)$pelanggan->id, 3, '0', STR_PAD_LEFT),
                    'periode_mulai' => $periodeStart,
                    'periode_akhir' => $periodeEnd,
                    'jumlah_tagihan' => $pelanggan->paketInternet->harga_bulanan,
                    'denda' => $i == 0 && $pelanggan->status === 'expired' ? 50000 : 0,
                    'total_bayar' => $pelanggan->paketInternet->harga_bulanan + ($i == 0 && $pelanggan->status === 'expired' ? 50000 : 0),
                    'tanggal_jatuh_tempo' => $periodeEnd->addDays(7),
                    'status' => $i == 0 && $pelanggan->status === 'expired' ? 'overdue' : ($i == 0 ? 'pending' : 'paid'),
                ]);
            }
        }

        // Seed Monitoring Mikrotik (dummy data)
        foreach (Pelanggan::where('status', 'aktif')->get() as $pelanggan) {
            MonitoringMikrotik::create([
                'pelanggan_id' => $pelanggan->id,
                'session_id' => 'sess_' . $pelanggan->id . '_' . random_int(1000, 9999),
                'uptime' => random_int(1, 48) . 'h' . random_int(1, 59) . 'm',
                'bytes_in' => random_int(1000000000, 5000000000), // 1-5 GB
                'bytes_out' => random_int(100000000, 1000000000), // 100MB-1GB
                'caller_id' => $pelanggan->username_pppoe,
                'address' => $pelanggan->ip_address,
                'is_online' => true,
                'last_seen' => now()->subMinutes(random_int(1, 30)),
            ]);
        }

        // Seed Perangkat Jaringan
        $perangkatData = [
            [
                'wilayah_id' => 1,
                'jenis_perangkat_id' => 1, // ODC
                'nama_perangkat' => 'ODC-GriyaAsri-01',
                'koordinat_x' => '100',
                'koordinat_y' => '150',
                'spesifikasi' => '144 Core, Single Mode',
                'status' => 'installed'
            ],
            [
                'wilayah_id' => 1,
                'jenis_perangkat_id' => 2, // ODP
                'nama_perangkat' => 'ODP-GriyaAsri-01',
                'koordinat_x' => '200',
                'koordinat_y' => '180',
                'spesifikasi' => '16 Port Splitter 1:16',
                'status' => 'installed'
            ],
            [
                'wilayah_id' => 2,
                'jenis_perangkat_id' => 1, // ODC
                'nama_perangkat' => 'ODC-BuahBatu-01',
                'koordinat_x' => '120',
                'koordinat_y' => '160',
                'spesifikasi' => '288 Core, Single Mode',
                'status' => 'installed'
            ]
        ];

        foreach ($perangkatData as $perangkat) {
            PerangkatJaringan::create($perangkat);
        }
    }
}