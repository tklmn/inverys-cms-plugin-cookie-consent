<x-app-layout>
    <x-slot name="header">
        {{ $service ? __('cookie-consent::cc.edit_service') : __('cookie-consent::cc.create_service') }}
    </x-slot>

    <div class="content-inner-wrap">
        <div class="mx-auto">
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow">
                <div class="p-6 text-gray-900 dark:text-white">
                    <h2 class="text-xl font-semibold mb-6">
                        {{ $service ? __('cookie-consent::cc.edit_service') : __('cookie-consent::cc.create_service') }}
                    </h2>

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-400 rounded">
                            <ul class="list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ $service ? route('backend.cookie-consent.services.update', $service['id']) : route('backend.cookie-consent.services.store') }}"
                          method="POST" class="space-y-6">
                        @csrf
                        @if($service)
                            @method('PUT')
                        @endif

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.service_name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $service['name'] ?? '') }}" maxlength="200" required
                                   placeholder="Google Analytics"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        {{-- Category --}}
                        <div>
                            <label for="category" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.service_category') }}</label>
                            <select name="category" id="category" required
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach(['functional', 'statistics', 'marketing'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $service['category'] ?? '') === $cat ? 'selected' : '' }}>
                                        {{ __('cookie-consent::cc.category_' . $cat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Description --}}
                        <div>
                            <label for="description" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.service_description') }}</label>
                            <textarea name="description" id="description" rows="2" maxlength="1000"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $service['description'] ?? '') }}</textarea>
                        </div>

                        {{-- Script --}}
                        <div>
                            <label for="script" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.service_script') }}</label>
                            <textarea name="script" id="script" rows="6" required
                                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-xs">{{ old('script', $service['script'] ?? '') }}</textarea>
                            <p class="mt-1 text-xs text-gray-400">{{ __('cookie-consent::cc.service_script_hint') }}</p>
                        </div>

                        {{-- Position --}}
                        <div>
                            <label for="position" class="block text-sm font-medium mb-1">{{ __('cookie-consent::cc.service_position') }}</label>
                            <select name="position" id="position" required
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach(['head' => 'position_head', 'body_start' => 'position_body_start', 'body_end' => 'position_body_end'] as $val => $labelKey)
                                    <option value="{{ $val }}" {{ old('position', $service['position'] ?? 'body_end') === $val ? 'selected' : '' }}>
                                        {{ __('cookie-consent::cc.' . $labelKey) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <x-btn variant="secondary" icon="bi bi-arrow-left" :href="route('backend.cookie-consent.services')">{{ __('translation.cancel') }}</x-btn>
                            <x-btn variant="primary" type="submit" icon="bi bi-check-lg">{{ __('translation.save') }}</x-btn>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
