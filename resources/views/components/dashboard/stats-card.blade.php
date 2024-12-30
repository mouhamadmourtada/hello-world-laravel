@props(['title', 'value', 'percentage', 'trend', 'icon'])

<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-gray-500 text-sm font-medium">{{ $title }}</h3>
            <div class="mt-1">
                <p class="text-3xl font-semibold">{{ $value }}</p>
            </div>
        </div>
        <div class="p-3 rounded-full {{ $trend === 'up' ? 'bg-green-100' : 'bg-red-100' }}">
            {!! $icon !!}
        </div>
    </div>
    <div class="flex items-center">
        <span class="{{ $trend === 'up' ? 'text-green-600' : 'text-red-600' }} text-sm font-medium">
            {{ $percentage }}%
        </span>
        <span class="text-gray-500 text-sm ml-2">vs mois dernier</span>
    </div>
</div>
