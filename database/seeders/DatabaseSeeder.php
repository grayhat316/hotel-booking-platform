<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use App\Models\Food;
use App\Models\Service;
use App\Models\Gallery;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hotel.test',
            'password' => bcrypt('admin123'),
        ]);

        // Rooms
        Room::insert([
            [
                'name' => 'Single Standard',
                'description' => 'A comfortable single room with modern amenities, ideal for business travelers. Features a cozy workspace, complimentary Wi-Fi, and a plush bed for restful sleep.',
                'price' => 3500,
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&q=75',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Single Superior',
                'description' => 'An upgraded single room with a king-sized bed, private balcony, and city views. Perfect for guests who appreciate extra space and comfort.',
                'price' => 4000,
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=800&q=75',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Double Standard',
                'description' => 'A spacious double room with two queen beds, ideal for friends or couples. Includes a sitting area, work desk, and garden views.',
                'price' => 4500,
                'capacity' => 2,
                'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=75',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Twin Standard',
                'description' => 'A versatile room with two single beds, great for colleagues or family. Features a modern bathroom, ample storage, and a peaceful atmosphere.',
                'price' => 4200,
                'capacity' => 2,
                'image' => 'https://images.unsplash.com/photo-1566666977777-774eb0c88add?w=800&q=75',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Executive Suite',
                'description' => 'Our premium suite with a separate living area, luxurious king bed, and executive amenities. Includes minibar, coffee machine, and panoramic city views.',
                'price' => 8500,
                'capacity' => 3,
                'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=75',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'The crown jewel — two bedrooms, private dining, butler service, and a wraparound terrace. Designed for VIP guests and discerning travelers.',
                'price' => 15000,
                'capacity' => 4,
                'image' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=800&q=75',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Foods
        Food::insert([
            ['name' => 'Pilau ya Kuku', 'description' => 'Spiced rice cooked with chicken, served with kachumbari on the side.', 'price' => 750, 'category' => 'Main Course', 'image' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nyama Choma', 'description' => 'Half kilo of beef ribs grilled over charcoal with ugali and kachumbari.', 'price' => 950, 'category' => 'Grills', 'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chips Masala', 'description' => 'Fried potatoes tossed in masala sauce, served hot.', 'price' => 350, 'category' => 'Snacks', 'image' => 'https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kenyan AA Coffee', 'description' => 'Single origin Kenyan AA, roasted medium and brewed to order.', 'price' => 250, 'category' => 'Beverages', 'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chai ya Tangawizi', 'description' => 'Ginger tea, brewed strong with fresh ginger and milk.', 'price' => 150, 'category' => 'Beverages', 'image' => 'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kuku wa Kupaka', 'description' => 'Half chicken grilled, coated in coconut and tamarind sauce.', 'price' => 1100, 'category' => 'Swahili', 'image' => 'https://images.unsplash.com/photo-1521305916504-4a1121188589?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ugali & Sukuma', 'description' => 'White ugali with collard greens and onion.', 'price' => 350, 'category' => 'Vegetarian', 'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mandazi & Chai', 'description' => 'Four soft mandazi with a pot of tea.', 'price' => 180, 'category' => 'Breakfast', 'image' => 'https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Passion Juice', 'description' => 'Fresh passion fruit, pressed to order.', 'price' => 300, 'category' => 'Beverages', 'image' => 'https://images.unsplash.com/photo-1505253716362-afaea1d3d1af?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mango Lassi', 'description' => 'Yoghurt blended with mango and a little honey.', 'price' => 350, 'category' => 'Beverages', 'image' => 'https://images.unsplash.com/photo-1497534446932-c925b458314e?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Services
        Service::insert([
            ['name' => 'Conference Hall A', 'description' => 'Large conference facility seating 200 guests with projector, sound system, and air conditioning.', 'type' => 'conferencing', 'price' => 15000, 'capacity' => 200, 'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Conference Hall B', 'description' => 'Medium conference room for 50 guests, ideal for workshops and seminars.', 'type' => 'conferencing', 'price' => 8000, 'capacity' => 50, 'image' => 'https://images.unsplash.com/photo-1517502884422-41eaead166d4?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wedding Package', 'description' => 'Full wedding event coordination including catering, decoration, and sound.', 'type' => 'event', 'price' => 75000, 'capacity' => 300, 'image' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corporate Event', 'description' => 'Tailored corporate event planning for launches, dinners, and team-building.', 'type' => 'event', 'price' => 45000, 'capacity' => 150, 'image' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Gallery
        Gallery::insert([
            ['title' => 'Hotel Exterior', 'description' => 'The main entrance of the hotel', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Lobby Area', 'description' => 'Spacious reception and lobby', 'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Restaurant', 'description' => 'Fine dining restaurant interior', 'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Conference Hall', 'description' => 'Main conference facility', 'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Pool Area', 'description' => 'Outside swimming pool', 'image' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Garden', 'description' => 'Beautiful garden views', 'image' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=800&q=75', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
