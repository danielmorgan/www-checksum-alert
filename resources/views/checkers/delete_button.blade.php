<form method="POST" action="{{ route('checker.destroy', ['checker' => $checker->id]) }}">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-outline-danger">
        Delete
    </button>
</form>
