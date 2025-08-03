<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\PaketInternet
 *
 * @property int $id
 * @property string $nama_paket
 * @property string $bandwidth_download
 * @property string $bandwidth_upload
 * @property float $harga_bulanan
 * @property string|null $deskripsi
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pelanggan> $pelanggan
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereNamaPaket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereBandwidthDownload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereBandwidthUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereHargaBulanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketInternet active()

 * 
 * @mixin \Eloquent
 */
class PaketInternet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paket_internet';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_paket',
        'bandwidth_download',
        'bandwidth_upload',
        'harga_bulanan',
        'deskripsi',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'harga_bulanan' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all pelanggan using this paket.
     */
    public function pelanggan(): HasMany
    {
        return $this->hasMany(Pelanggan::class);
    }

    /**
     * Scope a query to only include active paket.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}