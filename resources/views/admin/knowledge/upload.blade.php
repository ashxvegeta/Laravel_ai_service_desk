<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📄 Upload Knowledge PDF
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-2xl p-8">

                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    Add Knowledge Document
                </h3>
                <p class="text-gray-600 mb-6">
                    Upload a PDF file to extract and store knowledge for AI search.
                </p>

                <form method="POST" action="" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- File Upload Box -->
                    <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-indigo-500 transition">
                        <span class="text-4xl mb-2">📄</span>

                        <label class="cursor-pointer text-center">
                            <span class="text-indigo-600 font-medium">
                                Click to upload
                            </span>
                            <span class="text-gray-600">
                                or drag and drop
                            </span>

                            <input
                                type="file"
                                name="pdf"
                                accept="application/pdf"
                                required
                                class="hidden"
                            >
                        </label>

                        <p class="text-xs text-gray-400 mt-2">
                            PDF only · Max 10MB
                        </p>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                        >
                            🚀 Upload & Process
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
