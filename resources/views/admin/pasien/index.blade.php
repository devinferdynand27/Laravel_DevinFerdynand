@extends('layouts.app')
@section('content')
    @php
        use App\Models\Mstr_Hospital;
        $mstr_Hospital = Mstr_Hospital::orderBy('created_at', 'asc')->get();
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <h4 class="fw-bold py-3 mb-0">Data Pasien</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pasien</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-primary" style="background: rgb(0, 153, 255);"
                    style="background: rgb(0, 153, 255); border:0" data-bs-toggle="modal" data-bs-target="#modalCenter">
                    Tambah
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-header mb-0 me-3">Pasien</h5>
                <select name="id_hospital" id="id_hospital" class="form-select" style="width: 200px;">
                    <option value="">-- pilih --</option>
                    @foreach ($mstr_Hospital as $item)
                        <option value="{{ $item->id }}">{{ $item->hospital_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="hospital-table">
                    <thead>
                        <tr>
                            <th>Hospital Name</th>
                            <th>patient's name</th>
                            <th>Address</th>
                            <th>Telephone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="patient_name" class="form-label">Pasien Name</label>
                            <input type="text" id="patient_name" class="form-control" placeholder="Enter Name Pasien" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="" class="form-label">Hospital Name</label>
                            <select name="hospital_id" id="hospital_id" class="form-control">
                                <option value="">--Filter --</option>
                                @foreach ($mstr_Hospital as $item)
                                    <option value="{{ $item->id }}">{{ $item->hospital_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="pasien_address" class="form-label">Pasien Address</label>
                            <input type="text" id="pasien_address" class="form-control" placeholder="Pasien Address" />
                        </div>
                        <div class="col mb-0">
                            <label for="phone_number" class="form-label">Telephone</label>
                            <input type="text" id="phone_number" class="form-control" placeholder="+62" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" style="background: rgb(0, 153, 255);"
                        id="savePasien">Save changes</button>
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
                    <h5 class="modal-title">Pasient detail Details</h5>
                    <div class="row mt-5">
                        <div class="col mb-3">
                            <label class="form-label">patient_name</label>
                            <p id="showPasienName" class="form-control-plaintext"></p>
                            <hr>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="form-label">Address</label>
                            <p id="showPasienAddress" class="form-control-plaintext"></p>
                            <hr>
                        </div>
                        <div class="col mb-0">
                            <label class="form-label">Telephone</label>
                            <p id="showPasienPhoneNumber" class="form-control-plaintext"></p>
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
                            {{-- <label class="form-label">Patient's Name</label> --}}
                            <input type="text" id="id" class="form-control" hidden />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Patient's Name</label>
                            <input type="text" id="editPasienName" class="form-control" placeholder="Pasien Name" />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Patient's Address</label>
                            <input type="text" id="editHospitalAddress" class="form-control" placeholder="Address" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="form-label">Patient's Number</label>
                            <input type="text" id="editPhoneNumber" class="form-control"
                                placeholder="Phone Number  " />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="" class="form-label">Hospital Name</label>
                            <select name="hospitalSelect" id="hospitalSelect" class="form-control">

                            </select>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" style="background: rgb(0, 153, 255);"
                        id="updatePasien">Save changes</button>
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
                // processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                info: false,
                "ajax": {
                    "url": "{{ route('pasien.index') }}",
                    data: function(d) {
                        var id_hospital = $("[name='id_hospital']").val();
                        d.id_hospital = id_hospital;
                    }
                },
                columns: [{
                        data: 'hospital_id',
                        name: 'hospital_id'
                    },
                    {
                        data: 'patient_name',
                        name: 'patient_name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });

            $("[name='id_hospital']").on('change', function() {
                var id_hospital = $('#id_hospital').val();
                table.ajax.reload();
                console.log(id_hospital)
            })

            function deleteItem(id) {
                $.ajax({
                    url: "{{ route('pasien.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Data Tidak Bisa Di Hapus');
                        console.error(xhr.responseText);
                    }
                });
            }


            $('#savePasien').on('click', function() {
                var patient_name = $('#patient_name').val();
                var hospital_id = $('#hospital_id').val();
                var pasien_address = $('#pasien_address').val();
                var phone_number = $('#phone_number').val();

                $.ajax({
                    url: "{{ route('pasien.store') }}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        patient_name: patient_name,
                        address: pasien_address,
                        phone_number: phone_number,
                        hospital_id: hospital_id,
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



            window.showItem = function(id) {
                $.ajax({
                    url: "{{ route('pasien.show', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function(data) {
                        $('#showHospitalName').text(data.hospital.hospital_name);
                        $('#showPasienName').text(data.patient_name);
                        $('#showPasienAddress').text(data.address);
                        $('#showPasienPhoneNumber').text(data.phone_number);

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
                    url: "{{ route('pasien.edit', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        // Populate fields with patient data
                        $('#id').val(response.id);
                        $('#editPasienName').val(response.patient_name);
                        $('#editHospitalAddress').val(response.address);
                        $('#editPhoneNumber').val(response.phone_number);

                        // Populate select dropdown with hospital options
                        var hospitalOptions = response.hospitalOptions;
                        var selectOptions = '';

                        // Iterate over hospitalOptions to create <option> elements
                        hospitalOptions.forEach(function(hospital) {
                            var selected = '';
                            if (hospital.id == response.hospital_id) {
                                selected = 'selected';
                            }
                            selectOptions += '<option value="' + hospital.id +
                                '" ' +
                                selected + '>' + hospital.hospital_name +
                                '</option>';
                        });


                        $('#hospitalSelect').html(selectOptions);

                        $('#updatePasien').off('click').on('click', function() {
                            var id = $('#id').val();
                            var editPasienName = $('#editPasienName').val();
                            var editHospitalAddress = $('#editHospitalAddress').val();
                            var editPhoneNumber = $('#editPhoneNumber').val();
                            var hospitalSelect = $('#hospitalSelect').val();



                            $.ajax({
                                url: "{{ route('pasien.update', ':id') }}".replace(
                                    ':id', id),
                                type: 'PUT',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr('content')
                                },
                                data: {
                                    id: id,
                                    patient_name: editPasienName,
                                    address: editHospitalAddress,
                                    phone_number: editPhoneNumber,
                                    hospital_id: hospitalSelect
                                },
                                success: function(response) {
                                    var editModal = bootstrap.Modal.getInstance(
                                        document.getElementById('editModal')
                                        );
                                    editModal.hide();
                                    table.ajax.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error(
                                        'Error dalam permintaan Ajax:',
                                        error);
                                    $('#editModal').find('.modal-body').html(
                                        '<div class="alert alert-danger">Terjadi kesalahan saat memperbarui data</div>'
                                    );
                                }
                            });
                        });


                        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                        editModal.show();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error dalam permintaan Ajax:', error);
                        $('#editModal').find('.modal-body').html(
                            '<div class="alert alert-danger">Terjadi kesalahan saat mengambil data</div>'
                        );
                    }
                });
            };
            window.deleteItem = deleteItem;
        });
    </script>
@endsection
z