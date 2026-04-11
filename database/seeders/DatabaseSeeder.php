<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name'     => 'PK Admin',
            'email'    => 'admin@pkphotography.com',
            'password' => Hash::make('admin@123'),
        ]);

        // Seed categories
        $categories = [
            ['name' => 'Tea Cups',          'slug' => 'tea-cups'],
            ['name' => 'Photo Frames',      'slug' => 'photo-frames'],
            ['name' => 'Coffee Mug Frames', 'slug' => 'coffee-mug-frames'],
            ['name' => 'Gifts',             'slug' => 'gifts'],
        ];

        foreach ($categories as $cat) {
            Category::create(array_merge($cat, [
                'description' => 'Premium ' . $cat['name'] . ' from PK Photography',
                'is_active'   => true,
                'sort_order'  => 0,
            ]));
        }

        // Seed sample products
        $photoFrameCat = Category::where('slug', 'photo-frames')->first();
        $mugCat        = Category::where('slug', 'coffee-mug-frames')->first();
        $teaCat        = Category::where('slug', 'tea-cups')->first();
        $giftCat       = Category::where('slug', 'gifts')->first();

        $products = [
            [
                'category_id'        => $photoFrameCat->id,
                'name'               => 'Classic Gold Photo Frame',
                'slug'               => 'classic-gold-photo-frame',
                'short_description'  => 'Elegant gold-bordered 5x7 photo frame with custom engraving',
                'description'        => 'A beautiful classic gold photo frame perfect for wedding memories. Comes with custom engraving option.',
                'price'              => 599.00,
                'sale_price'         => 449.00,
                'main_image'         => 'placeholders/frame1.jpg',
                'allow_custom_image' => true,
                'custom_image_label' => 'Upload Your Wedding Photo',
                'is_featured'        => true,
            ],
            [
                'category_id'        => $mugCat->id,
                'name'               => 'Personalized Coffee Mug',
                'slug'               => 'personalized-coffee-mug',
                'short_description'  => 'Custom printed coffee mug with your favorite photo',
                'description'        => 'High-quality ceramic mug with your photo printed in vibrant colors. Dishwasher safe.',
                'price'              => 399.00,
                'sale_price'         => 299.00,
                'main_image'         => 'placeholders/mug1.jpg',
                'allow_custom_image' => true,
                'custom_image_label' => 'Upload Your Photo',
                'is_featured'        => true,
            ],
            [
                'category_id'        => $teaCat->id,
                'name'               => 'Couple Tea Cup Set',
                'slug'               => 'couple-tea-cup-set',
                'short_description'  => 'Beautiful couple tea cups with personalized printing',
                'description'        => 'Elegant tea cup set for couples with custom names and photos. Perfect wedding gift.',
                'price'              => 799.00,
                'sale_price'         => 599.00,
                'main_image'         => 'placeholders/teacup1.jpg',
                'allow_custom_image' => true,
                'custom_image_label' => 'Upload Couple Photo',
                'is_featured'        => true,
            ],
            [
                'category_id'        => $giftCat->id,
                'name'               => 'Wedding Memory Gift Box',
                'slug'               => 'wedding-memory-gift-box',
                'short_description'  => 'Premium gift box with customized photo products',
                'description'        => 'Complete wedding memory box including photo frame, mugs, and keepsakes.',
                'price'              => 1999.00,
                'sale_price'         => 1499.00,
                'main_image'         => 'placeholders/giftbox1.jpg',
                'allow_custom_image' => true,
                'custom_image_label' => 'Upload Your Photos',
                'is_featured'        => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'stock'     => 100,
                'is_active' => true,
            ]));
        }
    }
}