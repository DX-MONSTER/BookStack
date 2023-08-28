<?php

namespace App\Http\Controllers;

use App\Actions\ActivityType;
use App\Auth\User;
use App\Settings\AppSettingsStore;
use App\Uploads\ImageRepo;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected array $settingCategories = ['features', 'customization', 'registration'];

    /**
     * Handle requests to the settings index path.
     */
    public function index()
    {
        return redirect('/settings/features');
    }

    /**
     * Display the settings for the given category.
     */
    public function category(string $category)
    {
        $this->ensureCategoryExists($category);
        $this->checkPermission('settings-manage');
        $this->setPageTitle(trans('settings.settings'));

        // Get application version
        $version = trim(file_get_contents(base_path('version')));

        return view('settings.' . $category, [
            'category'  => $category,
            'version'   => $version,
            'guestUser' => User::getDefault(),
        ]);
    }

    /**
     * Update the specified settings in storage.
     */
    public function update(Request $request, AppSettingsStore $store, string $category)
    {
        $this->ensureCategoryExists($category);
        $this->preventAccessInDemoMode();
        $this->checkPermission('settings-manage');
        $this->validate($request, [
            'app_logo' => ['nullable', ...$this->getImageValidationRules()],
            'app_icon' => ['nullable', ...$this->getImageValidationRules()],
        ]);

        $store->storeFromUpdateRequest($request, $category);

        $this->logActivity(ActivityType::SETTINGS_UPDATE, $category);
        $this->showSuccessNotification(trans('settings.settings_save_success'));

        return redirect("/settings/{$category}");
    }

    protected function ensureCategoryExists(string $category): void
    {
        if (!in_array($category, $this->settingCategories)) {
            abort(404);
        }
    }
}
