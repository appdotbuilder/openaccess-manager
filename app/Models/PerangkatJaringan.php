<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PerangkatJaringan
 *
 * @property int $id
 * @property int $wilayah_id
 * @property int $jenis_perangkat_id
 * @property string $nama_perangkat
 * @property string|null $koordinat_x
 * @property string|null $koordinat_y
 * @property string|null $spesifikasi
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Wilayah $wilayah
 * @property-read \App\Models\JenisPerangkat $jenisPerangkat
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereWilayahId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereJenisPerangkatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereNamaPerangkat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereKoordinatX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereKoordinatY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereSpesifikasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerangkatJaringan whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class PerangkatJaringan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perangkat_jaringan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'wilayah_id',
        'jenis_perangkat_id',
        'nama_perangkat',
        'koordinat_x',
        'koordinat_y',
        'spesifikasi',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'wilayah_id' => 'integer',
        'jenis_perangkat_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the wilayah that owns this perangkat.
     */
    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    /**
     * Get the jenis perangkat for this perangkat.
     */
    public function jenisPerangkat(): BelongsTo
    {
        return $this->belongsTo(JenisPerangkat::class);
    }
}