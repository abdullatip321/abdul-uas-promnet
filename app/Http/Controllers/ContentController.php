<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Gambar;
use App\Models\IsiContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of content.
     */
    public function index()
    {
        $contents = Content::with(['penulis', 'gambar', 'isi'])
            ->latest()
            ->paginate(10);
        
        return view('content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new content.
     */
    public function create()
    {
        return view('content.create');
    }

    /**
     * Store a newly created content in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'status' => 'required|in:draft,publish',
            'isi_content' => 'nullable|array',
            'isi_content.*.subjudul' => 'nullable|string',
            'isi_content.*.isi' => 'nullable|string',
            'isi_content.*.nomor' => 'nullable|integer',
            'gambars' => 'nullable|array',
            'gambars.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_descriptions' => 'nullable|array',
        ]);

        
        DB::beginTransaction();
        
        try {
            // Create content
            $content = Content::create([
                'judul' => $validated['judul'],
                'slug' => Str::slug($validated['judul']),
                'user_id' => auth()->id(),
                'status' => $validated['status'],
            ]);

            // Handle images upload
            $gambarIds = [];
            if ($request->hasFile('gambars')) {
                foreach ($request->file('gambars') as $index => $file) {
                    $path = $file->store('gambars', 'public');
                    $description = $request->gambar_descriptions[$index] ?? null;
                    
                    $gambar = Gambar::create([
                        'path' => $path,
                        'description' => $description,
                        'content_id' => $content->id,
                    ]);
                    
                    $gambarIds[$index] = $gambar->id;
                }
            }

            // Create isi content
            if ($request->has('isi_content')) {
                foreach ($request->isi_content as $index => $isiData) {
                    
                

                    IsiContent::create([
                        'nomor' => $isiData['nomor'] ?? $index + 1,
                        'subjudul' => $isiData['subjudul'] ?? '',
                        'isi' => $isiData['isi'] ?? null,
                        'gambar_id' => $gambarIds[$index] ?? null,
                        'content_id' => $content->id,
                    ]);
                }
            }

            DB::commit();
            
            return redirect()->route('contents.index')
                ->with('success', 'Content berhasil dibuat!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()
                ->with('error', 'Gagal membuat content: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified content.
     */
    public function show(Content $content)
    {
        $content->load(['penulis', 'gambar', 'isi.gambar']);
        
        return view('content.show', compact('content'));
    }

    /**
     * Show the form for editing the specified content.
     */
    public function edit(Content $content)
    {
        $content->load(['gambar', 'isi.gambar']);
        
        return view('content.edit', compact('content'));
    }

    /**
     * Update the specified content in storage.
     */
    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'status' => 'required|in:draft,publish',
            'isi_content' => 'nullable|array',
            'isi_content.*.id' => 'nullable|exists:isi_contents,id',
            'isi_content.*.subjudul' => 'nullable|string',
            'isi_content.*.isi' => 'nullable|string',
            'isi_content.*.nomor' => 'nullable|integer',
            'gambars' => 'nullable|array',
            'gambars.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_descriptions' => 'nullable|array',
            'delete_gambars' => 'nullable|array',
            'delete_isi_contents' => 'nullable|array',
        ]);

        DB::beginTransaction();
        
        try {
            // Update content
            $content->update([
                'judul' => $validated['judul'],
                'slug' => Str::slug($validated['judul']),
                'status' => $validated['status'],
            ]);

            // Delete marked images
            if ($request->has('delete_gambars')) {
                foreach ($request->delete_gambars as $gambarId) {
                    $gambar = Gambar::find($gambarId);
                    if ($gambar && $gambar->content_id == $content->id) {
                        Storage::disk('public')->delete($gambar->path);
                        $gambar->delete();
                    }
                }
            }

            // Delete marked isi contents
            if ($request->has('delete_isi_contents')) {
                IsiContent::whereIn('id', $request->delete_isi_contents)
                    ->where('content_id', $content->id)
                    ->delete();
            }

            // Handle new images upload
            $gambarIds = [];
            if ($request->hasFile('gambars')) {
                foreach ($request->file('gambars') as $index => $file) {
                    $path = $file->store('gambars', 'public');
                    $description = $request->gambar_descriptions[$index] ?? null;
                    
                    $gambar = Gambar::create([
                        'path' => $path,
                        'description' => $description,
                        'content_id' => $content->id,
                    ]);
                    
                    $gambarIds[$index] = $gambar->id;
                }
            }

            // Update or create isi content
            if ($request->has('isi_content')) {
                foreach ($request->isi_content as $index => $isiData) {
                    if (isset($isiData['id'])) {
                        // Update existing
                        IsiContent::where('id', $isiData['id'])
                            ->where('content_id', $content->id)
                            ->update([
                                'nomor' => $isiData['nomor'] ?? $index + 1,
                                'subjudul' => $isiData['subjudul'] ?? '',
                                 'isi' => $isiData['isi'] ?? null,
                            ]);
                    } else {
                        // Create new
                        IsiContent::create([
                            'nomor' => $isiData['nomor'] ?? $index + 1,
                            'subjudul' => $isiData['subjudul'] ?? '',
                            'isi' => $isiData['isi'] ?? null,
                            'gambar_id' => $gambarIds[$index] ?? null,
                            'content_id' => $content->id,
                        ]);
                    }
                }
            }

            DB::commit();
            
            return redirect()->route('contents.index')
                ->with('success', 'Content berhasil diupdate!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()
                ->with('error', 'Gagal mengupdate content: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified content from storage.
     */
    public function destroy(Content $content)
    {
        DB::beginTransaction();
        
        try {
            // Delete all related images from storage
            foreach ($content->gambar as $gambar) {
                Storage::disk('public')->delete($gambar->path);
            }
            
            // Delete content (cascade will handle related records if set in DB)
            $content->delete();
            
            DB::commit();
            
            return redirect()->route('contents.index')
                ->with('success', 'Content berhasil dihapus!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', 'Gagal menghapus content: ' . $e->getMessage());
        }
    }
}