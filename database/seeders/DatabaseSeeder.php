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
                'image' => 'rooms/single-standard.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Single Superior',
                'description' => 'An upgraded single room with a king-sized bed, private balcony, and city views. Perfect for guests who appreciate extra space and comfort.',
                'price' => 4000,
                'capacity' => 1,
                'image' => 'rooms/single-superior.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Double Standard',
                'description' => 'A spacious double room with two queen beds, ideal for friends or couples. Includes a sitting area, work desk, and garden views.',
                'price' => 4500,
                'capacity' => 2,
                'image' => 'rooms/double-standard.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Twin Standard',
                'description' => 'A versatile room with two single beds, great for colleagues or family. Features a modern bathroom, ample storage, and a peaceful atmosphere.',
                'price' => 4200,
                'capacity' => 2,
                'image' => 'rooms/twin-standard.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Executive Suite',
                'description' => 'Our premium suite with a separate living area, luxurious king bed, and executive amenities. Includes minibar, coffee machine, and panoramic city views.',
                'price' => 8500,
                'capacity' => 3,
                'image' => 'rooms/executive-suite.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'The crown jewel — two bedrooms, private dining, butler service, and a wraparound terrace. Designed for VIP guests and discerning travelers.',
                'price' => 15000,
                'capacity' => 4,
                'image' => 'rooms/presidential-suite.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Foods
        Food::insert([
            ['name' => 'Pilau ya Kuku', 'description' => 'Spiced rice cooked with chicken, served with kachumbari on the side.', 'price' => 750, 'category' => 'Main Course', 'image' => 'foods/pilau.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nyama Choma', 'description' => 'Half kilo of beef ribs grilled over charcoal with ugali and kachumbari.', 'price' => 950, 'category' => 'Grills', 'image' => 'foods/nyama-choma.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chips Masala', 'description' => 'Fried potatoes tossed in masala sauce, served hot.', 'price' => 350, 'category' => 'Snacks', 'image' => 'foods/chips-masala.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kenyan AA Coffee', 'description' => 'Single origin Kenyan AA, roasted medium and brewed to order.', 'price' => 250, 'category' => 'Beverages', 'image' => 'foods/kenyan-aa.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chai ya Tangawizi', 'description' => 'Ginger tea, brewed strong with fresh ginger and milk.', 'price' => 150, 'category' => 'Beverages', 'image' => 'foods/ginger-tea.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kuku wa Kupaka', 'description' => 'Half chicken grilled, coated in coconut and tamarind sauce.', 'price' => 1100, 'category' => 'Swahili', 'image' => 'foods/kuku-kupaka.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ugali & Sukuma', 'description' => 'White ugali with collard greens and onion.', 'price' => 350, 'category' => 'Vegetarian', 'image' => 'foods/ugali-sukuma.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mandazi & Chai', 'description' => 'Four soft mandazi with a pot of tea.', 'price' => 180, 'category' => 'Breakfast', 'image' => 'foods/mandazi.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Passion Juice', 'description' => 'Fresh passion fruit, pressed to order.', 'price' => 300, 'category' => 'Beverages', 'image' => 'foods/passion-juice.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mango Lassi', 'description' => 'Yoghurt blended with mango and a little honey.', 'price' => 350, 'category' => 'Beverages', 'image' => 'foods/mango-lassi.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Services
        Service::insert([
            ['name' => 'Conference Hall A', 'description' => 'Large conference facility seating 200 guests with projector, sound system, and air conditioning.', 'type' => 'conferencing', 'price' => 15000, 'capacity' => 200, 'image' => 'services/conference-a.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Conference Hall B', 'description' => 'Medium conference room for 50 guests, ideal for workshops and seminars.', 'type' => 'conferencing', 'price' => 8000, 'capacity' => 50, 'image' => 'services/conference-b.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wedding Package', 'description' => 'Full wedding event coordination including catering, decoration, and sound.', 'type' => 'event', 'price' => 75000, 'capacity' => 300, 'image' => 'services/wedding.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corporate Event', 'description' => 'Tailored corporate event planning for launches, dinners, and team-building.', 'type' => 'event', 'price' => 45000, 'capacity' => 150, 'image' => 'services/corporate.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Gallery
        Gallery::insert([
            ['title' => 'Hotel Exterior', 'description' => 'The main entrance of the hotel', 'image' => 'gallery/exterior.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Lobby Area', 'description' => 'Spacious reception and lobby', 'image' => 'gallery/lobby.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Restaurant', 'description' => 'Fine dining restaurant interior', 'image' => 'gallery/restaurant.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Conference Hall', 'description' => 'Main conference facility', 'image' => 'gallery/conference.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Pool Area', 'description' => 'Outside swimming pool', 'image' => 'gallery/pool.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Garden', 'description' => 'Beautiful garden views', 'image' => 'gallery/garden.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
