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
                <h3 class="card-title">Update Product</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('product.update',['id'=>$product->id])}}"  enctype="multipart/form-data" >
                @csrf
                @method('put')
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="{{$product->prod_name}}" id="exampleInputEmail1" name="prod_name" placeholder="Enter Product name" required>
                    @error('prod_name')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description<span class="text-danger">*</span></label>
                    <textarea name="description" id="" class="form-control" required>{{$product->description}}</textarea>
                    @error('description')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Price<span class="text-danger"> Optional</span></label>
                            <input type="text" class="form-control" value="{{$product->old_price}}" id="exampleInputPassword1" name="old_price" placeholder="Enter old price">
                            @error('old_price')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Price<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value='{{$product->new_price}}' id="exampleInputPassword1" name="new_price" placeholder="Enter new price" required>
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
                            <select name="cat" id="" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if ($product->category == $category->id) selected @endif>{{$category->cat_name}}</option>
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
                            <select name="gender" id="" class="form-control" required>
                                <option value="men"  @if ($product->gender == "men") selected @endif>Men</option>
                                <option value="women" @if ($product->gender == "women") selected @endif>Women</option>
                                <option value="multiGender" @if ($product->gender == "multiGender") selected @endif>Multi-Gender</option>
                            </select>
                            @error('gender')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Provider<span class="text-danger">*</span></label>
                            <select name="provider" id="" class="form-control" required>
                                @foreach ($providers as $provider)
                                    <option value="{{$provider->id}}" @if ($product->provider == $provider->id) selected @endif>{{$provider->name}}</option>
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
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Status <span class="text-danger"> Optional</span></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{$product->prod_status}}" name="prod_status" placeholder="Enter Product Status">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Inventory <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="inventory" value="{{$product->inventory}}" required>
                            @error('inventory')
                            <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country Made <span class="text-danger"> Optional</span></label>
                    <select id="country" name="country" class="form-control">
                        <option value=""></option>
                        <option value="Brazil" @if ($product->country_made == 'Brazil') selected @endif>Brazil</option>
                        <option value="China" @if ($product->country_made == 'China') selected @endif>China</option>
                        <option value="Egypt" @if ($product->country_made == 'Egypt') selected @endif>Egypt</option>
                        <option value="Finland" @if ($product->country_made == 'Finland') selected @endif>Finland</option>
                        <option value="France" @if ($product->country_made == 'France') selected @endif>France</option>
                        <option value="Germany"@if ($product->country_made == 'Germany') selected @endif>Germany</option>
                        <option value="Indonesia" @if ($product->country_made == 'Indonesia') selected @endif >Indonesia</option>
                        <option value="India" @if ($product->country_made == 'India') selected @endif >India</option>
                        <option value="Ireland" @if ($product->country_made == 'Ireland') selected @endif >Ireland</option>
                        <option value="Italy" @if ($product->country_made == 'Italy') selected @endif >Italy</option>
                        <option value="Japan" @if ($product->country_made == 'Japan') selected @endif >Japan</option>
                        <option value="Jordan" @if ($product->country_made == 'Jordan') selected @endif >Jordan</option>
                        <option value="Pakistan" @if ($product->country_made == 'Pakistan') selected @endif >Pakistan</option>
                        <option value="Palestine" @if ($product->country_made == 'Palestine') selected @endif >Palestine</option>
                        <option value="Saudi Arabia" @if ($product->country_made == 'Saudi Arabia') selected @endif >Saudi Arabia</option>
                        <option value="Spain" @if ($product->country_made == 'Spain') selected @endif >Spain</option>
                        <option value="Sri Lanka" @if ($product->country_made == 'Sri Lanka') selected @endif >Sri Lanka</option>
                        <option value="Syria" @if ($product->country_made == 'Syria') selected @endif >Syria</option>
                        <option value="United Arab Erimates" @if ($product->country_made == 'United Arab Erimates') selected @endif >United Arab Emirates</option>
                        <option value="United States of America" @if ($product->country_made == 'United States of America') selected @endif >United States of America</option>
                        <option value="Turkey" @if ($product->country_made == 'Turkey') selected @endif >Turkey</option>
                     </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Related <span class="text-danger"> Optional</span></label>
                            <select name="prod_related" id="" class="form-control">
                              <option value=""></option>
                                @foreach ($related as $rel)
                                    <option value="{{$rel->id}}" @if ($product->prod_related == $rel->id) selected @endif>{{$rel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="U_product" class="btn btn-primary">Update Product</button>
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
        <h3 class="card-title">Product Images</h3>

        <div class="card-tools">
          <ul class="pagination pagination-sm float-right">
            
          </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table text-center">
          <thead>
            <tr>
              <th style="width:50%">Image</th>
              <th style="width:50%">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($images as $image)
            <tr>
              <td>
              <img src="../../img/Product_images/{{$image->image}}" width="80%" height="250" class="rounded" alt="">
              </td>
              <td>
              <form method="post" action="{{route('ad_product_provider_image.delete',['id'=>$image->id])}}" style="display: inline">
                  @csrf
                  @method('delete')
                  <button onclick="return confirm('Are you sure ?')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
              </form>
              </td>
            </tr>
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

  let color = $('#colors').val();
  let colorArr = color.split(',');
  var i=colorArr.length;

  function addColor(){
    colorArr[i] = $("#color").val();
    $("#color").val("");
    $('#colors').val(colorArr);
    $("#the_colors").html($('#colors').val());
    i++;
  }

  function remove_color(){
    for(var i=0; i<colorArr.length; i++){
      if(colorArr[i] == $('#color_text_remove').val()){
        colorArr.splice(i, 1);
        $('#colors').val(colorArr);
        $("#the_colors").html($('#colors').val());
        $('#color_text_remove').val('');
      }
    }
  }
  
</script>