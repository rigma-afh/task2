@extends('layouts.app')

@section('content')
 <div class="text-end mb-2">

</div>



<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h2 class="mb-0"> Manage Residents</h2>
               <a href="{{ route('residents.create') }}"
       class="btn btn-primary btn-sm btn-add"
       title="Add Resident">
        <i class="fas fa-pen-to-square me-1"></i> Add Resident
    </a>
        </div>


{{-- @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif --}}




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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.body.addEventListener('click', function (e) {
            const deleteBtn = e.target.closest('.btn-delete');
            if (deleteBtn) {
                e.preventDefault();

                const form = deleteBtn.closest('form[name="dlt-form"]');
                if (!form) return;

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
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
@endpush

 {{-- // const statusToggle = e.target.closest('.form-check-input');
        // if (statusToggle) {
        //     e.preventDefault();
        //     const form = statusToggle.closest('form');
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: 'This will change resident status.',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#d33',
        //         cancelButtonColor: '#6c757d',
        //         confirmButtonText: 'Save',
        //         cancelButtonText: 'Cancel'
        //     }).then((result) => {
        //         if (result.isConfirmed) form.submit();
        //     });
        // } --}}
