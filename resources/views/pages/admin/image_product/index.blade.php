@extends('layouts.admin')

@section('title')
    LapakBuah.com ~ Dashboard Suppliers
@endsection

@section('content')
    <div class="section-content section-dashboard-home"
            data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Image Product</h2>
                <p class="dashboard-subtitle">Image Product yang akan menjadi icon di tampilan awal</p>
              </div>
              <div class="dashboard-content">
                {{-- @include('pages.role_management.navigasi_roles') --}}
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{ $message }}</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>{{ $message }}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box bg-white rounded shadow-sm p-3">
                            <div class="box-header">
                                <div class="box-title w-100 d-flex flex-row justify-content-between">
                                    <h3>List Image Product</h3>
                                    <!-- @can('supplier-create') -->
                                    <!-- @endcan -->
                                </div>
                                <a class="btn btn-success" href="{{ route('imageproduct.create') }}"> Add Category</a>
                            </div>
                            <hr>
                            <div class="box-body mt-3">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>no</th>
                                                <th>Product</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                
                                        @foreach ($data as $key => $image)
                                        <tbody>
                                   <tr>
                                     <td>{{ ++$i }}</td>
                                     <td>{{ $image->product->nama_product }}</td>
                                     <td><img src="{{ Storage::url($image->image) }}" class="img-fluid w-50"></td>
                                     <td>
                                        <!-- <a class="btn btn-info" href="{{ route('category.show',$image->id) }}">Show</a> -->
                                        <a class="btn btn-primary" href="{{ route('imageproduct.edit',$image->id) }}">Edit</a>
                                        <a class="btn btn-danger" href="{{ route('imageproduct.destroy',$image->id) }}">Hapus</a>
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
        </div>
    </div>
@endsection
@push('addon-script')
<script>
   // AJAX DataTable
//    var datatable = $('#crudTable').DataTable({
//             processing: true,
//             serverSide: true,
//             ordering: true,
//             responsive: true,
//             autoWidth : true,
//             ajax: {
//                 url: '{!! url()->current() !!}',
//             },
//             columns: [
//                 { data: 'DT_RowIndex', name:'DT_RowIndex'},
//                 { data: 'image_category', name: 'image_category' },
//                 { data: 'name_category', name: 'name_category' },
//                 { data: 'slug', name: 'slug' },
//                 {
//                     data: 'action',
//                     name: 'action',
//                     orderable: false,
//                     searchable: false,
//                     width: '15%'
//                 },
//             ]
//         });
        </script>
        @endpush