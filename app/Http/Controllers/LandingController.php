<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of published blog posts
     */
    public function index(Request $request)
    {
        $query = Content::with(['penulis', 'gambar', 'isi'])
            ->where('status', 'publish')
            ->latest();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $contents = $query->paginate(9);

        return view('landing.index', compact('contents'));
    }

    /**
     * Display the specified blog post
     */
    public function show($slug)
    {
        $content = Content::with(['penulis', 'gambar', 'isi.gambar'])
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        return view('landing.show', compact('content'));
    }
}