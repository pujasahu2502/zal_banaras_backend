<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dealer;

class DealerSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dealers = [
            [
                "title" => "2nd Amendment Outdoors, LLC",
                "email" => "2ndamendmentoutdoors@comcast.net",
                "phone" => "(662) 594-8687",
                "address" => "indore",
                "website_url" => "https://www.facebook.com/2NDAMENDMENTOUTDOORS/",
                "longitude" => "35.258684855975815",
                "latitude" => "-88.57777784508785"
            ],
            [
                "title" => "Amazon.com"
            ],
            [
                "title" => "Ammo Alley & Firearms",
                "email" => "ammoalley@yahoo.com",
                "phone" => "(606-519-3091)",
                "address" => "Belfry, KY 41514",
                "website_url" => "https://www.facebook.com/ammoalleyfirearms1/"
            ],
            [
                "title" => "Bink’s Lodge",
                "email" => "http://www.BinksLodge.com/",
                "phone" => "(615) 807-2945",
                "address" => "1715 Columbia Ave, Franklin, TN 37064",
                "website_url" => "https://www.facebook.com/BinksLodge/",
                "longitude" => "35.90238231303254",
                "latitude" => "-86.87224391534583"
            ],
            [
                "title" => "Black Bird"
            ],
            [
                "title" => "BlueTunaGuns.com",
                "email" => "https://www.bluetunaguns.com/",
                "phone" => "(716) 874-1150",
                "address" => "870 Ontario St. Kenmore NY, 14217",
                "website_url" => "https://www.bluetunaguns.com/",
                "longitude" => "43.238521872190624",
                "latitude" => "-78.91058736623086"
            ],
            [
                "title" => "Bryant’s Gun and Pawn",
                "email" => "https://www.bryantsgunandpawn.org/",
                "phone" => "(910) 738-4848",
                "address" => "3551 Fayetteville Rd, Lumberton, NC 28358",
                "longitude" => "34.691173126938516",
                "latitude" => "-79.00321777424205"
            ],
            [
                "title" => "Bourbon Family Center",
                "longitude" => "38.82768666107024",
                "latitude" => -"91.36907011343702"
            ],
            [
                "title" => "Bowie Investment Holdings, LLC",
                "longitude" => "31.054527728311186",
                "latitude" => "-91.08925404931081"
            ],
            [
                "title" => "Bud’s Gun Shop",
                "email" => "https://www.budsgunshop.com/",
                "phone" => "(859) 368-0371",
                "website_url" => "https://www.facebook.com/budsgunshop"
            ],
            [
                "title" => "Butler’s Jewelry",
                "email" => "j.davis@butlersjewelryandloan.com",
                "phone" => "(828) 245-9859",
                "address" => "101 E Main St, Forest City, NC 28043",
                "website_url" => "https://www.facebook.com/ButlersJewelryAndLoan",
                "longitude" => "35.40850331490168",
                "latitude" => "-81.84956965235014",
                // "Column8" => "https://butlersjewelryandloan.com/"
            ],
            [
                "title" => "Buchanan Trail Sporters",
                "email" => "https://www.buchanantrailsporters.com/",
                "phone" => "(717) 485-5996​",
                "address" => "182 Buchanan Trl, Ste 175 McConnellsburg, PA 17233",
                "website_url" => "https://www.facebook.com/buchanantrailsporters/",
                "longitude" => "40.08818663919885",
                "latitude" => "-77.99681243845191"
            ],
            [
                "title" => "Callie Kays",
                "email" => "calliekaysgeneralstore@gmail.com",
                "phone" => "(904) 845-6924",
                "address" => "553027 US-1, Hilliard, FL 32046",
                "website_url" => "https://www.facebook.com/CallieKaysGeneralStore/",
                "longitude" => "30.917764614174267",
                "latitude" => "-81.93854120470148",
                // "Column8" => "http://www.calliekays.com/"
            ],
            [
                "title" => "Carters Grocery",
                "email" => " mailto:tobi@cartersgrocery.com",
                "phone" => "(772) 464-0540 ",
                "address" => "15901 Orange Avenue ~ Fort Pierce, FL 34945",
                "website_url" => "https://www.facebook.com/carters.grocery",
                "longitude" => "27.861325405922205",
                "latitude" => "-80.51789255604452",
                // "Column8" => "cartersgrocery.com"
            ],
            [
                "title" => "Clements Firearms",
                "email" => "https://www.guntrustdepot.com/FFL-Dealers/ViewDealer?id=26849",
                "phone" => "(806) 778-9467",
                "address" => "5108 150TH, LUBBOCK, TX 79424",
                "website_url" => "https://www.facebook.com/guntrustdepot"
            ],
            [
                "title" => "Crazy Bear Trading Post",
                "email" => "https://kygetaway.com/crazy-bear-trading-post/",
                "phone" => "(270) 524-7967",
                "address" => "12825 Priceville Rd, Cub Run, KY 42729",
                "website_url" => "https://www.facebook.com/HartCounty/videos/crazy-bear-trading-post-in-cub-run-kentucky/281271790065893/",
                "longitude" => "37.31368991777615",
                "latitude" => "-86.05851499999999"
            ],
            [
                "title" => "Dance’s Sporting Goods",
                "email" => "info@dancessportinggoods.com",
                "phone" => "(804) 526-8399",
                "address" => "570 Southpark Blvd, Colonial Heights, VA 23834",
                "website_url" => "https://www.facebook.com/DancesSportingGoods",
                "longitude" => "37.33596420855507",
                "latitude" => "-77.38511473336695",
                // "Column8" => "https://dancessportinggoods.com/"
            ],
            [
                "title" => "Dante Sports",
                "email" => "info@dantesports.com",
                "phone" => "514-271-2057",
                "address" => "6851 Saint Dominique St., Montreal, Quebec H2S 3B3, Canada",
                "website_url" => "https://www.facebook.com/dantesports/",
                "longitude" => "45.53381319505592",
                "latitude" => "-73.61332445767292",
                // "Column8" => "https://www.dantesports.com/en/"
            ],
            [
                "title" => "Dave’s Performance",
                "email" => "dave122854@earthlink.net",
                "phone" => "1-910-485-6959",
                "address" => "1890 Page Road Stedman, NC 28391",
                "longitude" => "35.08180514184187",
                "latitude" => "-78.66713893854129"
            ],
            [
                "title" => "Defender Outdoors – Argyle"
            ],
            [
                "title" => "Defender Outdoors Shooting Center",
                "email" => "info@defenderoutdoors.com",
                "phone" => "1-917-935-8377",
                // "Column8" => "https://defenderoutdoors.com/"
            ],
            [
                "title" => "Delta Parts & Supply"
            ],
            [
                "title" => "Dickson Gun Works",
                "email" => "info@dicksongunworks.com",
                "phone" => "(615) 326-7110",
                "address" => "701 Henslee Dr, Dickson, TN 37055",
                "website_url" => "https://www.facebook.com/dicksongunworks/",
                "longitude" => "36.49490485987166",
                "latitude" => "-87.39165218193776",
                // "Column8" => "https://dicksongunworks.com/"
            ],
            [
                "title" => "Downs Bait & Tackle",
                "address" => "Dickson, TN 37055"
            ],
            [
                "title" => "Dutchman Hunting Supplies",
                "email" => "dutchmanhunting@gmail.com",
                "phone" => "(260) 768-3283",
                "address" => " 8435 US-20, Shipshewana, IN 46565",
                "website_url" => "https://www.facebook.com/qadqualityarcherydesigns/"
            ],
            [
                "title" => "Ed’s Gun Shop",
                "email" => "sales@edsgunshop.com",
                "phone" => "(910) 692-7936",
                "address" => "5560 US 1 Hwy, Vass, NC, United States, North Carolina",
                "website_url" => "https://www.facebook.com/EdsGunShopNC/",
                "longitude" => "35.214974287087855",
                "latitude" => "-79.32929629814481",
                // "Column8" => "https://edsgunshop.com/"
            ],
            [
                "title" => "Dutchman Hunting Supplies"
            ],
            [
                "title" => "Dutchman Hunting Supplies",
                "longitude" => "41.65970403692963",
                "latitude" => "-85.58846424998075"
            ],
            [
                "title" => "Freedom Family Firearms",
                "email" => "kevin@freedomfamilyfirearms.com",
                "phone" => "(252) 544-4490",
                "address" => "6445 MAIN STREET BAILEY NC 27807",
                "longitude" => "35.83080016624977",
                "latitude" => "-78.11770984503714"
            ],
            [
                "title" => "Ferg’s Firearms",
                "longitude" => "43.7704864441502",
                "latitude" => "-91.27691786537815"
            ],
            [
                "title" => "FHS Firearms",
                "email" => "223guns@gmail.com",
                "phone" => "(920) 324-4751",
                "address" => "1100 W. Main St. Waupun, WI 53963",
                "longitude" => "43.63417594540749",
                "latitude" => "-88.76068412883647"
            ],
            [
                "title" => "Fuquay Gun & Gold",
                "email" => "https://www.fuquaygun.com/",
                "phone" => "919-552-4945",
                "address" => "1602 N Main St, Fuquay-Varina, NC 27526",
                "longitude" => "35.59657206215359",
                "latitude" => "-78.76311976138332"
            ],
            [
                "title" => "Gemmer & Clemmons Sports Inc."
            ],
            [
                "title" => "Green Mountain Sporting Goods",
                "email" => "gmsg.irasburg@gmail.com",
                "phone" => "802-754-2475",
                "address" => "3227 US ROUTE 5, IRASBURG, VERMONT 05845",
                "website_url" => "https://www.facebook.com/gmsgvt",
                "longitude" => "45.160149310179186",
                "latitude" => "-72.32554213863801",
                // "Column8" => "https://gmsgvt.com/"
            ],
            [
                "title" => "Green Top Sporting Goods Corp.",
                "email" => "info@greentophuntfish.com",
                "phone" => "(804) 550-2188",
                "address" => "10150 Lakeridge Pkwy, Ashland, VA 23005",
                "website_url" => "https://www.facebook.com/GreenTopSportingGoods/",
                "longitude" => "37.792078977230325",
                "latitude" => "-77.43974070264014",
                // "Column8" => "https://www.greentophuntfish.com/"
            ],
            [
                "title" => "GTO Guns",
                "email" => "sales@gtoguns.com",
                "phone" => "352-401-9070",
                "address" => "4600 FL-326, Ocala, FL 34482",
                "website_url" => "https://www.facebook.com/Goodtimeoutdoorsinc?rf=116190438442471",
                "longitude" => "29.46721165139848",
                "latitude" => "-82.21602343723278",
                // "Column8" => "https://goodtimeoutdoors.com/"
            ],
            [
                "title" => "Guncommanders.com",
                "phone" => "(706) 865-4861",
                "address" => "5290 US-129, Cleveland, GA 30528",
                "longitude" => "34.52196187335567",
                "latitude" => "-83.75545538678948"
            ],
            [
                "title" => "H&S Hunting",
                "email" => "Howard@handshunting.com",
                "phone" => "(423) 542-3477",
                "address" => "430 E E St, Elizabethton, TN, United States, Tennessee",
                "website_url" => "https://www.facebook.com/people/HS-Hunting-and-Fishing/100057636062042/",
                "longitude" => "36.53639531444341",
                "latitude" => "-82.2211334505024",
                // "Column8" => "handshuntingandfishing.com"
            ],
            [
                "title" => "Hales True Value Hardware",
                "email" => "halestruevalue.getdish.com",
                "phone" => " (269) 782-3426",
                "address" => "56216 M-51 S, Dowagiac, MI 49047",
                "website_url" => "https://www.facebook.com/HalestruevalueRadioshack/",
                "longitude" => "42.37319654146394",
                "latitude" => "-86.12514729497474",
                // "Column8" => "rhale925@yahoo.com"
            ],
            [
                "title" => "Harrison Supply Inc.",
                "email" => "sales@harrisonsupplyandmarket.com",
                "phone" => "830-665-5977",
                "address" => "1304 State Highway 173 N Devine, TX 78016",
                "website_url" => "https://www.facebook.com/harrisonsupplyandmarket",
                // "Column8" => "https://www.harrisonsupplyandmarket.com/"
            ],
            [
                "title" => "Hilltop Hunting & Fishing Supply",
                "email" => "WEB SAYS CLOSE",
                "phone" => "(315) 386-4875",
                "address" => "374 Pollock Rd, Canton, NY 13617",
                "longitude" => "44.682713796852745",
                "latitude" => "-75.16758279106647"
            ],
            [
                "title" => "Hunters Haven",
                "phone" => "(662) 841-0422",
                "address" => "3902 Westgate Drive Tupelo, MS 38801",
                "website_url" => "https://www.facebook.com/huntershaventupelo/",
                "longitude" => "34.59575194989869",
                "latitude" => "-88.78381998266029",
                // "Column8" => "https://www.huntershaven.biz/"
            ],
            [
                "title" => "LuckyDogFirearms.com",
                "email" => "luckydogfirearms@gmail.com",
                "phone" => "(919) 343-3486",
                "address" => "57 Cresthaven Dr, Sanford, NC 27332",
                "longitude" => "35.323075391298694",
                "latitude" => "-79.04416944670152",
                // "Column8" => "https://www.luckydogfirearms.com/product/magpul-pmag-m3-556-window-30rd-blk"
            ],
            [
                "title" => "Martens Reedsburg True Value",
                "phone" => "(608) 524-8999",
                "address" => " 100 Viking Dr, Reedsburg, WI 53959",
                "website_url" => "https://www.reedsburgtruevaluehardwarestore.com/",
                "longitude" => "44.260104276737565",
                "latitude" => "-89.81028616109033"
            ],
            [
                "title" => "McKnight Hardware",
                "phone" => "(336) 273-1943",
                "address" => "1709 E Bessemer Ave Greensboro NC 27405",
                "longitude" => "36.08523251971729",
                "latitude" => "-79.76282917790887",
                // "Column8" => "https://www.mcknighthardware.com/"
            ],
            [
                "title" => "MidwayUSA.com",
                // "Column8" => "https://www.midwayusa.com/Features/Error/Error?aspxerrorpath=/find"
            ],
            [
                "title" => "NatchezShooterSupply.com"
            ],
            [
                "title" => "Nexgen Outfitters",
                "email" => "support@nexgenof.com",
                "phone" => "1-833-694-3663",
                "address" => "100 commerce Court Sidney NE 69162",
                "longitude" => "41.140700050709825",
                "latitude" => "-102.9430847",
                // "Column8" => "https://nexgenof.com/"
            ],
            [
                "title" => "Ocean’s East",
                "website_url" => "https://www.facebook.com/OceansEast/",
                // "Column8" => "https://fishoceanseast.com/"
            ],
            [
                "title" => "OpticsPlanet.com",
                "email" => "sales@opticsplanet.com",
                "phone" => "(800) 504-5897",
                "website_url" => "https://www.facebook.com/opticsplanet",
                // "Column8" => "https://www.opticsplanet.com/dednutz-brand.html"
            ],
            [
                "title" => "Piney Pawn & Firearms",
                "phone" => "(423) 391-0072",
                "address" => "5600 Hwy 11 E B, Piney Flats, TN 37686",
                "website_url" => "https://www.facebook.com/lyon.pawn",
                "longitude" => "36.43649383484873",
                "latitude" => "-82.30670211534583",
                // "Column8" => "https://pineypawn.com/contact/"
            ],
            [
                "title" => "Putnam Feed & Farm Supply Inc.",
                "email" => "johnallen29@hotmail.com",
                "phone" => "(386) 328-1134",
                "address" => "156 FL-20, Palatka, FL 32177",
                "website_url" => "https://www.facebook.com/PutnamFeedandFarmSupply/timeline",
                "longitude" => "29.855906494438138",
                "latitude" => "-81.71707017055648",
                // "Column8" => "https://www.putnamfeed.com/"
            ],
            [
                "title" => "Quality Guns & Ammo",
                "email" => "quality.guns@yahoo.com",
                "phone" => "(256) 538-1308",
                "address" => "102 5th Ave NE Attalla, AL 35954",
                "website_url" => "https://www.facebook.com/QualityGun/",
                "longitude" => "34.455300504973316",
                "latitude" => "-85.99346375602441",
                // "Column8" => "http://www.QualityGuns.net/"
            ],
            [
                "title" => "Rocky Mountain Supply Inc.",
                "longitude" => "45.77695419823132",
                "latitude" => "-111.18125155396254",
                // "Column8" => "https://www.rmsi.coop/"
            ],
            [
                "title" => "Rogers Outdoors"
            ],
            [
                "title" => "The Optic Zone",
                "email" => "INFO@THEOPTICZONE.COM",
                "phone" => "1-877-564-0286",
                "address" => "1635 E. HOAGUE ROAD FREE SOIL MI 49411",
                "longitude" => "44.45600271855822",
                "latitude" => "-86.28963832072509",
                // "Column8" => "https://theopticzone.com/"
            ],
            [
                "title" => "Rangeview Sports",
                "email" => "service@rangeviewsports.ca",
                "phone" => "905-868-6666",
                "address" => "1111 Davis Dr. Unit # 28B, Newmarket, ON, L3Y 8X2 Canada",
                "website_url" => "https://www.facebook.com/RangeviewSports/",
                "longitude" => "44.08711942202494",
                "latitude" => "-79.4303777",
                // "Column8" => "https://www.rangeviewsports.ca/contact-us/"
            ],
            [
                "title" => "Reynolds Outdoors",
                "email" => "reynoldsoutdoorsffl@gmail.com",
                "phone" => "334-745-7642",
                "address" => "904 Geneva St, Opelika, AL 36801",
                "website_url" => "https://www.facebook.com/ReynoldsOutdoors1/",
                "longitude" => "32.964456435442",
                "latitude" => "-85.50328372284875",
                // "Column8" => "https://www.reynoldsoutdoors.net/contact-us/"
            ],
            [
                "title" => "Robinette’s Gun and Archery",
                "phone" => "(606) 631-4867",
                "address" => "6282 Zebulon Hwy, Pikeville, KY 41501",
                "website_url" => "https://www.facebook.com/RobinetteLLC/",
                "longitude" => "37.693206466395246",
                "latitude" => "-82.56500226697337"
            ],
            [
                "title" => "S&B Shooting Sports LLC",
                "phone" => "(252) 442-0712",
                "address" => " 1009 West Mount Drive, Rocky Mount, NC 27803",
                "longitude" => "35.98187430041426",
                "latitude" => "-77.83937996967471"
            ],
            [
                "title" => "Silver Dollar Gun & Pawn",
                "email" => "silverdollarram@gmail.com",
                "phone" => "(336) 824-8989",
                "address" => "6787 JORDAN RD US HWY 64 E RAMSEUR NC 27316",
                "website_url" => "https://www.facebook.com/silverdollargunandpawn",
                "longitude" => "35.76425822822704",
                "latitude" => "-79.66400567330535",
                // "Column8" => "https://www.silverdollargunandpawn.com/"
            ],
            [
                "title" => "Smokey Mountain Guns and Ammo",
                "email" => "orders@smga.com",
                "phone" => "865-444-3877",
                "address" => "6221 RIVERVIEW CROSSING KNOXVILLE TN 39924",
                "longitude" => "36.21818155488626",
                "latitude" => "-83.83107661698894",
                // "Column8" => "https://www.smga.com/"
            ],
            [
                "title" => "Southern Oaks Gun and Pawn",
                "email" => "Pawnit2me@aol.com",
                "phone" => "407-851-6731",
                "address" => "3434 Orange Avenue, Orlando, FL 32806",
                "longitude" => "28.50651777203169",
                "latitude" => "-81.37635210792503",
                // "Column8" => "https://southernoaksgunandpawn.com/contact-us/"
            ],
            [
                "title" => "Spud & Deb’s Dog Hunting Supply",
                "email" => "oldeb@citcom.net",
                "phone" => "(828) 862-8725",
                "address" => "677 Capps Rd Pisgah Forest, NC 28768",
                "website_url" => "https://www.facebook.com/spudanddebspf",
                "longitude" => "35.48176714399912",
                "latitude" => "-82.6981037331178",
                // "Column8" => "https://spudanddebs.com/"
            ],
            [
                "title" => "St. Landry Lumber Company",
                "email" => "contact@stlandrylumberco.com",
                "phone" => "(337) 942-2227",
                "address" => "207 North Railroad Avenue, Opelousas, LA 70570",
                "website_url" => "https://www.facebook.com/stlandrylumber/",
                "longitude" => "31.280140805978775",
                "latitude" => "-92.19169959709244",
                // "Column8" => "http://www.stlandrylumberco.com/"
            ],
            [
                "title" => "Stateline Gun Exchange"
            ],
            [
                "title" => "SWFA.com",
                "email" => "swfa@swfa.com",
                "phone" => "972-726-7348",
                "address" => "5840 E US HWY287 MIDLOTHIAN TX 76065",
                "website_url" => "https://www.facebook.com/swfacom",
                "longitude" => "33.16415161568921",
                "latitude" => "-96.89283824319128",
                // "Column8" => "https://www.swfa.com/Search.aspx"
            ],
            [
                "title" => "Teal Bottom Arms",
                "phone" => "573-690-0814",
                "address" => "4806 S Teal Bottom Rd, Henley, MO 65040",
                "longitude" => "38.3425837",
                "latitude" => "-92.2997758",
                // "Column8" => "https://411gun.com/listings/teal-bottom-arms-henley-mo/"
            ],
            [
                "title" => "The Fort",
                "email" => "guns@fortmt.com",
                "phone" => "406-932-5992",
                "address" => "228 Big Timber Loop Rd Big Timber MT 59011",
                "website_url" => "https://www.facebook.com/TheFortMT/",
                "longitude" => "47.11642354712965",
                "latitude" => "-110.35939233310815",
                // "Column8" => "http://www.fortmt.com/index.html"
            ],
            [
                "title" => "The Rivertown Depot",
                "longitude" => "33.938745978638835",
                "latitude" => "-79.04517385349536"
            ],
            [
                "title" => "Tombstone Tactical",
                "email" => "sales@tombstonetactical.com",
                "phone" => "(800) 606-0370",
                "address" => "Arizona",
                "website_url" => "https://www.facebook.com/TombstoneTactical/",
                "longitude" => "35.10057700884039",
                "latitude" => "-112.05553403698637",
                // "Column8" => "https://tombstonetactical.com/catalog/dnz-products/"
            ],
            [
                "title" => "Tyler Brothers",
                "email" => "sales@tylerbrothers.net",
                "phone" => "(803) 564-3174",
                "address" => "116 Railroad Ave E Wagener, SC 29164",
                "website_url" => "https://www.facebook.com/TylerBros",
                "longitude" => "33.65745390657217",
                "latitude" => "-81.3606003236512",
                // "Column8" => "tylerbrothers.net"
            ],
            [
                "title" => "Valley Tire & Tackle",
                "email" => "valleytireandtackle@sisqtel.net",
                "phone" => "(530) 468-2432",
                "address" => "11211 N State Highway 3, Fort Jones, CA, 96032",
                "website_url" => "https://www.facebook.com/ValleyTireTackleInc/",
                "longitude" => "41.59985351392592",
                "latitude" => "-122.8487004539625"
            ],
            [
                "title" => "Van’s Deer Processing",
                "email" => "customerservice@vansoutdoors.com",
                "phone" => "601-825-9087",
                "address" => "777 Hwy 468 Brandon MS 39042",
                "website_url" => "https://www.facebook.com/VansDeerProcessingandSportingGoods",
                "longitude" => "32.63873272477328",
                "latitude" => "-90.03294613897367",
                // "Column8" => "https://www.vansoutdoors.com/"
            ],
            [
                "title" => "W&W Novelty Company",
                "email" => "wwnovelty@aol.com",
                "phone" => "434-385-5323 or 434-385-5322",
                "address" => "2323 Lakeside DR. Lynchburg VA 24501",
                "website_url" => "https://www.facebook.com/wwnovelty/",
                "longitude" => "37.50078452734859",
                "latitude" => "-79.24079223238647",
                // "Column8" => "https://www.wwnovelty.net/"
            ],
            [
                "title" => "WholesaleHunter.com",
                "email" => "Support@WholesaleHunter.com",
                "phone" => "888-900-HUNT (4868)",
                "address" => "34 Firetower Road Wetumpka, AL 36093",
                "website_url" => "https://www.facebook.com/wholesalehunter/",
                "longitude" => "32.55642803913538",
                "latitude" => "-86.15296474603748",
                // "Column8" => "https://www.wholesalehunter.com/"
            ],
            [
                "title" => "Widgey’s Outdoors LLC",
                "email" => "struensee@tds.net",
                "phone" => "(715) 937-6473",
                "address" => "N1020 Borglin Ave Neillsville, WI 54456",
                "website_url" => "https://www.facebook.com/people/Widgys-Outdoors/100028127456630/",
                "longitude" => "45.138923056282344",
                "latitude" => "-90.71735006357035"
            ],
            [
                "title" => "Wilborn Outdoors",
                "email" => "dwilborn@hiwaay.net",
                "phone" => "256-737-9595",
                "address" => "505 Main Ave NW Cullman AL 35055",
                "longitude" => "34.180932901125956",
                "latitude" => "-86.84807416930835",
                // "Column8" => "https://www.wilbornguns.com/"
            ],
            [
                "title" => "Wilcox Bait & Tackle",
                "email" => "nfo@wilcoxbaitandtackle.com",
                "phone" => "(757) 595-5537",
                "address" => "9501 Jefferson Ave Newport News, VA 23605\n ",
                "website_url" => "https://www.facebook.com/WilcoxBaitandTackle",
                "longitude" => "37.027772519461756",
                "latitude" => "-76.45007125767292",
                // "Column8" => "https://www.wilcoxbaitandtackle.com/"
            ],
            [
                "title" => "Wild West Guns and Gold",
                "phone" => "904-693-0777",
                "address" => "1233 S.Lane Ave. Jacksonville FL 32205",
                "longitude" => "30.467234182044432",
                "latitude" => "-81.74008923216219",
                // "Column8" => "http://www.wildwestgunsandgold.com/"
            ],
            [
                "title" => "William’s Gun & Pawn",
                "phone" => "(850) 271-2130",
                "address" => "1008 Ohio Ave, Lynn Haven, FL 32444",
                "longitude" => "30.243301751560313",
                "latitude" => "-85.64901981349063",
                // "Column8" => "https://williams-gun-pawn.edan.io/"
            ],
            [
                "title" => "Woody’s Pawn & Jewelry",
                "phone" => "(803) 536-1711",
                "address" => "898 Russell St Orangeburg, SC 29115",
                "website_url" => "https://www.facebook.com/woodyspawnshop/",
                "longitude" => "33.559812989361504",
                "latitude" => "-80.88639893556046"
            ],
            [
                "title" => "Yard Master Inc.",
                "phone" => "478-237-5444",
                "address" => "633 E Main St, Swainsboro, GA 30401",
                "website_url" => "https://www.facebook.com/The-Yard-Master-103577363025546/",
                "longitude" => "32.60370556531085",
                "latitude" => "-82.31443237301875",
                // "Column8" => "http://www.theyardmaster.com/"
            ],
            [
                "title" => "Bullets & Bows, Inc.",
                "phone" => "337-334-0033",
                "address" => "110 W Louisiana Ave.Rayne, LA 70578-5912",
                "website_url" => "https://www.bulletsandbows.com/",
                "longitude" => "30.2361079",
                "latitude" => "-92.2692520"
            ],
        ];
        foreach ($dealers as $dealer) {
            $dealerData = Dealer::Create([
                "title" => $dealer['title'],
                "phone" => $dealer['phone'] ?? null,
                "website_url" => $dealer["website_url"] ?? null,
                "status" => isset($dealer['address'])  ? '1'  : '0',

            ]);
            $dealerData->address()->create([
                "address" => $dealer['address'] ?? null,
                "longitude" => $dealer['latitude'] ?? null,
                "latitude" => $dealer['longitude'] ?? null
            ]);
        };
    }
}
