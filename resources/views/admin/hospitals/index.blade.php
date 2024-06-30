@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <h4 class="fw-bold py-3 mb-0">Data Hospitals</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Hospital</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button"  class="btn btn-primary" style="background: rgb(0, 153, 255); border:0" data-bs-toggle="modal" data-bs-target="#modalCenter">
                    Tambah
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-header mb-0 me-3">Hospital</h5>
                {{-- <select name="" id="" class="form-select" style="width: 200px;">
                    <option value="">Devin Ferdynand</option>
                </select> --}}
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="hospital-table">
                    <thead>
                        <tr>
                            <th>Hospital Name</th>
                            <th>Address</th>
                            <th>E-mail</th>
                            <th>Telephone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated by DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add Hospital</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="hospitalName" class="form-label">Hospital Name</label>
                            <input type="text" id="hospitalName" class="form-control" placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="hospitalAddress" class="form-label">Hospital Address</label>
                            <input type="text" id="hospitalAddress" class="form-control" placeholder="Enter Address" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="hospitalEmail" class="form-label">Email</label>
                            <input type="email" id="hospitalEmail" class="form-control" placeholder="xxxx@xxx.xx" />
                        </div>
                        <div class="col mb-0">
                            <label for="hospitalPhone" class="form-label">Telephone</label>
                            <input type="text" id="hospitalPhone" class="form-control" placeholder="+62" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" style="background: rgb(0, 153, 255);" class="btn btn-primary" id="saveHospital">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hospital Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Hospital Name</label>
                            <p id="showHospitalName" class="form-control-plaintext"></p>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Hospital Address</label>
                            <p id="showHospitalAddress" class="form-control-plaintext"></p>
                            <hr>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="form-label">Email</label>
                            <p id="showHospitalEmail" class="form-control-plaintext"></p>
                            <hr>
                        </div>
                        <div class="col mb-0">
                            <label class="form-label">Telephone</label>
                            <p id="showHospitalPhone" class="form-control-plaintext"></p>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hospital Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Hospital Name</label>
                            <input type="text" id="editHospitalName" class="form-control"
                                placeholder="Hospital Name" />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Hospital Address</label>
                            <input type="text" id="editHospitalAddress" class="form-control" placeholder="Address" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="form-label">Email</label>
                            <input type="text" id="editHospitalEmail" class="form-control" placeholder="E-mail" />
                        </div>
                        <div class="col mb-0">
                            <label class="form-label">Telephone</label>
                            <input type="text" id="editHospitalPhone" class="form-control" placeholder="E-mail" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" style="background: rgb(0, 153, 255);" class="btn btn-primary" id="updateHospital">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Masukkan jQuery dan jQuery DataTables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        jQuery(function($) {
            var table = $('#hospital-table').DataTable({
                processing:false,
                serverSide: true,
                searching: false,
                paging: false,
                info: false,
                ajax: "{{ route('hospital.index') }}",
                columns: [{
                        data: 'hospital_name',
                        name: 'hospital_name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'telephone',
                        name: 'telephone'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });

            $('#saveHospital').on('click', function() {
                var hospitalName = $('#hospitalName').val();
                var hospitalAddress = $('#hospitalAddress').val();
                var hospitalEmail = $('#hospitalEmail').val();
                var hospitalPhone = $('#hospitalPhone').val();

                $.ajax({
                    url: "{{ route('hospital.store') }}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        hospital_name: hospitalName,
                        address: hospitalAddress,
                        email: hospitalEmail,
                        telephone: hospitalPhone
                    },
                    success: function(response) {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#modalCenter').removeClass('show');
                        $('#modalCenter').attr('aria-hidden', 'true');
                        $('#modalCenter').css('display', 'none');
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat menambahkan data');
                        console.error(xhr.responseText);
                    }
                });
            });

            function deleteItem(id) {
                $.ajax({
                    url: "{{ route('hospital.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat menghapus data');
                        console.error(xhr.responseText);
                    }
                });
            }
            window.showItem = function(id) {
                $.ajax({
                    url: "{{ route('hospital.show', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function(data) {
                        $('#showHospitalName').text(data.hospital_name);
                        $('#showHospitalAddress').text(data.address);
                        $('#showHospitalEmail').text(data.email);
                        $('#showHospitalPhone').text(data.telephone);


                        var showModal = new bootstrap.Modal(document.getElementById('showModal'));
                        showModal.show();
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat mengambil data');
                        console.error(xhr.responseText);
                    }
                });
            }
            window.editItem = function(id) {
                $.ajax({
                    url: "{{ route('hospital.edit', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function(data) {
                        $('#editHospitalName').val(data.hospital_name);
                        $('#editHospitalAddress').val(data.address);
                        $('#editHospitalEmail').val(data.email);
                        $('#editHospitalPhone').val(data.telephone);


                        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                        editModal.show();

                        $('#updateHospital').off('click').on('click', function() {
                            var hospitalName = $('#editHospitalName').val();
                            var hospitalAddress = $('#editHospitalAddress').val();
                            var hospitalEmail = $('#editHospitalEmail').val();
                            var hospitalPhone = $('#editHospitalPhone').val();

                            $.ajax({
                                url: "{{ route('hospital.update', ':id') }}"
                                    .replace(':id', id),
                                type: 'PUT',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr(
                                        'content'),
                                    hospital_name: hospitalName,
                                    address: hospitalAddress,
                                    email: hospitalEmail,
                                    telephone: hospitalPhone
                                },
                                success: function(response) {
                                    editModal.hide();
                                
                                    table.ajax.reload();
                                },
                                error: function(xhr, status, error) {
                                    alert(
                                        'Terjadi kesalahan saat memperbarui data'
                                        );
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat mengambil data');
                        console.error(xhr.responseText);
                    }
                });
            }

            window.deleteItem = deleteItem;
        });
    </script>
@endsection
