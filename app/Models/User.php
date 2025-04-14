<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasLocation;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'player_origin_id',
        'location_type',
        'location_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function travels()
    {
        return $this->hasMany(Travel::class);
    }

    public function isInTransit()
    {
        return $this->travels()->where('arrives_at', '>', now())->exists();
    }

    public function startTravel($destinationType, $destinationId)
    {
        $distance = $this->calculateDistance($destinationType, $destinationId);
        $travelTime = $this->calculateTravelTime($distance); // In Sekunden

        $travel = Travel::create([
            'user_id' => $this->id,
            'origin_type' => $this->location_type,
            'origin_id' => $this->location_id,
            'destination_type' => $destinationType,
            'destination_id' => $destinationId,
            'started_at' => now(),
            'arrives_at' => now()->addSeconds($travelTime),
        ]);

        return $travel;
    }

    protected function calculateDistance($destinationType, $destinationId)
    {
        $origin = $this->location;
        $destination = match ($destinationType) {
            'system' => System::findOrFail($destinationId),
            'planet' => Planet::findOrFail($destinationId),
            'moon' => Moon::findOrFail($destinationId),
            default => null,
        };

        if (!$origin || !$destination) {
            return 0;
        }

        $originCoords = $this->coordinates;
        $destCoords = match ($destinationType) {
            'system' => ['x' => $destination->x, 'y' => $destination->y],
            'planet' => [
                'x' => $destination->system->x + $destination->orbitRadius * cos(deg2rad($destination->angle)),
                'y' => $destination->system->y + $destination->orbitRadius * sin(deg2rad($destination->angle)),
            ],
            'moon' => [
                'x' => $destination->planet->system->x + $destination->planet->orbitRadius * cos(deg2rad($destination->planet->angle)) + $destination->orbitRadius * cos(deg2rad($destination->angle)),
                'y' => $destination->planet->system->y + $destination->planet->orbitRadius * sin(deg2rad($destination->planet->angle)) + $destination->orbitRadius * sin(deg2rad($destination->angle)),
            ],
            default => ['x' => 0, 'y' => 0],
        };

        return sqrt(
            pow($destCoords['x'] - $originCoords['x'], 2) +
            pow($destCoords['y'] - $originCoords['y'], 2)
        );
    }

    protected function calculateTravelTime($distance)
    {
        return (int) ($distance * 1000);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function playerOrigin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PlayerOrigin::class);
    }
}
