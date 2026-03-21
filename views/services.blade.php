<x-app-layout>
    <x-slot name="header">
        {{ __('cookie-consent::cc.services_title') }}
    </x-slot>

    <div class="content-inner-wrap">
        <div class="mx-auto">
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow">
                <div class="p-6 text-gray-900 dark:text-white">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold">{{ __('cookie-consent::cc.services_heading') }}</h2>
                        <a href="{{ route('backend.cookie-consent.services.create') }}">
                            <x-btn variant="primary" icon="bi bi-plus-lg">{{ __('cookie-consent::cc.add_service') }}</x-btn>
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-400 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(empty($services))
                        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('cookie-consent::cc.no_services') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700 text-left">
                                        <th class="py-3 px-2 font-medium">{{ __('cookie-consent::cc.service_name') }}</th>
                                        <th class="py-3 px-2 font-medium">{{ __('cookie-consent::cc.service_category') }}</th>
                                        <th class="py-3 px-2 font-medium">{{ __('cookie-consent::cc.service_position') }}</th>
                                        <th class="py-3 px-2 font-medium text-right">{{ __('translation.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="py-3 px-2 font-medium">{{ $service['name'] }}</td>
                                            <td class="py-3 px-2">
                                                @php
                                                    $badgeColors = [
                                                        'functional' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                        'statistics' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                                        'marketing' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
                                                    ];
                                                @endphp
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badgeColors[$service['category']] ?? '' }}">
                                                    {{ __('cookie-consent::cc.category_' . $service['category']) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-2 text-gray-500 dark:text-gray-400">
                                                {{ __('cookie-consent::cc.position_' . $service['position']) }}
                                            </td>
                                            <td class="py-3 px-2 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('backend.cookie-consent.services.edit', $service['id']) }}"
                                                       class="text-indigo-600 dark:text-indigo-400 hover:underline text-xs">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('backend.cookie-consent.services.destroy', $service['id']) }}" method="POST"
                                                          onsubmit="return confirm('Delete this service?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-xs">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <x-btn variant="secondary" icon="bi bi-arrow-left" :href="route('backend.cookie-consent.settings')">{{ __('cookie-consent::cc.back_to_settings') }}</x-btn>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
