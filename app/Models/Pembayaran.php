<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Pembayaran
 *
 * @property int $id
 * @property int $tagihan_id
 * @property string $kode_pembayaran
 * @property float $jumlah_bayar
 * @property string $metode_pembayaran
 * @property string|null $referensi_pembayaran
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $tanggal_bayar
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Tagihan $tagihan
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereTagihanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereKodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereJumlahBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereMetodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereReferensiPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereTanggalBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class Pembayaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pembayaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tagihan_id',
        'kode_pembayaran',
        'jumlah_bayar',
        'metode_pembayaran',
        'referensi_pembayaran',
        'status',
        'tanggal_bayar',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tagihan_id' => 'integer',
        'jumlah_bayar' => 'decimal:2',
        'tanggal_bayar' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tagihan for this pembayaran.
     */
    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class);
    }

    /**
     * Generate unique kode pembayaran.
     */
    public static function generateKodePembayaran(): string
    {
        $prefix = 'PAY';
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', now())->count() + 1;
        
        return $prefix . $date . str_pad((string)$count, 4, '0', STR_PAD_LEFT);
    }
}