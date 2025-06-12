@extends('layouts.app')

@section('content')



<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h2 class="mb-0">Manage Residents</h2>
            <div class="d-flex align-items-center" style="gap: 0.75rem;">
                <div class="position-relative">
                     @php
    $notifications = auth()->user()?->unreadNotifications ?? collect();
    @endphp
                    <button id="notificationButton" class="btn btn-light position-relative">
                          <i class="fas fa-bell"></i>
                        @if($notifications->count())
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $notifications->count() }}
                            </span>
                        @endif
                    </button>
                    <div id="notificationDropdown" class="hidden position-absolute mt-2" style="right:0; min-width: 16rem; z-index: 1050;">
                        <div class="bg-white shadow rounded border">
                            <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                                <span class="fw-semibold">Notifications</span>
                                <button id="closeNotificationDropdown" class="btn btn-sm btn-link text-secondary p-0 fs-5">&times;</button>
                            </div>
                            <div style="max-height: 250px; overflow-y: auto;">
                                @forelse($notifications as $notification)
                                    <div class="px-3 py-2 border-bottom last:border-bottom-0">
                                        {{ $notification->data['message'] }}
                                    </div>
                                @empty
                                    <div class="p-3 text-sm text-secondary">No notifications</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('residents.create') }}"
                   class="btn btn-primary btn-sm btn-add"
                   title="Add Resident">
                    <i class="fas fa-pen-to-square me-1"></i> Add Resident
                </a>
            </div>
        </div>
        {{-- ...rest of your code... --}}
<script>
   const notificationButton = document.getElementById('notificationButton');
    const notificationDropdown = document.getElementById('notificationDropdown');
    const closeNotificationDropdown = document.getElementById('closeNotificationDropdown');
    const badge = document.querySelector('#notificationButton span');

    // Show dropdown on bell click
    notificationButton.addEventListener('click', function () {
        notificationDropdown.classList.toggle('hidden');
    });

    // Close dropdown and mark all as read on close button click
    closeNotificationDropdown.addEventListener('click', function () {
        notificationDropdown.classList.add('hidden');
        // Mark all as read via AJAX
        fetch("{{ route('notifications.markAllRead') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }
        }).then(response => {
            if (response.ok && badge) {
                badge.style.display = 'none';
            }
        });
    });
</script>






















        </div>


 @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif




   <div class="card-body">
            {{-- DataTable --}}
            {{-- {{ $dataTable->table([
                'id' => 'residents-table',
                'class' => 'table table-hover table-bordered table-striped table-sm align-middle text-center'
            ], true) }} --}}

{{ $dataTable->table(['class' => 'table table-striped table-hover align-middle text-center w-100'], true) }}
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


// document.querySelectorAll('.close-notif').forEach(btn => {
//     btn.addEventListener('click', function() {
//         const notifId = this.getAttribute('data-id');
//         fetch('/notifications/' + notifId + '/read', {
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
//             }
//         }).then(() => {
//             document.getElementById('notif-' + notifId).remove();
//         });
//     });
// });







    </script>
@endpush
{{--
@if(auth()->check())
    @foreach(auth()->user()->unreadNotifications as $notification)
        <div class="resident-notification" id="notif-{{ $notification->id }}">
            {{ $notification->data['message'] }}
            <button class="close-notif" data-id="{{ $notification->id }}">&times;</button>
        </div>
    @endforeach
@endif --}}

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
