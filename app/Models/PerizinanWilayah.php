<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PerizinanWilayah
 *
 * @property int $id
 * @property int $wilayah_id
 * @property string $nama_dokumen
 * @property string $file_path
 * @property string $file_type
 * @property string $status_izin
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Wilayah $wilayah
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah query()
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereWilayahId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereNamaDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereStatusIzin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerizinanWilayah whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class PerizinanWilayah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perizinan_wilayah';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'wilayah_id',
        'nama_dokumen',
        'file_path',
        'file_type',
        'status_izin',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'wilayah_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the wilayah that owns this perizinan.
     */
    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}