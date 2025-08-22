@extends('layouts.app')
@section('title', 'Data SPPG')
@section('content')
<div class="container mb-4">
    <h2 class="mb-3">Data SPPG</h2>
    
    <div class="card p-3 shadow-sm">
        <!-- Search Bar -->
        <div class="d-flex justify-content-end mb-2">
            <form action="{{ route('data') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" 
                       placeholder="Masukan ID SPPG" 
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-primary">Search</button>
            </form>
        </div>

        <!-- Table -->
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID SPPG</th>
                        <th>Status</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sppgs as $sppg)
                        <tr>
                            <td>{{ $sppg->id_sppg }}</td>
                            <td>{{ $sppg->status_pengajuan }}</td>
                            <td>{{ $sppg->alamat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
