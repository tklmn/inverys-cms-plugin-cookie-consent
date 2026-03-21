<x-app-layout>
    <x-slot name="header">
        {{ __('cookie-consent::cc.settings_title') }}
    </x-slot>

    <div class="content-inner-wrap">
        <div class="mx-auto">
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow">
                <div class="p-6 text-gray-900 dark:text-white">
                    <h2 class="text-xl font-semibold mb-6">{{ __('cookie-consent::cc.settings_heading') }}</h2>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-400 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('backend.cookie-consent.settings.save') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Enable --}}
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="enabled" id="enabled" value="1" {{ ($cc['enabled'] ?? '1') === '1' ? 'checked' : '' }}
                                   class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                            <label for="enabled" class="font-medium">{{ __('cookie-consent::cc.enable') }}</label>
                        </div>

                        {{-- Banner Text --}}
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="banner_text" class="block text-sm font-medium">{{ __('cookie-consent::cc.banner_text') }}</label>
                                <button type="button" id="reset-banner-text"
                                        class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                                    {{ __('cookie-consent::cc.reset_to_default') }}
                                </button>
                            </div>
                            <textarea name="banner_text" id="banner_text" rows="3" maxlength="1000"
                                      placeholder="{{ __('cookie-consent::cc.banner_text_placeholder') }}"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('banner_text', $cc['banner_text'] ?? '') }}</textarea>
                        </div>

                        {{-- Page Links --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="privacy_page_slug" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.privacy_page') }}</label>
                                <select name="privacy_page_slug" id="privacy_page_slug"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('cookie-consent::cc.select_page') }}</option>
                                    @foreach($pages as $slug => $title)
                                        <option value="{{ $slug }}" {{ ($cc['privacy_page_slug'] ?? '') === $slug ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="imprint_page_slug" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.imprint_page') }}</label>
                                <select name="imprint_page_slug" id="imprint_page_slug"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('cookie-consent::cc.select_page') }}</option>
                                    @foreach($pages as $slug => $title)
                                        <option value="{{ $slug }}" {{ ($cc['imprint_page_slug'] ?? '') === $slug ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Position --}}
                        <div>
                            <label for="position" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.position') }}</label>
                            <select name="position" id="position"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="bottom" {{ ($cc['position'] ?? 'bottom') === 'bottom' ? 'selected' : '' }}>{{ __('cookie-consent::cc.position_bottom') }}</option>
                                <option value="modal" {{ ($cc['position'] ?? '') === 'modal' ? 'selected' : '' }}>{{ __('cookie-consent::cc.position_modal') }}</option>
                                <option value="corner" {{ ($cc['position'] ?? '') === 'corner' ? 'selected' : '' }}>{{ __('cookie-consent::cc.position_corner') }}</option>
                            </select>
                        </div>

                        {{-- Colors --}}
                        <div>
                            <label class="block text-sm font-medium mb-2">{{ __('cookie-consent::cc.colors') }}</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach([
                                    'bg_color' => ['label' => 'cookie-consent::cc.bg_color', 'default' => '#1e293b'],
                                    'text_color' => ['label' => 'cookie-consent::cc.text_color', 'default' => '#f1f5f9'],
                                    'btn_bg_color' => ['label' => 'cookie-consent::cc.btn_bg_color', 'default' => '#4f46e5'],
                                    'btn_text_color' => ['label' => 'cookie-consent::cc.btn_text_color', 'default' => '#ffffff'],
                                ] as $colorKey => $colorMeta)
                                    <div>
                                        <label for="{{ $colorKey }}" class="block text-xs text-gray-500 dark:text-gray-400 mb-1">{{ __($colorMeta['label']) }}</label>
                                        <div class="flex items-center gap-2">
                                            <input type="color" name="{{ $colorKey }}" id="{{ $colorKey }}" value="{{ old($colorKey, $cc[$colorKey] ?? $colorMeta['default']) }}"
                                                   class="w-10 h-10 rounded border-gray-300 dark:border-gray-600 cursor-pointer">
                                            <input type="text" value="{{ old($colorKey, $cc[$colorKey] ?? $colorMeta['default']) }}" readonly
                                                   class="w-20 text-xs rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                                                   onclick="this.previousElementSibling.click()" data-mirror="{{ $colorKey }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Cookie Lifetime --}}
                        <div>
                            <label for="cookie_lifetime" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.cookie_lifetime') }}</label>
                            <input type="number" name="cookie_lifetime" id="cookie_lifetime" min="1" max="3650"
                                   value="{{ old('cookie_lifetime', $cc['cookie_lifetime'] ?? '365') }}"
                                   class="w-32 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        {{-- Re-open button --}}
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="show_reopen_btn" id="show_reopen_btn" value="1" {{ ($cc['show_reopen_btn'] ?? '1') === '1' ? 'checked' : '' }}
                                   class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                            <label for="show_reopen_btn">{{ __('cookie-consent::cc.show_reopen_btn') }}</label>
                        </div>

                        {{-- Re-open button position --}}
                        <div>
                            <label for="reopen_position" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.reopen_position') }}</label>
                            <select name="reopen_position" id="reopen_position"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="left" {{ ($cc['reopen_position'] ?? 'left') === 'left' ? 'selected' : '' }}>{{ __('cookie-consent::cc.reopen_position_left') }}</option>
                                <option value="right" {{ ($cc['reopen_position'] ?? 'left') === 'right' ? 'selected' : '' }}>{{ __('cookie-consent::cc.reopen_position_right') }}</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('backend.cookie-consent.services') }}"
                               class="inline-flex items-center gap-2 text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                                <i class="bi bi-gear"></i>
                                {{ __('cookie-consent::cc.manage_services') }}
                            </a>
                            <x-btn variant="primary" type="submit" icon="bi bi-check-lg">{{ __('translation.save') }}</x-btn>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[type="color"]').forEach(function(el) {
            el.addEventListener('input', function() {
                var mirror = el.nextElementSibling;
                if (mirror) mirror.value = el.value;
            });
        });

        document.getElementById('reset-banner-text').addEventListener('click', function() {
            document.getElementById('banner_text').value = '';
        });
    </script>
</x-app-layout>
