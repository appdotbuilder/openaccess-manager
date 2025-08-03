<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RabWilayah
 *
 * @property int $id
 * @property int $wilayah_id
 * @property string $nama_komponen
 * @property string $kategori
 * @property int $qty
 * @property string $satuan
 * @property float $harga_satuan
 * @property float $total_harga
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Wilayah $wilayah
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah query()
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereWilayahId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereNamaKomponen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereSatuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereHargaSatuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereTotalHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RabWilayah whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class RabWilayah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rab_wilayah';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'wilayah_id',
        'nama_komponen',
        'kategori',
        'qty',
        'satuan',
        'harga_satuan',
        'total_harga',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'wilayah_id' => 'integer',
        'qty' => 'integer',
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the wilayah that owns this RAB.
     */
    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}