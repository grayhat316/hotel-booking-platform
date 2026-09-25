<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'check_in',
        'check_out',
        'guests',
        'nights',
        'total_price',
        'special_requests',
        'status',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the featured image URL for display.
     * Used as $booking->image_url accessor in admin views.
     */
    public function getImageUrlAttribute()
    {
        // Use the room's image accessor
        if ($this->room && $this->room->image) {
            return $this->room->image_url;
        }

        // Fallback to first gallery image's accessor
        $galleryImage = \App\Models\Gallery::first();
        if ($galleryImage && $galleryImage->image) {
            return $galleryImage->image_url;
        }

        return asset('images/room.svg');
    }
}