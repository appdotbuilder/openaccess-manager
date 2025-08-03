<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Pelanggan
 *
 * @property int $id
 * @property string $kode_pelanggan
 * @property string $nama
 * @property string $email
 * @property string $telepon
 * @property string $alamat
 * @property int $paket_internet_id
 * @property int $wilayah_id
 * @property string|null $username_pppoe
 * @property string|null $password_pppoe
 * @property string|null $ip_address
 * @property string $status
 * @property \Illuminate\Support\Carbon $tanggal_mulai
 * @property \Illuminate\Support\Carbon $tanggal_berakhir
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\PaketInternet $paketInternet
 * @property-read \App\Models\Wilayah $wilayah
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tagihan> $tagihan
 * @property-read \App\Models\MonitoringMikrotik|null $monitoring
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereKodePelanggan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan wherePaketInternetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereWilayahId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereUsernamePppoe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan wherePasswordPppoe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereTanggalMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereTanggalBerakhir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan aktif()

 * 
 * @mixin \Eloquent
 */
class Pelanggan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pelanggan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kode_pelanggan',
        'nama',
        'email',
        'telepon',
        'alamat',
        'paket_internet_id',
        'wilayah_id',
        'username_pppoe',
        'password_pppoe',
        'ip_address',
        'status',
        'tanggal_mulai',
        'tanggal_berakhir',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'paket_internet_id' => 'integer',
        'wilayah_id' => 'integer',
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the paket internet for this pelanggan.
     */
    public function paketInternet(): BelongsTo
    {
        return $this->belongsTo(PaketInternet::class);
    }

    /**
     * Get the wilayah for this pelanggan.
     */
    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    /**
     * Get all tagihan for this pelanggan.
     */
    public function tagihan(): HasMany
    {
        return $this->hasMany(Tagihan::class);
    }

    /**
     * Get the monitoring data for this pelanggan.
     */
    public function monitoring(): HasOne
    {
        return $this->hasOne(MonitoringMikrotik::class);
    }

    /**
     * Scope a query to only include active pelanggan.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Generate unique kode pelanggan.
     */
    public static function generateKodePelanggan(): string
    {
        $prefix = 'PLG';
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', now())->count() + 1;
        
        return $prefix . $date . str_pad((string)$count, 3, '0', STR_PAD_LEFT);
    }
}