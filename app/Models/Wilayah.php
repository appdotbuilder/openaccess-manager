<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Wilayah
 *
 * @property int $id
 * @property string $nama_wilayah
 * @property string $provinsi
 * @property string $kota
 * @property string $kecamatan
 * @property string $desa
 * @property string|null $koordinat_lat
 * @property string|null $koordinat_lng
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PerangkatJaringan> $perangkatJaringan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RabWilayah> $rabWilayah
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PerizinanWilayah> $perizinanWilayah
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pelanggan> $pelanggan
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereNamaWilayah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereProvinsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereKota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereDesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereKoordinatLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereKoordinatLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilayah whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class Wilayah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wilayah';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_wilayah',
        'provinsi',
        'kota',
        'kecamatan',
        'desa',
        'koordinat_lat',
        'koordinat_lng',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all perangkat jaringan for this wilayah.
     */
    public function perangkatJaringan(): HasMany
    {
        return $this->hasMany(PerangkatJaringan::class);
    }

    /**
     * Get all RAB for this wilayah.
     */
    public function rabWilayah(): HasMany
    {
        return $this->hasMany(RabWilayah::class);
    }

    /**
     * Get all perizinan for this wilayah.
     */
    public function perizinanWilayah(): HasMany
    {
        return $this->hasMany(PerizinanWilayah::class);
    }

    /**
     * Get all pelanggan in this wilayah.
     */
    public function pelanggan(): HasMany
    {
        return $this->hasMany(Pelanggan::class);
    }

    /**
     * Get total RAB cost for this wilayah.
     */
    public function getTotalRabAttribute(): float
    {
        return $this->rabWilayah->sum('total_harga');
    }
}