<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\JenisPerangkat
 *
 * @property int $id
 * @property string $nama
 * @property string|null $deskripsi
 * @property string|null $icon
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PerangkatJaringan> $perangkatJaringan
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat query()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerangkat active()

 * 
 * @mixin \Eloquent
 */
class JenisPerangkat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jenis_perangkat';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'icon',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all perangkat jaringan using this jenis.
     */
    public function perangkatJaringan(): HasMany
    {
        return $this->hasMany(PerangkatJaringan::class);
    }

    /**
     * Scope a query to only include active jenis perangkat.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}