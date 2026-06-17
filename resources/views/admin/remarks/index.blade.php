@extends('layouts.admin')

@section('title', 'Remarks Management')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Remarks Management</h1>
        </div>

        @if ($message = Session::get('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </div>
            </div>
        @endif

        <!-- Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px space-x-8" role="tablist">
                    <button class="tab-button py-4 px-1 border-b-2 font-medium text-sm active" data-tab="weight-tab">
                        <span class="text-blue-600 border-blue-600">Weight Remarks</span>
                    </button>
                    <button class="tab-button py-4 px-1 border-b-2 font-medium text-sm" data-tab="thickness-tab">
                        <span class="text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300">Thickness Remarks</span>
                    </button>
                    <button class="tab-button py-4 px-1 border-b-2 font-medium text-sm" data-tab="moisture-tab">
                        <span class="text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300">Moisture Remarks</span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Weight Remarks Tab -->
        <div id="weight-tab" class="tab-content">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900">Weight Remarks</h2>
                    <button class="add-btn bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg" data-type="weight">
                        <i class="bi bi-plus mr-2"></i> Add Remark
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Remark Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($weightRemarks as $remark)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $remark->remark_name }}</td>
                                    <td class="px-6 py-4 text-sm font-medium space-x-2">
                                        <button class="edit-btn text-blue-600 hover:text-blue-900 font-medium" data-type="weight" data-id="{{ $remark->id }}" data-name="{{ $remark->remark_name }}" data-active="{{ $remark->is_active }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <form action="{{ route('remarks.destroy', ['type' => 'weight', 'id' => $remark->id]) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium delete-btn">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-gray-500">
                                        <i class="bi bi-inbox text-2xl mb-2 block opacity-50"></i>
                                        No weight remarks yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Thickness Remarks Tab -->
        <div id="thickness-tab" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900">Thickness Remarks</h2>
                    <button class="add-btn bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg" data-type="thickness">
                        <i class="bi bi-plus mr-2"></i> Add Remark
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Remark Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($thicknessRemarks as $remark)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $remark->remark_name }}</td>
                                    <td class="px-6 py-4 text-sm font-medium space-x-2">
                                        <button class="edit-btn text-blue-600 hover:text-blue-900 font-medium" data-type="thickness" data-id="{{ $remark->id }}" data-name="{{ $remark->remark_name }}" data-active="{{ $remark->is_active }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <form action="{{ route('remarks.destroy', ['type' => 'thickness', 'id' => $remark->id]) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium delete-btn">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-gray-500">
                                        <i class="bi bi-inbox text-2xl mb-2 block opacity-50"></i>
                                        No thickness remarks yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Moisture Remarks Tab -->
        <div id="moisture-tab" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900">Moisture Remarks</h2>
                    <button class="add-btn bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg" data-type="moisture">
                        <i class="bi bi-plus mr-2"></i> Add Remark
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Remark Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($moistureRemarks as $remark)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $remark->remark_name }}</td>
                                    <td class="px-6 py-4 text-sm font-medium space-x-2">
                                        <button class="edit-btn text-blue-600 hover:text-blue-900 font-medium" data-type="moisture" data-id="{{ $remark->id }}" data-name="{{ $remark->remark_name }}" data-active="{{ $remark->is_active }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <form action="{{ route('remarks.destroy', ['type' => 'moisture', 'id' => $remark->id]) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium delete-btn">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-gray-500">
                                        <i class="bi bi-inbox text-2xl mb-2 block opacity-50"></i>
                                        No moisture remarks yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="remarkModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Add Remark</h3>
            <button type="button" id="closeModal" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="remarkForm" method="POST">
            @csrf
            <input type="hidden" id="formType" name="type">
            <input type="hidden" id="formMethod" name="_method">
            <div class="px-6 py-4 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Remark Name *</label>
                    <input type="text" id="remarkName" name="remark_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="isActive" name="is_active" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="isActive" class="ml-2 block text-sm text-gray-700">Active</label>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" id="cancelBtn" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('remarkModal');
    const closeModal = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('remarkForm');
    const modalTitle = document.getElementById('modalTitle');
    const formType = document.getElementById('formType');
    const formMethod = document.getElementById('formMethod');
    const remarkName = document.getElementById('remarkName');
    const isActive = document.getElementById('isActive');
    const addBtns = document.querySelectorAll('.add-btn');
    const editBtns = document.querySelectorAll('.edit-btn');
    const deleteBtns = document.querySelectorAll('.delete-btn');
    const tabButtons = document.querySelectorAll('.tab-button');
    let currentEditId = null;

    // Tab switching
    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(b => {
                b.querySelector('span').classList.remove('text-blue-600', 'border-blue-600');
                b.querySelector('span').classList.add('text-gray-500', 'border-transparent');
            });
            document.getElementById(tabId).classList.remove('hidden');
            this.querySelector('span').classList.add('text-blue-600', 'border-blue-600');
            this.querySelector('span').classList.remove('text-gray-500', 'border-transparent');
        });
    });

    // Add button click
    addBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            openAddModal(type);
        });
    });

    // Edit button click
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const description = this.getAttribute('data-description');
            const active = this.getAttribute('data-active');
            openEditModal(type, id, name, description, active);
        });
    });

    function openAddModal(type) {
        currentEditId = null;
        modalTitle.textContent = 'Add ' + type.charAt(0).toUpperCase() + type.slice(1) + ' Remark';
        formType.value = type;
        formMethod.value = '';
        remarkName.value = '';
        isActive.checked = true;
        form.action = "{{ route('remarks.store') }}";
        form.method = 'POST';
        modal.classList.remove('hidden');
    }

    function openEditModal(type, id, name, description, active) {
        currentEditId = id;
        modalTitle.textContent = 'Edit ' + type.charAt(0).toUpperCase() + type.slice(1) + ' Remark';
        formType.value = type;
        formMethod.value = 'PUT';
        remarkName.value = name;
        isActive.checked = active == 1;
        const baseUrl = "{{ url('/admin/remarks') }}";
        form.action = baseUrl + '/' + type + '/' + id;
        modal.classList.remove('hidden');
    }

    closeModal.addEventListener('click', () => modal.classList.add('hidden'));
    cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));

    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.add('hidden');
    });

    // Delete confirmation with SweetAlert
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Delete Remark?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        if (formMethod.value === 'PUT') {
            this.method = 'POST';
        } else {
            this.method = 'POST';
        }
    });
});
</script>
@endsection
