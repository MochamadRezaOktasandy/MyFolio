<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\SkillCategory;
use App\Models\Skill;
use App\Models\Technology;
use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\Experience;
use App\Models\Education;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin CMS
        User::create([
            'name' => 'Portfolio Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // password login: password
        ]);

        // 2. Profile Utama
        Profile::create([
            'name' => 'Your Full Name',
            'headline' => 'Full-Stack Web Developer & Software Engineer',
            'short_bio' => 'Saya berfokus pada pengembangan aplikasi web modern, terukur, dan berkinerja tinggi menggunakan ekosistem Laravel & MySQL.',
            'bio' => 'Seorang Software Engineer dengan pengalaman dalam merancang dan mengimplementasikan sistem aplikasi web kompleks. Berpengalaman menangani arsitektur database relasional, API, dan sistem manajemen konten.',
            'location' => 'Jakarta, Indonesia',
            'availability_status' => 'Available for Work',
            'email' => 'contact@yourdomain.com',
            'phone' => '+62 812 3456 7890',
        ]);

        // 3. Kategori Skill & Skill
        $catBackend = SkillCategory::create(['name' => 'Backend Development', 'slug' => 'backend', 'sort_order' => 1]);
        $catFrontend = SkillCategory::create(['name' => 'Frontend & Tools', 'slug' => 'frontend-tools', 'sort_order' => 2]);

        Skill::create(['skill_category_id' => $catBackend->id, 'name' => 'PHP & Laravel', 'percentage' => 90, 'experience_level' => 'Advanced', 'is_featured' => true, 'sort_order' => 1]);
        Skill::create(['skill_category_id' => $catBackend->id, 'name' => 'MySQL Database Design', 'percentage' => 85, 'experience_level' => 'Advanced', 'is_featured' => true, 'sort_order' => 2]);
        Skill::create(['skill_category_id' => $catBackend->id, 'name' => 'RESTful API & Architecture', 'percentage' => 85, 'experience_level' => 'Advanced', 'is_featured' => true, 'sort_order' => 3]);

        Skill::create(['skill_category_id' => $catFrontend->id, 'name' => 'Tailwind CSS', 'percentage' => 85, 'experience_level' => 'Advanced', 'is_featured' => true, 'sort_order' => 1]);
        Skill::create(['skill_category_id' => $catFrontend->id, 'name' => 'JavaScript & Alpine.js', 'percentage' => 80, 'experience_level' => 'Intermediate', 'is_featured' => true, 'sort_order' => 2]);
        Skill::create(['skill_category_id' => $catFrontend->id, 'name' => 'Git & Docker', 'percentage' => 75, 'experience_level' => 'Intermediate', 'is_featured' => false, 'sort_order' => 3]);

        // 4. Technologies
        $techLaravel = Technology::create(['name' => 'Laravel', 'slug' => 'laravel']);
        $techMySQL = Technology::create(['name' => 'MySQL', 'slug' => 'mysql']);
        $techTailwind = Technology::create(['name' => 'Tailwind CSS', 'slug' => 'tailwind-css']);

        // 5. Project Categories & Projects (Contoh dari PRD)
        $projCatWeb = ProjectCategory::create(['name' => 'Web Application', 'slug' => 'web-application']);

        $project1 = Project::create([
            'title' => 'SIGMA 2.0 — Sistem Informasi Prestasi Mahasiswa',
            'slug' => 'sigma-2-sistem-informasi-prestasi-mahasiswa',
            'short_description' => 'Sistem pencatatan dan verifikasi prestasi mahasiswa berbasis poin dengan elemen gamifikasi leaderboard.',
            'description' => 'SIGMA 2.0 dikembangkan untuk mendigitalkan proses pengajuan, kurasi, dan validasi sertifikat prestasi mahasiswa perguruan tinggi. Dilengkapi dengan audit trail, validasi berkas dinamis, dan kalkulasi ranking otomatis.',
            'thumbnail' => 'https://placehold.co/800x600/1e293b/ffffff?text=SIGMA+2.0',
            'project_category_id' => $projCatWeb->id,
            'role' => 'Lead Backend Developer',
            'status' => 'Completed',
            'start_date' => now()->subMonths(6),
            'end_date' => now()->subMonths(2),
            'github_url' => 'https://github.com',
            'live_url' => 'https://demo.example.com',
            'is_featured' => true,
            'is_published' => true,
            'sort_order' => 1,
        ]);
        $project1->technologies()->sync([$techLaravel->id, $techMySQL->id, $techTailwind->id]);

        ProjectFeature::create([
            'project_id' => $project1->id,
            'title' => 'Gamification & Realtime Leaderboard',
            'description' => 'Penilaian skor prestasi otomatis berdasarkan bobot capaian nasional maupun internasional.',
            'sort_order' => 1,
        ]);
        ProjectFeature::create([
            'project_id' => $project1->id,
            'title' => 'Multi-stage Approval Workflow',
            'description' => 'Verifikasi bertahap dari validator prodi, fakultas, hingga tingkat universitas.',
            'sort_order' => 2,
        ]);

        // 6. Experience & Education
        Experience::create([
            'company' => 'Tech Solution Corp',
            'position' => 'Full-Stack Developer',
            'employment_type' => 'Full-time',
            'location' => 'Jakarta, Indonesia',
            'description' => 'Mengembangkan aplikasi web enterprise berbasis Laravel dan MySQL. Mengoptimasi query database untuk ribuan transaksi harian.',
            'start_date' => now()->subYears(2),
            'is_current' => true,
            'sort_order' => 1,
        ]);

        Education::create([
            'institution' => 'Universitas Negeri / Swasta',
            'degree' => 'Sarjana Komputer (S.Kom)',
            'field_of_study' => 'Teknik Informatika / Sistem Informasi',
            'description' => 'Fokus pada rekayasa perangkat lunak, sistem basis data terdistribusi, dan kecerdasan komputasional.',
            'start_date' => now()->subYears(5),
            'end_date' => now()->subYears(1),
            'is_current' => false,
            'sort_order' => 1,
        ]);

        // 7. Social Links
        SocialLink::create(['platform' => 'GitHub', 'label' => 'github.com/username', 'url' => 'https://github.com', 'sort_order' => 1]);
        SocialLink::create(['platform' => 'LinkedIn', 'label' => 'linkedin.com/in/username', 'url' => 'https://linkedin.com', 'sort_order' => 2]);
    }
}