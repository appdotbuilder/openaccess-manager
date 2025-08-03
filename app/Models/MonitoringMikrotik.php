<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MonitoringMikrotik
 *
 * @property int $id
 * @property int $pelanggan_id
 * @property string|null $session_id
 * @property string|null $uptime
 * @property int $bytes_in
 * @property int $bytes_out
 * @property string|null $caller_id
 * @property string|null $address
 * @property bool $is_online
 * @property \Illuminate\Support\Carbon|null $last_seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Pelanggan $pelanggan
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik query()
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik wherePelangganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereUptime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereBytesIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereBytesOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereCallerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereIsOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereLastSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonitoringMikrotik whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class MonitoringMikrotik extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'monitoring_mikrotik';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pelanggan_id',
        'session_id',
        'uptime',
        'bytes_in',
        'bytes_out',
        'caller_id',
        'address',
        'is_online',
        'last_seen',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pelanggan_id' => 'integer',
        'bytes_in' => 'integer',
        'bytes_out' => 'integer',
        'is_online' => 'boolean',
        'last_seen' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the pelanggan for this monitoring data.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /**
     * Get formatted traffic data.
     */
    public function getFormattedTrafficAttribute(): array
    {
        return [
            'download' => $this->formatBytes($this->bytes_in),
            'upload' => $this->formatBytes($this->bytes_out),
            'total' => $this->formatBytes($this->bytes_in + $this->bytes_out),
        ];
    }

    /**
     * Format bytes to human readable format.
     */
    protected function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}