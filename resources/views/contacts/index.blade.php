@extends('layouts.contact')

@section('content')
<div class="container mt-4">
    <h2><i class="bi bi-person-lines-fill"></i> Kontaktų sąrašas</h2>
    <h2 class="mt-4"><i class="bi bi-person-lines-fill"></i> Kontaktų sąrašas</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Uždaryti"></button>
        </div>
    @endif

    <div class="my-4 d-flex gap-2 flex-wrap">
        <a href="{{ url('/form') }}" class="btn btn-outline-info">Formos testavimas</a>
        <a href="{{ url('/test-email') }}" class="btn btn-outline-warning">Testinis laiškas</a>
        <a href="{{ route('contacts.create') }}" class="btn btn-outline-success">Pridėti kontaktą</a>
        <a href="{{ route('contacts.trashed') }}" class="btn btn-outline-secondary">Ištrinti kontaktai</a>
    </div>

    @if($contacts->isEmpty())
        <div class="alert alert-info">Kontaktų nėra.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Vardas</th>
                        <th>El. paštas</th>
                        <th>Telefonas</th>
                        <th class="text-center">Veiksmai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td class="text-center">
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Redaguoti">
                                    ✏️
                                </a>

                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Ar tikrai norite ištrinti šį kontaktą?')">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
