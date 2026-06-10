<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Database\Seeder;

class AdminDataSeeder extends Seeder
{
    public function run(): void
    {
        Setting::query()->firstOrCreate([], [
            'title' => 'E-SHOP — Curated Fashion & Lifestyle',
            'keywords' => 'ecommerce, fashion, shop, online store',
            'description' => 'Premium online shopping experience',
            'company' => 'E-SHOP Ltd.',
            'address' => 'Istanbul, Turkey',
            'phone' => '+90 212 000 00 00',
            'email' => 'info@e-shop.com',
            'aboutus' => '<p>E-SHOP, zamansız parçalar ve özenle seçilmiş koleksiyonlar sunar. Kalite ve müşteri memnuniyeti önceliğimizdir.</p>',
            'contact' => '<p>Merkez ofisimiz İstanbul\'dadır. Hafta içi 09:00–18:00 arasında bize ulaşabilirsiniz.</p>',
            'references' => '<p>Referanslarımız ve iş ortaklarımız hakkında bilgi için bizimle iletişime geçin.</p>',
            'status' => 'active',
        ]);

        $socials = [
            ['title' => 'Facebook', 'url' => 'https://facebook.com', 'image' => 'logo-facebook', 'status' => 'active'],
            ['title' => 'Instagram', 'url' => 'https://instagram.com', 'image' => 'logo-instagram', 'status' => 'active'],
            ['title' => 'Twitter', 'url' => 'https://twitter.com', 'image' => 'logo-twitter', 'status' => 'active'],
        ];

        foreach ($socials as $social) {
            Social::firstOrCreate(['title' => $social['title']], $social);
        }

        $faqs = [
            ['question' => 'How long does shipping take?', 'answer' => 'Standard delivery is 3–5 business days. Express options are available at checkout.', 'status' => 'active'],
            ['question' => 'What is your return policy?', 'answer' => 'You may return unworn items within 30 days of delivery for a full refund.', 'status' => 'active'],
            ['question' => 'Do you ship internationally?', 'answer' => 'Yes, we ship to most countries worldwide. Shipping costs vary by destination.', 'status' => 'active'],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], $faq);
        }

        Message::firstOrCreate(
            ['email' => 'customer@mail.com', 'subject' => 'Order inquiry'],
            [
                'name' => 'Ayşe Yılmaz',
                'phone' => '+90 532 000 00 00',
                'message' => 'Hello, I would like to know the status of my recent order.',
                'status' => 'new',
            ]
        );
    }
}
