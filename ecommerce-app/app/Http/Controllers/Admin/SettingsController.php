<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(Request $request): View
    {
        $tab = $request->get('tab', 'general');

        return view('admin.settings.edit', [
            'tab' => $tab,
            'setting' => Setting::query()->firstOrCreate([], ['status' => 'active']),
            'socials' => Social::query()->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $tab = $request->input('tab', 'general');
        $setting = Setting::query()->firstOrCreate([], ['status' => 'active']);

        match ($tab) {
            'general' => $setting->update($request->validate([
                'title' => ['nullable', 'string', 'max:255'],
                'keywords' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'company' => ['nullable', 'string', 'max:255'],
                'address' => ['nullable', 'string'],
                'phone' => ['nullable', 'string', 'max:50'],
                'email' => ['nullable', 'email', 'max:255'],
            ])),
            'smtp' => $setting->update($request->validate([
                'smtp_server' => ['nullable', 'string', 'max:255'],
                'smtp_port' => ['nullable', 'string', 'max:20'],
                'smtp_email' => ['nullable', 'email', 'max:255'],
                'smtp_password' => ['nullable', 'string', 'max:255'],
            ])),
            'about' => $setting->update($request->validate([
                'aboutus' => ['nullable', 'string'],
            ])),
            'contact' => $setting->update($request->validate([
                'contact' => ['nullable', 'string'],
            ])),
            'references' => $setting->update($request->validate([
                'references' => ['nullable', 'string'],
            ])),
            'social' => $this->updateSocials($request),
            default => null,
        };

        return redirect()
            ->route('admin.settings.edit', ['tab' => $tab])
            ->with('success', 'Settings updated successfully.');
    }

    private function updateSocials(Request $request): void
    {
        $data = $request->validate([
            'socials' => ['nullable', 'array'],
            'socials.*.id' => ['nullable', 'integer', 'exists:socials,id'],
            'socials.*.title' => ['required', 'string', 'max:100'],
            'socials.*.url' => ['nullable', 'url', 'max:255'],
            'socials.*.status' => ['required', 'in:active,inactive'],
        ]);

        foreach ($data['socials'] ?? [] as $row) {
            if (! empty($row['id'])) {
                Social::query()->whereKey($row['id'])->update([
                    'title' => $row['title'],
                    'url' => $row['url'],
                    'status' => $row['status'],
                ]);
            }
        }
    }
}
