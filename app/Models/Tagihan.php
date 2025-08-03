<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Tagihan
 *
 * @property int $id
 * @property int $pelanggan_id
 * @property string $nomor_tagihan
 * @property \Illuminate\Support\Carbon $periode_mulai
 * @property \Illuminate\Support\Carbon $periode_akhir
 * @property float $jumlah_tagihan
 * @property float $denda
 * @property float $total_bayar
 * @property \Illuminate\Support\Carbon $tanggal_jatuh_tempo
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Pelanggan $pelanggan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pembayaran> $pembayaran
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan wherePelangganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereNomorTagihan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan wherePeriodeMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan wherePeriodeAkhir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereJumlahTagihan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereDenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereTotalBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereTanggalJatuhTempo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class Tagihan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tagihan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pelanggan_id',
        'nomor_tagihan',
        'periode_mulai',
        'periode_akhir',
        'jumlah_tagihan',
        'denda',
        'total_bayar',
        'tanggal_jatuh_tempo',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pelanggan_id' => 'integer',
        'periode_mulai' => 'date',
        'periode_akhir' => 'date',
        'jumlah_tagihan' => 'decimal:2',
        'denda' => 'decimal:2',
        'total_bayar' => 'decimal:2',
        'tanggal_jatuh_tempo' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the pelanggan for this tagihan.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /**
     * Get all pembayaran for this tagihan.
     */
    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    /**
     * Generate unique nomor tagihan.
     */
    public static function generateNomorTagihan(): string
    {
        $prefix = 'INV';
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', now())->count() + 1;
        
        return $prefix . $date . str_pad((string)$count, 4, '0', STR_PAD_LEFT);
    }
}