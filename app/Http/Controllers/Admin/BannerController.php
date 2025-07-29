<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with('subBanners')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'href' => 'nullable|string',
            'button' => 'nullable|string',
            'description2' => 'nullable|string',
            'description3' => 'nullable|string',
            'description4' => 'nullable|string',
            'description5' => 'nullable|string',
            'image_desktop' => 'nullable|string',
            'image_mobile' => 'nullable|string',

            'sub_banners.*.title' => 'required|string',
            'sub_banners.*.image_desktop' => 'nullable|string',
            'sub_banners.*.image_mobile' => 'nullable|string',
            'sub_banners.*.button' => 'nullable|string',
        ]);
        $banner = Banner::create($data);

        // Lưu sub banners
        if ($request->has('sub_banners')) {
            foreach ($request->sub_banners as $sub) {
                $banner->subBanners()->create([
                    'title' => $sub['title'] ?? '',
                    'description' => $sub['description'] ?? '',
                    'href' => $sub['href'] ?? '',
                    'image_desktop' => $sub['image_desktop'] ?? '',
                    'image_mobile' => $sub['image_mobile'] ?? '',
                    'button' => $sub['button'] ?? '',
                ]);
            }
        }

        return redirect()->route('banners.index')->with('success', 'Banner created.');
    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'href' => 'nullable|string',
            'button' => 'nullable|string',
            'description2' => 'nullable|string',
            'description3' => 'nullable|string',
            'description4' => 'nullable|string',
            'description5' => 'nullable|string',
            'image_desktop' => 'nullable|string',
            'image_mobile' => 'nullable|string',

            'sub_banners.*.title' => 'required|string',
            'sub_banners.*.image_desktop' => 'nullable|string',
            'sub_banners.*.image_mobile' => 'nullable|string',
            'sub_banners.*.button' => 'nullable|string',
        ]);

        $banner->update($data);

        // Xoá toàn bộ subbanner cũ
        $banner->subBanners()->delete();

        // Tạo lại subbanners mới
        if ($request->has('sub_banners')) {
            foreach ($request->sub_banners as $sub) {
                $banner->subBanners()->create([
                    'title' => $sub['title'] ?? '',
                    'description' => $sub['description'] ?? '',
                    'href' => $sub['href'] ?? '',
                    'image_desktop' => $sub['image_desktop'] ?? '',
                    'image_mobile' => $sub['image_mobile'] ?? '',
                    'button' => $sub['button'] ?? '',
                ]);
            }
        }

        return redirect()->route('banners.index')->with('success', 'Banner updated.');
    }


    public function destroy(Banner $banner)
    {
        $banner->delete();
        $banner->subBanners()->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Banner deleted.']);
        }

        return redirect()->route('banners.index')->with('success', 'Banner deleted.');
    }


    public function destroySelected(Request $request)
    {
        Log::info('destroySelected called with input: ', $request->all());
        $ids = $request->input('ids', []);
        if (count($ids) > 0) {
            $banners = Banner::whereIn('id', $ids)->get();

            foreach ($banners as $banner) {
                $banner->subBanners()->delete();
                $banner->delete();
            }
            return redirect()->route('banners.index')->with('success', 'Banner updated.');
        } else {
            return redirect()->route('banners.index')->with('error', 'No banners selected.');
        }
    }
}
