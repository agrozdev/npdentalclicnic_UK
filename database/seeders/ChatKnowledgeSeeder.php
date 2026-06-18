<?php

namespace Database\Seeders;

use App\Models\ChatKnowledge;
use Illuminate\Database\Seeder;

class ChatKnowledgeSeeder extends Seeder
{
    public function run(): void
    {
        $entries = [
            // ── FAQs ──────────────────────────────────────────────────────
            [
                'type'     => 'faq',
                'title'    => 'Where is NP Dental Clinic located?',
                'keywords' => 'location, address, where, find us, directions, академик, йордан, трифонов, адрес, намерете ни, Sofia, entrance, ground floor',
                'content'  => 'NP Dental Clinic is located at Akademik Yordan Trifonov 6A, entrance B, ground floor, Sofia, Bulgaria (opposite My Pilates Reformer). Contact us for directions or to book your appointment.',
                'priority' => 10,
            ],
            [
                'type'     => 'faq',
                'title'    => 'What are your opening hours?',
                'keywords' => 'hours, open, opening, times, schedule, working hours, работно, часове, работно време, weekend, sunday',
                'content'  => 'We are open every day Monday to Sunday from 8:00 to 20:00. No days off — you can visit us 7 days a week. Contact us on WhatsApp to confirm your preferred time slot.',
                'priority' => 9,
            ],
            [
                'type'     => 'faq',
                'title'    => 'Do you accept NHS patients?',
                'keywords' => 'NHS, national health service, insurance, free, NHS patient',
                'content'  => 'NP Dental Clinic is a private dental clinic. We do not currently accept NHS patients. We offer competitive private pricing and flexible payment options.',
                'priority' => 8,
            ],
            [
                'type'     => 'faq',
                'title'    => 'How do I book an appointment?',
                'keywords' => 'book, appointment, schedule, reserve, запис, час, резервация',
                'content'  => 'You can book an appointment by contacting us on WhatsApp, calling our clinic directly, or using the contact form on our website. We typically respond within a few hours.',
                'priority' => 10,
            ],
            [
                'type'     => 'faq',
                'title'    => 'Do you offer emergency dental appointments?',
                'keywords' => 'emergency, urgent, pain, toothache, broken, спешно, зъбобол, болка',
                'content'  => 'Yes, we prioritise emergency dental cases. If you are in pain or have an urgent dental issue, please contact us on WhatsApp immediately and we will do our best to see you the same day.',
                'priority' => 10,
            ],
            [
                'type'     => 'faq',
                'title'    => 'Contact details — phone, email, hours',
                'keywords' => 'phone, email, contact, call, telephone, hours, open, number, обадете, телефон, работно',
                'content'  => 'You can reach NP Dental Clinic through the following channels:
Phone / WhatsApp: +359 887 570020
Email: info@npdentalclinic.com
Address: Akademik Yordan Trifonov 6A, entrance B, ground floor, Sofia, Bulgaria
Working hours: Monday to Sunday, 08:00 to 20:00 (7 days a week).',
                'priority' => 10,
            ],
            [
                'type'     => 'faq',
                'title'    => 'About NP Dental Clinic and our team',
                'keywords' => 'about, team, doctor, dentist, experience, qualifications, specialist, dr, кичукова, атип, хирург, екип, лекар, oral surgery, surgeon, manager, clinic manager, николай, karaGanev, Nikolay',
                'content'  => 'NP Dental Clinic is a modern private dental practice in Sofia, Bulgaria. Our team includes:

Dr. Pavlina Kichukova — Lead dentist with over 15 years of experience, known for her professionalism, personalised care, and attention to detail.
Dr. Ali Atip — Oral surgery specialist, responsible for implant placements, extractions, and all surgical procedures.
Nikolay Karaganev — Clinic Manager. You can reach Nikolay directly on +359 878 106603.

Our team covers all dental disciplines using the latest technology and modern treatment methods. We are open 7 days a week from 8:00 to 20:00.

The clinic welcomes patients of all ages and also accepts Bulgarian National Health Insurance (NZOK) for local patients.',
                'priority' => 7,
            ],

            // ── Services ─────────────────────────────────────────────────
            [
                'type'     => 'service',
                'title'    => 'Dental Implants',
                'keywords' => 'implant, implants, missing tooth, missing teeth, permanent, swiss, зъбен имплант, импланти, швейцарски, warranty, guarantee, lifetime, гаранция, доживотна',
                'content'  => 'We use Swiss dental implants — the highest quality available. The implant includes the crown at no extra cost. Treatment is structured across 3 visits on 3 consecutive days:
Visit 1: Implant placement
Visit 2: Crown impression (taking the measurement for the crown)
Visit 3: Crown placement
Alternatively, all stages can be completed in 2 visits with a 6-day stay in Sofia.
Price: £1,400 - £1,800 per implant (crown included).
Hotel and airport transfer are included for international patients — you only pay for your flights. Success rates exceed 95%.
Warranty: Our Swiss dental implants come with a lifetime guarantee. If the implant fails for any structural reason, we will replace it at no cost to you.',
                'priority' => 9,
            ],
            [
                'type'     => 'service',
                'title'    => 'Dental Veneers',
                'keywords' => 'veneer, veneers, porcelain, zirconia, cosmetic, smile, фасети, фасета, козметика, циркон',
                'content'  => 'We offer zirconia veneers and crowns — the most durable and natural-looking option available. Zirconia veneer or crown: £450 - £500 per tooth. Metal-ceramic crown: £300.
Treatment is completed across 3 visits on 3 consecutive days. Hotel and airport transfer included for international patients. Veneers last 15+ years with proper care.',
                'priority' => 8,
            ],
            [
                'type'     => 'service',
                'title'    => 'Teeth Whitening',
                'keywords' => 'whitening, bleaching, white teeth, bright, избелване, бели зъби, офис, домашно',
                'content'  => 'We offer two professional whitening options:
In-clinic (office) whitening: £360 - £500. Completed in the chair, results visible immediately, 4-8 shades lighter.
Home whitening kit: £250. Custom trays with professional-grade gel for whitening at your own pace.
Treatment fits within the 3-visit 3-day package. Hotel and airport transfer included for international patients.',
                'priority' => 7,
            ],
            [
                'type'     => 'service',
                'title'    => 'General Dentistry',
                'keywords' => 'check-up, checkup, filling, fillings, cleaning, extraction, scale, polish, root canal, преглед, пломба, почистване, канал',
                'content'  => 'Our general dentistry services and prices (in GBP):
Examination: £40 | Emergency examination: £90
Filling: £110 - £160 | Front tooth bonding: £250
Root canal (single root): £350 - £450 | Multi-root: £500 - £850
Scale and polish: £110 - £140 | Air polishing: £70 - £180
Tooth extraction (single root): £130 | Molar: £180 | Wisdom tooth: £300 - £850
Sealant: £60 | Laser canal treatment: £120
Examinations are scheduled to fit your travel days. Hotel and airport transfer included for international patients.',
                'priority' => 6,
            ],
            [
                'type'     => 'service',
                'title'    => 'Clear Aligners and Orthodontics',
                'keywords' => 'braces, invisalign, aligners, straighten, alignment, crooked, orthodontic, myobrace, скоби, алайнери, изправяне, ортодонтия',
                'content'  => 'We offer clear aligners (similar to Invisalign) and Myobrace trainers for both adults and children.
Clear aligners: £4,000 - £7,000 depending on complexity. Virtually invisible, removable, comfortable.
Myobrace trainer (adults): £650 | Myobrace trainer (children): £550.
Orthodontic consultation: £120.
Treatment timelines vary — initial assessment and fitting are completed during your visit to Sofia.',
                'priority' => 7,
            ],
            [
                'type'     => 'service',
                'title'    => 'Laser dentistry',
                'keywords' => 'laser, laser dentistry, painless, gum, лазер, лазерна, венци, безболезнено',
                'content'  => 'We offer laser dentistry for gum treatment and precise dental procedures. Laser treatment is minimally invasive, virtually painless, and allows faster healing compared to traditional methods. Laser root canal treatment is available at £120 per canal.',
                'priority' => 6,
            ],
            [
                'type'     => 'service',
                'title'    => 'Pediatric dentistry',
                'keywords' => 'child, children, kids, pediatric, baby teeth, milk teeth, детска, деца, млечни зъби',
                'content'  => 'We provide gentle dental care for children of all ages. Our team specialises in making children comfortable and building good oral hygiene habits from an early age. Services include check-ups, milk tooth fillings (£130-£180), milk tooth extraction (£70), sealants (£60), and Myobrace orthodontic trainers for children (£550). We also offer pediatric orthodontics.',
                'priority' => 5,
            ],
            [
                'type'     => 'service',
                'title'    => 'Prosthetics — crowns, bridges and dentures',
                'keywords' => 'crown, crowns, bridge, denture, prosthetic, proteza, коронка, мост, протеза, протетика',
                'content'  => 'Our prosthetic services and prices (in GBP):
Zirconia crown or veneer: £450 - £500
Metal-ceramic crown: £300
Temporary plastic crown: £100
Removing old crown: £50
Standard denture: £500
Silicone flexible denture: £750
Partial silicone denture (up to 3 teeth): £450
Inlay: £260 | Onlay: £280 | Overlay: £380 | Pinlay: £180
All work is completed during your 3-day visit. Hotel and airport transfer included.',
                'priority' => 8,
            ],
            [
                'type'     => 'service',
                'title'    => 'Travel package — hotel and airport transfer included',
                'keywords' => 'travel, trip, visit, hotel, transfer, airport, international, flights, abroad, package, itinerary, how many times, visits, trips',
                'content'  => 'NP Dental Clinic offers a full travel package for international patients.

For implant treatments, patients typically need to make 2-3 separate trips to Bulgaria:
- First trip: implant placement (the implant is placed in the jaw and needs time to heal and integrate with the bone — this usually takes 3 to 4 months)
- Second trip: measurements for the crown are taken once the implant has fully integrated
- Third trip: the final crown is fitted and the treatment is complete

For other procedures such as veneers, crowns, whitening or orthodontics, all steps can often be completed within one trip, structured over consecutive days.

On every trip the clinic provides:
- Hotel accommodation fully covered
- Complimentary airport-to-hotel transfer
- Appointments scheduled around your flight arrival and departure times

You only need to book and pay for your own plane tickets — we handle the rest. Contact us on WhatsApp with your travel dates and we will plan the full itinerary for you.',
                'priority' => 10,
            ],

            // ── Pricing ──────────────────────────────────────────────────
            [
                'type'     => 'pricing',
                'title'    => 'Pricing overview',
                'keywords' => 'price, prices, cost, how much, fee, rates, цена, цени, колко, тарифа, pricing list',
                'content'  => 'All prices are in GBP. Hotel and airport transfer are included for international patients — you only pay for flights.

EXAMINATIONS & CONSULTATIONS
Standard examination: £40
Emergency examination: £90
Exam + consultation + scan reading (oral surgeon): £150
Orthodontic examination: £120

IMPLANTOLOGY
Swiss implants (crown included): £1,400 - £1,800

PROSTHETICS (CROWNS & DENTURES)
Zirconia crown or veneer: £450 - £500
Metal-ceramic crown: £300
Temporary plastic crown: £100
Crown removal: £50
Standard denture: £500
Silicone flexible denture: £750
Partial silicone denture (up to 3 teeth): £450
Inlay/Onlay/Overlay/Pinlay: £180 - £380

CONSERVATIVE DENTISTRY
Filling: £110 - £160
Front tooth bonding: £250
Baby tooth filling: £130 - £180
Anesthesia: £30
Root canal single-root (pulpitis): £350 - £450
Root canal multi-root (pulpitis): £500 - £850
Per canal treatment: £250
Calcium hydroxide (CA-OH2) application: £30
Icon therapy (early decay): £160
Laser root canal processing: £120

ORAL SURGERY
Single-root extraction: £130
Molar extraction: £180
Wisdom tooth extraction: £300 - £850
Baby tooth extraction: £70

PREVENTION & WHITENING
Scale and polish (tartar removal): £110 - £140
Air polishing (soda): £70
Aqua Care polishing: £180
Professional oral hygiene: £60
Sealant: £60
Home whitening kit: £250
In-clinic (office) whitening: £360 - £500

ORTHODONTICS
Clear aligners: £4,000 - £7,000
Myobrace trainer (adults): £650 per phase
Myobrace trainer (children): £550 per phase

OTHER
Bruxism (night guard) splint: £180
Tooth splinting: £300
Segmental X-ray: £25
X-ray + reading (consultation): £70

For a personalised quote contact us on WhatsApp.',
                'priority' => 10,
            ],
            [
                'type'     => 'pricing',
                'title'    => 'Full dental price list — all services in GBP',
                'keywords' => 'full price list, all prices, complete prices, pricelist, tariff, scale, examine, extraction, root canal, filling, implant, crown, veneer, denture, whitening, aligner, splint, sealant, x-ray, xray, canal, pulpitis, icon, aqua, tartar, calcium, bruxism, splinting, myobrace, пълна ценова листа, всички цени',
                'content'  => 'Complete NP Dental Clinic price list — all prices in GBP.

Examinations: Standard £40 | Emergency £90 | Surgeon consultation + scan £150 | Orthodontic £120
Implants: Swiss implant with crown £1,400 - £1,800
Crowns & Veneers: Zirconia £450-£500 | Metal-ceramic £300 | Temporary £100 | Crown removal £50
Dentures: Standard £500 | Silicone £750 | Partial silicone (up to 3 teeth) £450
Inlays/Onlays: Inlay £180-£260 | Onlay £280 | Overlay £380 | Pinlay £180
Fillings: £110-£160 | Front bonding £250 | Baby tooth £130-£180 | Anesthesia £30
Root canals: Single-root £350-£450 | Multi-root £500-£850 | Per canal £250 | Laser canal £120 | Icon therapy £160 | CA-OH2 £30
Extractions: Single-root £130 | Molar £180 | Wisdom tooth £300-£850 | Baby tooth £70
Cleaning & Whitening: Scale & polish £110-£140 | Air polish £70 | Aqua Care £180 | Hygiene £60 | Sealant £60 | Home whitening £250 | In-clinic whitening £360-£500
Orthodontics: Clear aligners £4,000-£7,000 | Myobrace adult £650/phase | Myobrace child £550/phase
Other: Night guard £180 | Tooth splinting £300 | X-ray £25 | X-ray + reading £70',
                'priority' => 10,
            ],
            [
                'type'     => 'pricing',
                'title'    => 'Payment plans and finance',
                'keywords' => 'finance, payment plan, monthly, installment, spread, pay monthly, разсрочено, вноски',
                'content'  => 'We offer flexible 0% interest payment plans for treatments over £500, allowing you to spread the cost over 6 to 24 months. The package for international patients includes hotel for 3 nights and airport-to-hotel transfer — plane tickets are the only travel cost you cover. Ask us on WhatsApp for a full cost breakdown and finance options.',
                'priority' => 8,
            ],

            // ── Case Studies ─────────────────────────────────────────────
            [
                'type'     => 'case_study',
                'title'    => 'Full smile makeover with veneers and whitening',
                'keywords' => 'smile makeover, transformation, before after, full smile, case',
                'content'  => 'A patient came to us with discoloured and chipped front teeth affecting their confidence. We combined professional whitening and 6 porcelain veneers to create a natural, bright smile. The patient described the result as "life-changing".',
                'priority' => 5,
            ],
            [
                'type'     => 'case_study',
                'title'    => 'Same-day emergency implant consultation',
                'keywords' => 'emergency implant, same day, broken tooth, trauma',
                'content'  => 'A patient arrived with a fractured tooth following an accident. We performed an emergency extraction and placed a temporary solution the same day, followed by a titanium implant and permanent crown over the following months.',
                'priority' => 5,
            ],
        ];

        foreach ($entries as $entry) {
            ChatKnowledge::updateOrCreate(
                ['title' => $entry['title']],
                array_merge($entry, ['is_active' => true])
            );
        }
    }
}
