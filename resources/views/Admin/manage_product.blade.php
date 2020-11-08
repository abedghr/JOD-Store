<?php $guard = 'admin'; ?>
@include('Admin.includes.admin_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Products</h1>
          </div>
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('product.store')}}"  enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="prod_name" placeholder="Enter Product name">
                    @error('prod_name')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description<span class="text-danger">*</span></label>
                    <textarea name="description" id="" class="form-control"></textarea>
                    @error('description')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Price<span class="text-danger"> Optional</span></label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="old_price" placeholder="Enter old price">
                            @error('old_price')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Price<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="new_price" placeholder="Enter new price">
                            @error('new_price')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category<span class="text-danger">*</span></label>
                            <select name="cat" id="" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->cat_name}}</option>
                                @endforeach
                            </select>
                            @error('cat')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Gender<span class="text-danger">*</span></label>
                            <select name="gender" id="" class="form-control">
                                <option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="multiGender">Multi-Gender</option>
                            </select>
                            @error('phone2')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Provider<span class="text-danger">*</span></label>
                            <select name="provider" id="" class="form-control">
                                @foreach ($providers as $provider)
                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                @endforeach
                            </select>
                            @error('provider')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputFile">Product Main Image<span class="text-danger"> Optional</span></label>
                      <div class="input-group">
                          <div class="custom-file">
                          <input type="file" name="main_image" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputFile">Product Images<span class="text-danger"> Optional</span></label>
                      <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="images[]" multiple="multiple">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                          </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Status <span class="text-danger"> Optional</span></label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="prod_status" placeholder="Enter Product Status">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Product Colors <span class="text-danger"> Optional</span></label>
                    <input type="text" id="color" class="form-control" style="width:80%; display:inline">
                    <input type="hidden" name="colors" id="colors">
                    <a class="btn btn-warning" onclick="addColor()" style="margin-bottom:5px">+</a>
                  </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Availability <span class="text-danger"> Optional</span></label>
                            <select name="availability" id="" class="form-control">
                                <option value="1" class="text-success" selected>Available</option>
                                <option value="0"  class="text-danger">Un-available</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country Made <span class="text-danger"> Optional</span></label>
                    <select id="country" name="country" class="form-control">
                        <option value=""></option>
                        <option value="Brazil">Brazil</option>
                        <option value="China">China</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="India">India</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palestine">Palestine</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Syria">Syria</option>
                        <option value="United Arab Erimates">United Arab Emirates</option>
                        <option value="United States of America">United States of America</option>
                        <option value="Turkey">Turkey</option>
                     </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Related <span class="text-danger"> Optional</span></label>
                            <select name="prod_related" id="" class="form-control">
                                <option value=""></option>
                                @foreach ($related as $rel)
                                    <option value="{{$rel->id}}">{{$rel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>The COLORS :</label>
                    <div class="row">
                      <div class="col-md-6">
                        <p id="the_colors"></p>
                      </div>
                      <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Color name to delete" id="color_text_remove">
                      </div>
                      <div class="col-md-3">
                        <a class="btn btn-danger text-light" onclick="remove_color()">remove color</a>
                      </div>
                    </div>
                    
                  </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="C_product" class="btn btn-primary">Create Product</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</section>
<!-- /.col -->

<div class="col-md-12">
    <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title">Products List</h3>

        <div class="card-tools">
          <ul class="pagination pagination-sm float-right">
            {!! $products->links() !!}
          </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table text-center">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Old Price</th>
              <th>New Price</th>
              <th>Category</th>
              <th>Gender</th>
              <th>Provider</th>
              <th>Availability</th>
              <th style="width: 40px">Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php $i=1;?>
              
              @foreach ($products as $product)
              <tr>
                <td>
                <img src="../../storage/Product_images/{{$product->main_image}}" width="60" height="60" class="rounded-circle" alt="">
                </td>
                <td>{{$product->prod_name}}</td>
                <td class="text-danger"><del><strong>JD{{$product->old_price ? $product->old_price : 00}}</strong></del></td>
                <td class="text-success"><strong>JD{{$product->new_price}}</strong></td>
                <td>{{$product->cat->cat_name}}</td>
                <td>{{$product->gender}}</td>
                <td>{{$product->prov->name}}</td>
                <td>@if ($product->availability == 1)
                   <span class="text-success"><strong>Available</strong></span>
                @else
                   <span class="text-danger"><strong>Un-Available</strong></span>
                @endif </td>  
                <td style="width:200px;">
                <a href="{{route('admin_product.show',['id'=> $product->id])}}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                <a href="{{route('product.edit',['id'=> $product->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                <form method="post" action="{{route('product.destroy',['id'=>$product->id])}}" style="display: inline">
                    @csrf
                    @method('delete')
                <button onclick="return confirm('Are you sure ?')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </form>
                </td>
              </tr>
              <?php $i++; ?>
              @endforeach
              
              
              
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@include('Admin.includes.admin_footer')
<script>
  var i=0;
  let color =new Array();
  function addColor(){
    color[i] = $("#color").val();
    $("#color").val("");
    $('#colors').val(color);
    $("#the_colors").html($('#colors').val());
    i++;
  }

  function remove_color(){
    for(var i=0; i<color.length; i++){
      if(color[i] == $('#color_text_remove').val()){
        color.splice(i, 1);
        $('#colors').val(color);
        $("#the_colors").html($('#colors').val());
      }
    }
  }
  
</script>