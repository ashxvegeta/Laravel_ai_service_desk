<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">📄 Upload Knowledge PDF</h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto">
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf

            <input type="file" name="pdf" accept="application/pdf" required>

            <button class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded">
                Upload
            </button>
        </form>
    </div>
</x-app-layout>
