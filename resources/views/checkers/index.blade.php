<table class="table table-bordered table-light table-striped table-responsive">
    <thead class="small">
        <tr>
            <th>URL</th>
            <th>Checksum</th>
            <th>Last changed</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($checkers as $checker)
            <tr>
                <td class="align-middle">
                    <a href="{{ $checker->url }}">{{ $checker->url }}</a>
                </td>
                <td class="align-middle">
                    {{ $checker->checksum }}
                </td>
                <td class="align-middle">
                    {{ $checker->updated_at->format('Y-m-d H:i') }}
                </td>
                <td class="align-middle">
                    @include('checkers.delete_button', $checker)
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot class="small">
        <tr>
            <th>URL</th>
            <th>Checksum</th>
            <th>Last changed</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>


