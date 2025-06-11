@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h2 class="mb-0">👥 Manage Residents</h2>
        </div>
        <div class="card-body">
            {{-- DataTable --}}
            {{ $dataTable->table([
                'id' => 'residents-table',
                'class' => 'table table-hover table-bordered table-striped table-sm align-middle text-center'
            ], true) }}
        </div>
    </div>
</div>
@endsection

{{ $dataTable->scripts() }}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('click', function (e) {
        const deleteBtn = e.target.closest('.btn-delete');
        if (deleteBtn) {
            e.preventDefault();
            const form = deleteBtn.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete the resident.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
            return;
        }

        const statusToggle = e.target.closest('.form-check-input');
        if (statusToggle) {
            e.preventDefault();
            const form = statusToggle.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will change resident status.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        }
    });
});
</script>
@endpush
