@if ($errors->any())
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded">
        <ul class="list-disc pl-5 text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif