<select
    {{ $disabled ?? false ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'mt-1 block w-full py-2 px-3 border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:border-indigo-500 focus:ring-opacity-50 sm:text-sm']) !!}
>
    {{ $slot }}
</select>
