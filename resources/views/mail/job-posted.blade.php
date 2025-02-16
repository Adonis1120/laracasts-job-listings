<x-mail::message>
# {{ $job->title }}

Congratulations! Your job is now live on our website.

<x-mail::button :url="url('/jobs/' . $job->id)">    <!-- url() work both on local and production environment -->
View Job
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
