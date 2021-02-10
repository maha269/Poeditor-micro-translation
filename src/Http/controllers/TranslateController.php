<?php

namespace NextApps\PoeditorSync\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use NextApps\PoeditorSync\Poeditor\Poeditor;
use NextApps\PoeditorSync\Translations\TranslationManager;

class TranslateController extends Controller
{
    public function send()
    {
        if (app()->getLocale() === null) {
            $this->error('Invalid locale provided!');

            return 1;
        }
        $translations = app(TranslationManager::class)->getTranslations(app()->getLocale());

        $response = app(Poeditor::class)->upload(
            $this->getPoeditorLocale(),
            $translations, false);
        if ($response->content['response']['code'] == 200) {
            $message = $response->content['response']['status'] . ' => All translations have been uploaded. (' .
                $response->content['result']['terms']['added'] . ') terms added, (' .
                $response->content['result']['terms']['deleted'] . ') terms deleted, (' .
                $response->content['result']['translations']['added'] . ') translations added, (' .
                $response->content['result']['translations']['updated'] . ') translations updated. ';
            return ['message' => $message];
        }
        return false;
    }

    public function download()
    {
        $this->getLocales()->each(function ($locale, $key) {
            $translations = app(Poeditor::class)->download(is_string($key) ? $key : $locale);

            app(TranslationManager::class)->createTranslationFiles($translations, $locale);
        });
        return ['message' => 'Sussess : All ranslations have been downloaded'];
    }

    public function isSuccess($response): bool
    {
        return isset($response) && is_array($response) && ($response['code'] === 200 || $response['code'] === 201);
    }

    protected function getLocale()
    {
        $locale = $this->argument('locale') ?? app()->getLocale();

        if (!in_array($locale, config('poeditor-sync.locales'))) {
            return;
        }

        return $locale;
    }

    /**
     * Get POEditor locale.
     *
     * @return string
     */
    protected function getPoeditorLocale()
    {
        $locales = config('poeditor-sync.locales');

        if (Arr::isAssoc($locales)) {
            return array_flip($locales)[app()->getLocale()];
        }

        return app()->getLocale();
    }

    protected function getLocales()
    {
        return collect(config('poeditor-sync.locales'));
    }
}
