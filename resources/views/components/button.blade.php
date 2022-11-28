@props(['kind' => 'default'])

@php
$defaultClasses = 'flex justify-center px-4 py-2 border rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 0 sm:w-auto sm:text-sm';
$btnClasses = '';
switch ($kind) {
    case 'primary':
        $btnClasses = 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 border-transparent text-white';
        break;
    case 'danger':
        $btnClasses = 'bg-red-600 hover:bg-red-700 focus:ring-red-500  border-transparent text-base text-white';
        break;
    default:
        $btnClasses = 'border-gray-300 bg-white text-base text-gray-700 hover:bg-gray-50 focus:ring-indigo-500';
        break;
}

$btnClasses = $defaultClasses . ' ' . $btnClasses;
@endphp

<button {{ $attributes->merge(['class' => $btnClasses]) }}>
    {{ $slot }}
</button>
