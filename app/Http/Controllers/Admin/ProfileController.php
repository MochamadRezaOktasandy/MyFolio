<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrCreate(['id' => 1], [
            'name' => 'Your Name',
            'headline' => 'Full-Stack Developer',
            'short_bio' => 'Short bio here',
            'bio' => 'Full bio here',
            'location' => 'Indonesia',
            'email' => 'admin@example.com',
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'headline' => 'required|string|max:150',
            'short_bio' => 'required|string|max:300',
            'bio' => 'required|string',
            'location' => 'required|string|max:100',
            'availability_status' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:30',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cv_file' => 'nullable|mimes:pdf|max:5120',
        ]);

        // Upload Profile Image jika ada
        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image && Storage::disk('public')->exists($profile->profile_image)) {
                Storage::disk('public')->delete($profile->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        // Upload CV File (PDF) jika ada
        if ($request->hasFile('cv_file')) {
            if ($profile->cv_file && Storage::disk('public')->exists($profile->cv_file)) {
                Storage::disk('public')->delete($profile->cv_file);
            }
            $validated['cv_file'] = $request->file('cv_file')->store('cv', 'public');
        }

        $profile->update($validated);

        return back()->with('success', 'Profil dan biodata berhasil diperbarui!');
    }
}
