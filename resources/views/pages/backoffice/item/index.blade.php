@extends('layouts.backoffice.main')

@section('container-backoffice')
    <style>
        .row-qr {
            border: 1px solid black;
        }

        .col-border-right {
            border-right: 1px solid black;
        }

        .col-border-top {
            border-top: 1px solid black;
        }

        #bodyPreviewQR {
            font-weight: 600;
            font-size: 14pt;
        }

        .sticker {
            width: 400px;
            height: 140px;
            background: white;
            position: relative;
            border: 3px solid #000;
            box-shadow:
                0 0 0 6px white,
                0 0 0 7px #000;
            font-family: Arial, sans-serif;
            margin: 20px auto;
            padding: 8px;
            /* Tambahkan padding 8px */
            box-sizing: border-box;
            /* Agar padding tidak menambah ukuran total */
        }

        .sticker-content {
            display: grid;
            grid-template-columns: 80px 1fr 80px;
            grid-template-rows: 1fr;
            height: 100%;
            position: relative;
            align-items: center;
        }

        .sticker-content::before,
        .sticker-content::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 1px;
            background-color: #000;
            z-index: 1;
        }

        .sticker-content::before {
            left: 80px;
        }

        .sticker-content::after {
            right: 80px;
        }

        .icon-column {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            height: 100%;
        }

        .bpsdm-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-column {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 15px;
            position: relative;
        }

        .text-column::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            height: 1px;
            background-color: #000;
            transform: translateY(-50%);
        }

        .text-top {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding-bottom: 8px;
        }

        .text-bottom {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding-top: 8px;
        }

        .bottom-text {
            font-size: 13px;
            color: #000;
            font-weight: bold;
            margin: 0;
        }

        .bottom-subtext {
            font-size: 9px;
            color: #000;
            margin: 3px 0 0 0;
            font-weight: normal;
        }

        .qr-column {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            height: 100%;
        }

        .qr-code {
            width: 65px;
            height: 65px;
            background: #000;
            position: relative;
            overflow: hidden;
        }

        .qr-pattern {
            width: 100%;
            height: 100%;
            background-image:
                repeating-linear-gradient(0deg, transparent, transparent 2px, #fff 2px, #fff 4px),
                repeating-linear-gradient(90deg, transparent, transparent 2px, #fff 2px, #fff 4px);
        }
    </style>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Daftar Barang</h5>
                            <div>
                                <a href="#" class="btn btn-primary me-2" id="btnBulkDownload">Unduh Semua QR</a>
                                <a href="/backoffice/add-item" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="tabel-data" class="table datatable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nomor Registrasi</th>
                                        <th>Nama Barang</th>
                                        <th>Cara Perolehan</th>
                                        <th>Tahun Perolehan</th>
                                        <th>Kondisi</th>
                                        <th>Pengguna Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td class="text-center" width="5%">{{ ++$key }}</td>
                                            <td>{{ $item->sub_sub_category_item->code }}</td>
                                            <td>{{ $item->registration_number }}</td>
                                            <td>{{ $item->sub_sub_category_item->name }}</td>
                                            <td>{{ $item->item_origin->name }}</td>
                                            <td>{{ $item->entry_year }}</td>
                                            <td>{{ $item->item_condition->name }}</td>
                                            <td>{{ $item->user }}</td>
                                            <td>{{ $item->price }}</td>

                                            <td width="20%">
                                                {{-- <a href="/backoffice/item/generate-qr/{{ $item->id }}" class="btn btn-sm btn-info">Generate QR</a> --}}
                                                <button type="button" class="btn btn-sm btn-info datatable-viewQR-btn"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-qr="{{ $item }}">
                                                    Generate QR
                                                </button>
                                                <a href="/backoffice/edit-item/{{ $item->id }}"
                                                    class="btn btn-sm btn-secondary">Edit</a>
                                                <form id="delete-item-{{ $item->id }}"
                                                    action="/backoffice/item/{{ $item->id }}" method="POST"
                                                    style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="btn btn-sm btn-danger"
                                                        onclick="deleteConfirm('delete-item-{{ $item->id }}')">Hapus</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Generate QR</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-2 text-center row-qr" id="bodyPreviewQR">
                            <div
                                class="col-lg-2 col-2 col-border-right d-flex justify-content-center align-items-center py-2">
                                <img src="{{ url('assets/images/logo-bpsdm.png') }}" alt="logo-bpsdm" width="100%">
                            </div>
                            <div class="col-lg-10 col-10 my-auto py-3">
                                <p>BADAN PENGEMBANGAN SUMBER DAYA MANUSIA</p>
                                <p>PROVINSI JAWA BARAT</p>
                            </div>
                            <div class="col-lg-8 col-12 text-start col-border-right col-border-top py-3">
                                <p id="previewQRCode">-</p>
                                <p id="previewQRName">-</p>
                                <p id="previewQRPopularName" class="mt-5"></p>
                            </div>
                            <div class="col-lg-4 col-12 col-border-top">
                                <div id="previewQR" class="mb-3 mt-4"></div>
                            </div>
                        </div>
                        <canvas id="canvas" hidden></canvas>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" class="btn btn-primary" id="downloadQR">Download</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Loading -->
        <div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content d-flex flex-column justify-content-center align-items-center text-center p-4">
                    <div class="spinner-border text-primary mb-3" role="status"></div>
                    <p class="mb-0">Unduh QR sedang berjalan...</p>
                </div>
            </div>
        </div>

        <!-- Modal Sukses -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4">
                    <div class="text-success mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 0 0-1.06-1.06L7.5 9.44 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z" />
                        </svg>
                    </div>
                    <h5>QR Berhasil Diunduh!</h5>
                    <button type="button" class="btn btn-success mt-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("btnBulkDownload").addEventListener("click", function(e) {
            e.preventDefault();

            const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
            loadingModal.show();

            const itemIDs = @json($data->pluck('id'));

            $.ajax({
                url: '/backoffice/items/generate-qr/bulk',
                type: 'GET',
                data: {
                    ids: itemIDs
                },
                success: function(res) {
                    console.log('✅ Sukses:', res);
                    const container = document.getElementById("bulkQRTemplate");
                    container.innerHTML = "";

                    res.data.forEach((item, index) => {
                        const div = document.createElement("div");
                        div.classList.add("qr-item");
                        div.innerHTML = `
                        <div style="width: 800px; background: white; border: 3px solid #000; box-shadow: 0 0 0 6px white, 0 0 0 7px #000; font-family: Arial, sans-serif; margin: 20px auto; display: flex; flex-direction: column;">
    
                            <!-- Header Section -->
                            <div style="display: flex; flex-direction: row; position: relative; height: 130px;">
                                
                                <!-- Logo Section -->
                                <div style="width: 24%; display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ url('assets/images/logo-bpsdm-long.png') }}" alt="logo-bpsdm" style="max-height: 88px;">
                                </div>
                                
                                <!-- Vertical Divider -->
                                <div style="width: 2px; background-color: #000; height: 100%; position: absolute; left: 24%; top: 0;"></div>
                                
                                <!-- Text Section -->
                                <div style="width: 76%; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 0 10px;">
                                    <p style="font-size: 21px; font-weight: bold; color: #000; margin: 0; line-height: 1.2;">BADAN PENGEMBANGAN SUMBER DAYA MANUSIA</p>
                                    <p style="font-size: 21px; font-weight: bold; color: #000; margin: 4px 0 0 0; line-height: 1.2;">PROVINSI JAWA BARAT</p>
                                </div>
                            </div>
                            
                            <!-- Horizontal Divider -->
                            <div style="width: 100%; height: 2px; background-color: #000;"></div>
                            
                            <!-- Content Section -->
                            <div style="display: flex; flex-direction: row; position: relative;">
                                
                                <!-- Left Section 80% - Employee Details -->
                                <div style="width: 70%; display: flex; flex-direction: column; justify-content: center; padding: 30px; text-align: left;">
                                    <p style="font-size: 20px; font-weight: bold; color: #000; margin: 0 0 12px 0;" id="previewQRCode">${item.code}</p>
                                    <p style="font-size: 24px; font-weight: bold; color: #000; margin: 0 0 16px 0;" id="previewQRName">${item.name}</p>
                                    <p style="font-size: 18px; color: #000; margin: 0; font-style: italic;" id="previewQRPopularName">${item.popular_name && item.popular_name.length > 120 ? item.popular_name.substring(0, 120) + '...' : item.popular_name}</p>
                                </div>
                                
                                <!-- Vertical Divider -->
                                <div style="width: 2px; background-color: #000; height: 100%; position: absolute; left: 70%; top: 0;"></div>
                                
                                <!-- Right Section 20% - QR Code -->
                                <div style="width: 30%; display: flex; justify-content: center; align-items: center; padding: 30px; min-height: 100px;">
                                    <div id="previewQR" style="width: 140px; height: 140px; display: flex; justify-content: center; align-items: center; border: 1px solid #ccc;">${item.data}</div>
                                </div>
                            </div>
                        </div>
                    `;
                        container.appendChild(div);
                    });

                    const elements = document.querySelectorAll("#bulkQRTemplate .qr-item");
                    const zip = new JSZip();
                    const imgFolder = zip.folder("QR_Codes");
                    let counter = 0;

                    elements.forEach((element, index) => {
                        html2canvas(element).then(canvas => {
                            canvas.toBlob(function(blob) {
                                imgFolder.file(`qr_${index + 1}.png`, blob);
                                counter++;

                                if (counter === elements.length) {
                                    zip.generateAsync({
                                        type: "blob"
                                    }).then(function(content) {
                                        saveAs(content, "qr_bulk.zip");

                                        loadingModal.hide();

                                        const successModal =
                                            new bootstrap.Modal(document
                                                .getElementById(
                                                    'successModal'));
                                        successModal.show();
                                    });
                                }
                            });
                        });
                    });
                },
                error: function(err) {
                    console.error('❌ Error:', err);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable({
                responsive: true
            });
        });

        $.ajaxSetup({
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.datatable-viewQR-btn', function(event) {
            event.preventDefault();
            const qr_data = $(this).data("qr");

            $('#previewQRCode').html(qr_data.sub_sub_category_item.code);
            $('#previewQRName').html(qr_data.sub_sub_category_item.name);
            $('#previewQRPopularName').html(`Nama Populer: ${qr_data.popular_name}`);

            $.ajax({
                type: 'GET',
                url: `/backoffice/json/qr-code/item/${qr_data.id}/`,
                success: function(response) {
                    const data = response.data

                    $('#previewQR').html(data);
                },
            });
        });


        deleteConfirm = function(formId) {
            console.log('klik')
            Swal.fire({
                icon: 'warning',
                text: 'Apakah Anda yakin akan menghapus data?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#e3342f',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endsection
