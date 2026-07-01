<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Course;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin user ────────────────────────────────────────────────────────
        // Credentials come from env — never hardcode in production.
        $adminEmail    = env('ADMIN_EMAIL', 'admin@etiba.ac.ke');
        $adminPassword = env('ADMIN_PASSWORD');
        if (!$adminPassword) {
            $adminPassword = Str::random(24);
            $this->command->warn("No ADMIN_PASSWORD set in .env — generated: {$adminPassword}");
        }
        User::updateOrCreate(['email' => $adminEmail], [
            'name'              => 'Etiba Admin',
            'email'             => $adminEmail,
            'password'          => Hash::make($adminPassword),
            'email_verified_at' => now(),
        ]);

        // ── Courses ───────────────────────────────────────────────────────────
        $courses = [
            ['name'=>'Certificate in Basic Life Care (AHA Accreditation)','category'=>'certificate','duration'=>'1 Day','requirements'=>'Medical Professional','description'=>'This intensive one-day program is accredited by the American Heart Association (AHA) and equips medical professionals with essential Basic Life Support skills.'],
            ['name'=>'Certificate In Community Health','category'=>'certificate','duration'=>'1 Year','requirements'=>'D+ & above','description'=>'This one-year certificate program prepares students to deliver primary healthcare services at the community level.'],
            ['name'=>'Certificate in Dementia Care','category'=>'certificate','duration'=>'1 Month','requirements'=>'Caregiver','description'=>'Designed for professional caregivers, this program builds specialised competency in supporting individuals living with dementia.'],
            ['name'=>'Certificate in Dental Assistant','category'=>'certificate','duration'=>'6 Months','requirements'=>'D- & above','description'=>'This six-month hands-on program trains students to assist qualified dentists in delivering oral healthcare.'],
            ['name'=>'Certificate in HIV Testing & Counselling','category'=>'certificate','duration'=>'3 Weeks','requirements'=>'Medical Professional','description'=>'This accredited short course trains healthcare workers in HIV Testing and Counselling (HTC) services.'],
            ['name'=>'Certificate in Mental Health for Caregiver','category'=>'certificate','duration'=>'1 Week','requirements'=>'Caregiver','description'=>'This focused one-week course empowers caregivers with practical knowledge to recognise and respond to mental health conditions.'],
            ['name'=>'Certificate in Nutrition & Dietetics','category'=>'certificate','duration'=>'1 Year','requirements'=>'D+ & above','description'=>'This comprehensive one-year certificate program introduces students to the science of nutrition, food systems, and therapeutic diets.'],
            ['name'=>'Certificate in Palliative Care','category'=>'certificate','duration'=>'2 Weeks','requirements'=>'National ID','description'=>'This two-week program equips healthcare workers with the knowledge required to provide quality palliative care to patients with life-limiting illnesses.'],
            ['name'=>'Certified Nursing Assistant (American Curriculum)','category'=>'certificate','duration'=>'6 Months','requirements'=>'D- & above','description'=>'Based on the American curriculum, this program prepares students to work as Certified Nursing Assistants (CNAs) locally and internationally.'],
            ['name'=>'Computer Packages','category'=>'short_course','duration'=>'2 Months','requirements'=>'National ID','description'=>'This practical two-month course builds foundational digital literacy skills for healthcare professionals and the general public.'],
            ['name'=>'Diploma In Community Health','category'=>'diploma','duration'=>'2 Years','requirements'=>'C- & above','description'=>'This two-year diploma offers advanced training in community and public health practice.'],
            ['name'=>'Health Support Service Level 4','category'=>'certificate','duration'=>'4 Months','requirements'=>'D- & above','description'=>'The H.S.S Level 4 program provides foundational clinical support training aligned to Kenya\'s TVETA framework.'],
            ['name'=>'Health Support Service Level 5','category'=>'certificate','duration'=>'6 Months','requirements'=>'D+ & above','description'=>'Building on Level 4, this advanced H.S.S program deepens clinical skills and broadens the scope of practice.'],
            ['name'=>'Healthcare Support Service (Upgrade Level 4 to 5)','category'=>'certificate','duration'=>'3 Months','requirements'=>'H.S.S Level 4 Certificate','description'=>'This three-month bridging program is designed exclusively for H.S.S Level 4 certificate holders who wish to upgrade to Level 5.'],
            ['name'=>'Italian Language','category'=>'short_course','duration'=>'4 Months','requirements'=>'Registered Nurse','description'=>'This language program is specifically tailored for Kenyan nurses seeking employment in Italy.'],
            ['name'=>'Perioperative Theatre Technology Level 5','category'=>'certificate','duration'=>'1 Year','requirements'=>'D+ & above','description'=>'This one-year certificate trains students in the technical and clinical skills required to support surgical teams in the operating theatre.'],
            ['name'=>'Perioperative Theatre Technology Level 6','category'=>'diploma','duration'=>'2 Years','requirements'=>'C- & above','description'=>'This advanced two-year diploma provides comprehensive training in perioperative care and theatre management.'],
            ['name'=>'Phlebotomy (Full Time)','category'=>'certificate','duration'=>'1 Month','requirements'=>'Medical Professional','description'=>'This intensive full-time phlebotomy course trains medical professionals in safe and efficient blood collection techniques.'],
            ['name'=>'Phlebotomy (Part Time)','category'=>'certificate','duration'=>'1½ Months','requirements'=>'Medical Professional','description'=>'Designed for working healthcare professionals, this part-time phlebotomy program covers the same curriculum with flexible scheduling.'],
        ];
        foreach ($courses as $i => $c) {
            Course::updateOrCreate(['name'=>$c['name']], array_merge($c,['is_active'=>true,'sort_order'=>$i+1]));
        }

        // ── Events ────────────────────────────────────────────────────────────
        $events = [
            ['title'=>'Clinical Orientation For Theatre Tech / Level 5 Assessment','description'=>'A day dedicated to the Clinical Orientation for Theatre Technology students, Level 5 assessments, and an official meeting at Etiba offices.','event_date'=>'2025-09-01','location'=>'St Francis','category'=>'orientation'],
            ['title'=>'Exam Week for H.S.S / Italy Nurse Migration Journey','description'=>'A crucial examination period for Health Support Services students, followed by a special information session on the Italy Nurse Migration program.','event_date'=>'2025-09-02','location'=>'Institution','category'=>'exam'],
            ['title'=>'Clinical Orientation H.S.S Level 5 / September Intake','description'=>'Orientation for newly admitted Level 5 H.S.S students, focusing on clinical expectations and placement procedures.','event_date'=>'2025-09-08','location'=>'St Francis / Institution','category'=>'orientation'],
            ['title'=>'Chat With Dr. Valarie','description'=>'An interactive mentorship session where Dr. Valarie engages students and staff in an open discussion about healthcare careers.','event_date'=>'2025-09-12','location'=>'Institution','category'=>'seminar'],
            ['title'=>'Deaf Awareness Day','description'=>'A special event dedicated to promoting inclusivity and awareness about the deaf community.','event_date'=>'2025-09-26','location'=>'Institution','category'=>'awareness'],
            ['title'=>'BLS / ACLS Training','description'=>'Hands-on professional training on Basic Life Support (BLS) and Advanced Cardiovascular Life Support (ACLS).','event_date'=>'2025-10-04','location'=>'Institution','category'=>'training'],
        ];
        foreach ($events as $i => $e) {
            Event::updateOrCreate(['title'=>$e['title']], array_merge($e,['is_active'=>true,'sort_order'=>$i+1]));
        }

        // ── Testimonials ──────────────────────────────────────────────────────
        $testimonials = [
            ['name'=>'Sarah Wanjiku','role'=>'Registered Nurse','quote'=>'Etiba Training College provided me with excellent practical training and theoretical knowledge. The hands-on experience prepared me well for my career in healthcare.','rating'=>5],
            ['name'=>'James Ochieng','role'=>'Healthcare Support Officer','quote'=>'The quality of education at Etiba is outstanding. The instructors are knowledgeable and supportive, and the curriculum is well-designed to meet industry standards.','rating'=>5],
            ['name'=>'Mary Njeri','role'=>'Theatre Technician','quote'=>'I am grateful for the comprehensive training I received. The college\'s connections with healthcare institutions helped me secure employment immediately after graduation.','rating'=>5],
            ['name'=>'Peter Kiprotich','role'=>'Community Health Worker','quote'=>'Etiba Training College offers affordable, quality education. The flexible schedules allowed me to work while studying.','rating'=>5],
            ['name'=>'Grace Akinyi','role'=>'Nursing Assistant','quote'=>'The American curriculum for nursing assistant training was exceptional. I now work in a leading hospital and feel confident in my skills.','rating'=>5],
            ['name'=>'David Mwangi','role'=>'Nutrition Specialist','quote'=>'The practical approach to learning at Etiba is what sets it apart. I gained real-world experience invaluable in my career as a nutrition specialist.','rating'=>5],
        ];
        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name'=>$t['name']], array_merge($t,['is_active'=>true]));
        }

        // ── Site Settings ─────────────────────────────────────────────────────
        $settings = [
            ['key'=>'site_name',       'value'=>'Etiba Training College',            'group'=>'general'],
            ['key'=>'site_tagline',    'value'=>'Where Education Meets Opportunity', 'group'=>'general'],
            ['key'=>'site_email',      'value'=>'etibahealthcare@gmail.com',         'group'=>'general'],
            ['key'=>'site_phone',      'value'=>'+254 798 185 212',                  'group'=>'general'],
            ['key'=>'site_address',    'value'=>'Kasarani, D.O. Office, Mwiki Rd.',  'group'=>'general'],
            ['key'=>'whatsapp_number', 'value'=>'254798185212',                      'group'=>'social'],
            ['key'=>'admissions_open', 'value'=>'Open',                              'group'=>'admissions'],
        ];
        foreach ($settings as $s) {
            SiteSetting::updateOrCreate(['key'=>$s['key']], $s);
        }

        // ── Gallery ───────────────────────────────────────────────────────────
        $gallery = [
            ['title' => 'Certificate Presentation',    'description' => 'Students receiving certificates at the annual awards ceremony.',          'image_path' => 'gallery/event-1.webp',    'category' => 'events',   'sort_order' => 1],
            ['title' => 'Graduation Ceremony',         'description' => 'Proud graduates at the Etiba Training College graduation ceremony.',       'image_path' => 'gallery/event-2.webp',    'category' => 'events',   'sort_order' => 2],
            ['title' => 'Graduation Day',              'description' => 'Students celebrating their achievements on graduation day.',               'image_path' => 'gallery/event-3.webp',    'category' => 'events',   'sort_order' => 3],
            ['title' => 'College Event',               'description' => 'Staff and students at a college function.',                                'image_path' => 'gallery/event-4.webp',    'category' => 'events',   'sort_order' => 4],
            ['title' => 'Classroom Session',           'description' => 'Students engaged in an interactive theory session.',                       'image_path' => 'gallery/class-1.webp',    'category' => 'classes',  'sort_order' => 5],
            ['title' => 'Practical Training Class',    'description' => 'Hands-on learning in our modern training facilities.',                    'image_path' => 'gallery/class-2.webp',    'category' => 'classes',  'sort_order' => 6],
            ['title' => 'Group Study Session',         'description' => 'Students collaborating on coursework and assignments.',                    'image_path' => 'gallery/class-3.webp',    'category' => 'classes',  'sort_order' => 7],
            ['title' => 'Lecture in Progress',         'description' => 'An engaging lecture session led by our experienced faculty.',             'image_path' => 'gallery/class-4.webp',    'category' => 'classes',  'sort_order' => 8],
            ['title' => 'Clinical Skills Training',    'description' => 'Students practising clinical procedures under expert supervision.',        'image_path' => 'gallery/training-1.webp', 'category' => 'training', 'sort_order' => 9],
            ['title' => 'BLS & ACLS Training',         'description' => 'Basic Life Support and Advanced Cardiovascular Life Support training.',    'image_path' => 'gallery/training-2.webp', 'category' => 'training', 'sort_order' => 10],
            ['title' => 'Healthcare Professional',     'description' => 'An Etiba graduate excelling in her nursing career.',                      'image_path' => 'gallery/gallery-1.webp',  'category' => 'general',  'sort_order' => 11],
            ['title' => 'Etiba Staff',                 'description' => 'Our dedicated team of healthcare educators and support staff.',            'image_path' => 'gallery/gallery-2.webp',  'category' => 'general',  'sort_order' => 12],
            ['title' => 'Staff and Students',          'description' => 'A memorable moment shared between staff and students.',                    'image_path' => 'gallery/gallery-3.webp',  'category' => 'general',  'sort_order' => 13],
            ['title' => 'Campus Life',                 'description' => 'Students enjoying a positive and supportive campus environment.',          'image_path' => 'gallery/gallery-4.webp',  'category' => 'general',  'sort_order' => 14],
            ['title' => 'College Community',           'description' => 'Building a strong healthcare community at Etiba.',                         'image_path' => 'gallery/gallery-5.webp',  'category' => 'general',  'sort_order' => 15],
            ['title' => 'Team Spirit',                 'description' => 'Our community united by a shared passion for healthcare.',                 'image_path' => 'gallery/gallery-6.webp',  'category' => 'general',  'sort_order' => 16],
            ['title' => 'Learning Together',           'description' => 'Collaborative learning is at the heart of what we do.',                   'image_path' => 'gallery/gallery-7.webp',  'category' => 'general',  'sort_order' => 17],
            ['title' => 'Etiba Family',                'description' => 'The Etiba Training College family — students and staff together.',         'image_path' => 'gallery/gallery-8.webp',  'category' => 'general',  'sort_order' => 18],
        ];
        foreach ($gallery as $g) {
            Gallery::updateOrCreate(['image_path' => $g['image_path']], array_merge($g, ['is_active' => true]));
        }

        $this->command->info('Seeded: courses, events, testimonials, gallery, settings, admin user.');
    }
}
