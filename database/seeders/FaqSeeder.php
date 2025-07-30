<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $faqs = [
            [
                'faq_category' => 'DNZ Scope Mount & Mounting Accessories Info',
                'question' => 'Game Reaper Promo: Be 100% confident on your next hunt and make sure you have a Game reaper holding your scope in place.',
                'answer' => null,
                'url' => '<iframe width="560" height="420" src="https://www.youtube.com/embed/5QSNHsGFU9k" title="Game Reaper Promo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'status' => '1',
            ],
            [
                'faq_category' => 'DNZ Scope Mount & Mounting Accessories Info',
                'question' => 'Game Reaper Commercial: When it comes to taking your trophy in the field, #Accuracy is a must.',
                'answer' => null,
                'url' => '<iframe width="747" height="420" src="https://www.youtube.com/embed/-uMqBCmeQf8" title="DNZ Game Reaper" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'status' => '1',
            ],
            [
                'faq_category' => 'DNZ Scope Mount & Mounting Accessories Info',
                'question' => 'Rapid Height: A tool used to measure how tall your scope mount needs to be for your rifle and scope set-up.',
                'answer' => null,
                'url' => '<iframe width="747" height="420" src="https://www.youtube.com/embed/fjnagw0If18" title="DNZ Rapid Height" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'status' => '1',
            ],
            [
                'faq_category' => 'Other DNZ Products',
                'question' => 'DNZ Nevel: Scope leveling tool used when mounting a rifle scope with DNZ scope mounts.',
                'answer' => null,
                'url' => '<iframe width="747" height="420" src="https://www.youtube.com/embed/aYtKppcvFfs" title="Nevel from DNZ Products" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'status' => '1',
            ],
            [
                'faq_category' => 'DNZ Scope Mount & Mounting Accessories Info',
                'question' => 'Brave Dave: Brave Dave explains why he loves his DNZ Scope Mounts and how he uses them.',
                'answer' => null,
                'url' => ' ',
                'status' => '0',
            ],
            [
                'faq_category' => 'DNZ Scope Mount & Mounting Accessories Info',
                'question' => "DNZ Anodize: A peek at DNZ's anodization process. Made in the USA.",
                'answer' => null,
                'url' => ' ',
                'status' => '0',
            ],
            [
                'faq_category' => 'DNZ Scope Mount & Mounting Accessories Info',
                'question' => 'DNZ Scope Mount Inspection: DNZ Scope Mount inspection on our CMM inspection machine',
                'answer' => null,
                'url' => '<iframe width="747" height="420" src="https://www.youtube.com/embed/0337atF8q2E" title="DNZ Mount inspection" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'status' => '1',
            ],
            [
                'faq_category' => 'Other DNZ Products',
                'question' => 'Lock-a-Cart: Locking device that locks the gas pedal on your golf cart.',
                'answer' => null,
                'url' => '<iframe width="747" height="420" src="https://www.youtube.com/embed/ZU8jlYnoO9U" title="Lock-A-Cart" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'status' => '1',
            ],
          
            [
                'faq_category' => 'Other DNZ Products',
                'question' => "Lock N' Fish: Mobile fishing rod holder that can be used on docks and piers.",
                'answer' => null,
                'url' => '<iframe width="747" height="420" src="https://www.youtube.com/embed/VcomtORtwdw" title="Lock N&#39; Fish from DNZ Products" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'status' => '1',
            ],
            [
                'faq_category' => 'Other DNZ Products',
                'question' => ' Reef Realer Anchor: Rock and Reef anchor designed for holding your boat in place in any situation.',
                'answer' => null,
                'url' => '<iframe width="747" height="420" src="https://www.youtube.com/embed/OgeaGW7sXLo" title="Reef Reaper Anchor" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'status' => '1',
            ],
            [
                'faq_category' => "FAQ's",
                'question' => 'What screws go into base and what screws go into rings ? ',
                'answer' => 'Short screws go thru mount and into firearm. Long screws install thru rings and into mount. All ring screws we use are 6-40 X 5/8” long.',
                'url' => '',
                'status' => '1',
            ],
            [
                'faq_category' => "FAQ's",
                'question' => 'What screws do my gun use?',
                'answer' => 'This info is listed at the product info area of the gun make.',
                'url' => '',
                'status' => '1',
            ],
            [
                'faq_category' => "FAQ's",
                'question' => 'What type of material is used?',
                'answer' => 'All of our scope mounts are machined from a solid block of billet 6061T6 Aluminum.',
                'url' => '',
                'status' => '1',
            ],
            [
                'faq_category' => "FAQ's",
                'question' => 'I tried to install the mount and all holes do not line up. Do I have wrong mount, what is going on?',
                'answer' => 'Turn mount around 180 degrees and see if all holes line up or you have wrong action length mount.',
                'url' => '',
                'status' => '1',
            ],
          
            [
                'faq_category' => "FAQ's",
                'question' => 'What height mount do I need?',
                'answer' => 'Height dimensions are listed at the product info area of the gun make. If you cannot figure out what height mount you need by checking the height dimensions in the product info area send us an e mail or give us a call. Info you need to have in e mail or before you call – Gun make and model, caliber of gun, name brand of scope, tube size of scope, tube mounting length of scope, overall length of scope, diameter of outside of front of scope (not the glass size, but outside of scope diameter).',
                'url' => '',
                'status' => '1',
            ],
            [
                'faq_category' => "FAQ's",
                'question' => 'My scope tube is short and I need to make sure it will fit between rings on the mount. How wide is rings?',
                'answer' => 'Outside to outside of ring dimensions are listed at the product info area of each gun make.',
                'url' => '',
                'status' => '1',
            ], 
            [
                'faq_category' => "FAQ's",
                'question' => 'Will your mounts hold on a magnum caliber and give me good shot groups?',
                'answer' => 'Any of our mounts will hold on any caliber firearm. Once you use our mounts you will see you are shooting the best groups you have ever shot. Our 2 screw per ring mounts will hold on any caliber.',
                'url' => '',
                'status' => '1',
            ],
            [
                'faq_category' => "FAQ's",
                'question' => 'I have a gap between my mount and the ring tops. is this correct?',
                'answer' => 'Yes, You should have about a 1/64″ to 1/32″ gap between ring tops and mount after you have finished the mounting process.',
                'url' => '',
                'status' => '1',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}