<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full bg-red-600 text-white py-2 px-4 rounded-full font-bold hover:bg-red-700']) }}>
    {{ $slot }}
</button>
