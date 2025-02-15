<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $job->title }}</h2>

    <p>
        This job pays {{ $job->salary }} per year.
    </p>

    @can('edit-job', $job)
        <p class="mt-6">
            <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
            <!-- sample for form attribute -->
            <button form="delete-form" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
        </p>

        <form action="/jobs/{{ $job->id }}" method="POST" id="delete-form" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endcan
</x-layout>