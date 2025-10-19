<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\Major;
use App\Models\News;
use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalTeachers = Teacher::count();
        $totalMajors = Major::count();
        $totalNews = News::count();
        $totalAchievements = Achievement::count();
        $totalGalleries = Gallery::count();
        $totalCategories = Category::count();

        // Koleksi semua aktivitas
        $activities = collect();

        // User
        foreach (User::latest()->take(3)->get(['username', 'created_at']) as $u) {
            $activities->push([
                'name' => 'User Baru: ' . $u->username,
                'category' => 'User',
                'date' => $u->created_at,
            ]);
        }

        // Role
        foreach (Role::latest()->take(3)->get(['role_name', 'created_at']) as $r) {
            $activities->push([
                'name' => 'Role Baru: ' . $r->role_name,
                'category' => 'Role',
                'date' => $r->created_at,
            ]);
        }

        // Guru
        foreach (Teacher::latest()->take(3)->get(['name', 'created_at']) as $t) {
            $activities->push([
                'name' => 'Guru Baru: ' . $t->name,
                'category' => 'Guru',
                'date' => $t->created_at,
            ]);
        }

        // Jurusan
        foreach (Major::latest()->take(3)->get(['name', 'created_at']) as $m) {
            $activities->push([
                'name' => 'Jurusan Baru: ' . $m->name,
                'category' => 'Jurusan',
                'date' => $m->created_at,
            ]);
        }

        // Berita
        foreach (News::latest()->take(3)->get(['title', 'created_at']) as $n) {
            $activities->push([
                'name' => 'Berita Baru: ' . $n->title,
                'category' => 'Berita',
                'date' => $n->created_at,
            ]);
        }

        // Prestasi
        foreach (Achievement::latest()->take(3)->get(['title', 'created_at']) as $a) {
            $activities->push([
                'name' => 'Prestasi Baru: ' . $a->title,
                'category' => 'Prestasi',
                'date' => $a->created_at,
            ]);
        }

        // Galeri
        foreach (Gallery::latest()->take(3)->get(['title', 'created_at']) as $g) {
            $activities->push([
                'name' => 'Foto Baru di Galeri: ' . $g->title,
                'category' => 'Galeri',
                'date' => $g->created_at,
            ]);
        }

        // Kategori
        foreach (Category::latest()->take(3)->get(['name', 'created_at']) as $c) {
            $activities->push([
                'name' => 'Kategori Baru: ' . $c->name,
                'category' => 'Kategori',
                'date' => $c->created_at,
            ]);
        }

        // 🔥 Urutkan semua aktivitas berdasarkan tanggal terbaru
        $activities = $activities->sortByDesc('date')->take(15)->values();

        return view('dashboard', compact(
            'totalUsers',
            'totalRoles',
            'totalTeachers',
            'totalMajors',
            'totalNews',
            'totalAchievements',
            'totalGalleries',
            'totalCategories',
            'activities'
        ));
    }
}