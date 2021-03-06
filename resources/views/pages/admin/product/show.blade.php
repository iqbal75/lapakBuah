@extends('layouts.admin')

@section('title')
    LapakBuah.com ~ Dashboard Product
@endsection

@push('addon-style')
  <style>
    #tommbol_add_image{
      background: rgba(0, 255, 34, 0.562);
    }
    #tommbol_add_image:hover{
      background: rgba(0, 209, 0, 0.411);
    }
  </style>
@endpush

@section('content')
    <div class="section-content section-dashboard-home"
            data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product Detail</h2>
                <p class="dashboard-subtitle">Product yang akan menjadi icon di Halaman utama</p>
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
                <div class="row mt-4 mb-5">
                  <div class="col">
                    <div class="box bg-white rounded shadow-sm p-3">
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table">
                            <tr>
                              <td width="20%">
                                Nama product
                              </td>
                              <td>:</td>
                              <td>
                                {{ $data->nama_product }}
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Category
                              </td>
                              <td>:</td>
                              <td>
                                {{ $data->category->name_category }}
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Slug
                              </td>
                              <td>:</td>
                              <td>
                                {{ $data->slug }}
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Deskripsi Product
                              </td>
                              <td>:</td>
                              <td>
                                {!! $data->description !!}
                              </td>
                            </tr>
                          </table>
                          <div class="col-md-12" align="right">
                        <a  href="{{ route('typeproduct.create') }}" role="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Type Product </a> 
                        </div>    
                        </div>
                      </div>
                      <div class="row mt-5">
                      <table class="table">
                    <thead>
                      <td>Type Product</td>
                      <td>Satuan</td>
                      <td>Harga Jual</td>
                      <td>Berat</td>
                      <td>Stok</td>
                    </thead>
                    @foreach ($data->typeproduct as $type)  
                    <tbody>
                    <td>{{ $type->type_products }}</td>
                    <td>{{ $type->satuan }}</td>
                    <td>{{ $type->harga_jual }}</td>
                    <td>{{ $type->berat }}</td>
                    <td>{{ $type->qty }}</td>
                  </tbody>  
                  @endforeach    
                    </table>
                        <div class="col-md-12">
                          <div class="box p-3 bg-light rounded">
                          <div class="row">

                            @forelse ($data->imageproduct as $item)
                            
                              <div class="col-md-3 mt-2">
                                <div class="box">
                                  <div class="portfolio-wrap">
                                  <img src="{{ Storage::url($item->image) }}" class="img-fluid" alt="">
                                  <div class="portfolio-info">
                                    <div class="portfolio-links">
                                      <a href="{{ Storage::url($item->image) }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Product Image"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                      <form action="{{ route('imageproduct.destroy',$item->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return comfirm('Are you sure?')" title="More Details"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                </div>
                              </div>
                               

                            @empty
                            <div class="dek" id="image_preview">
                              
                            </div>
                            @endforelse
                            <div class="col-md-3 mt-2">
                                <div class="box rounded d-flex flex-row justify-content-center" id="tommbol_add_image"  style="height: 150px">
                                  <div class="isi-box mt-auto mb-auto text-center text-white">
                                    <i class="fa fa-plus" style="font-size: 20px" aria-hidden="true"></i>
                                    <p class="font-weight-bolder">Tambah Gambar</p>
                                  </div>
                                </div>
                              </div> 
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <form action="{{ route('imageproduct.store') }}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  <input type="hidden" name="product_id" value="{{ $data->id }}">
                                  <input type="file" name="image[]" id="upload_file" onchange="preview_image();" multiple="multiple" style="display: none">
                                  <input type="submit" class="btn btn-success mt-3" value="Upload"/>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
      </div>
    </div>
  </div>
  @endsection
<!-- Modal
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
@push('addon-script')

@push('addon-script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.js"></script>
  <script>
    document.getElementById("tommbol_add_image").onclick = function () {
      document.getElementById("upload_file").click();
    };
  </script>
  <script>
    // $(document).ready(function() 
    // { 
    //   $('form').ajaxForm(function() 
    //   {
    //     alert("Uploaded SuccessFully");
    //   }); 
    // });

    function preview_image() 
    {
      var total_file=document.getElementById("upload_file").files.length;
      for(var i=0;i<total_file;i++)
      {
        $('#image_preview').prepend("<div class='col-md-3 mt-2'><img class='w-100' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
      }
    }
  </script>
@endpush