<div class="d-flex align-items-center gap-2">

    {{-- Edit Button --}}
    <a href="{{ route('residents.edit', $resident->id) }}"
       class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center"
       title="Edit">
        <i class="fas fa-pen-to-square me-1"></i>
    </a>
{{-- View Button --}}
<a href="{{ route('residents.show', $resident->id) }}"
   class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center"
   title="View">
    <i class="fas fa-eye"></i>
</a>


  {{-- view Button --}}



{{-- Delete Button --}}
{{-- <form action="{{ route('residents.destroy', $resident->id) }}"
      method="POST"
     >
    @csrf
    @method('DELETE')
    <button type="submit"
           class="btn btn-outline-danger btn-delete"
            title="Delete">
        <i class="fas fa-trash-alt me-1"></i>
    </button>
</form> --}}
<form action="{{ route('residents.destroy', $resident->id) }}"
      method="POST"
      class="m-0 p-0">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center btn-delete"
            title="Delete">
        <i class="fas fa-trash-alt me-1"></i>
    </button>
</form>



    {{-- Toggle Status Switch --}}
    <form action="{{ route('residents.toggleStatus', $resident->id) }}"
          method="POST"
          class="m-0"
          title="Toggle Status">
        @csrf
        <div class="form-check form-switch d-flex align-items-center m-0">
            <input
                class="form-check-input"
                type="checkbox"
                name="status_toggle"
                onchange="this.form.submit()"
                {{ $resident->status === 'active' ? 'checked' : '' }}
                title="Toggle Status">
        </div>
    </form>

</div>
