@extends('admin.layout.main')
@section('title', 'Quản trị sửa sản phẩm')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Sửa sản phẩm</div>
                <form action="/admin/products/{{($product->id)}}" method="post" enctype="multipart/form-data">
                     @method('PUT')
                        @csrf
                    <div class="panel-body">
                        <div class="row" style="margin-bottom:40px">
                            @if (session()->has('add_product'))
                            <div class="alert bg-success" role="alert">
                                <svg class="glyph stroked checkmark">
                                    <use xlink:href="#stroked-checkmark"></use>
                                </svg>Đã thêm thành công<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>                        
                            @endif
                            @foreach ($errors->all() as $error)
                                <p class="bg bg-warning">{{$error}}</p>
                            @endforeach
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select name="category" class="form-control">
                                        <option value='1' selected>Nam</option>
                                        <option value='3'>---|Áo khoác nam</option>
                                        <option value='2'>Nữ</option>
                                        <option value='4'>---|Áo khoác nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mã sản phẩm</label>
                                    <input  type="text" name="code" class="form-control" value="SP01" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input  type="text" name="name" class="form-control" value="{{$product->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Giá sản phẩm (Giá chung)</label>
                                    <input  type="number" name="price" class="form-control" value="{{$product->price}}">
                                </div>
                                <div class="form-group">
                                    <label>Sản phẩm có nổi bật</label>
                                    <select  name="highlight" class="form-control">
                                        <option value="0" {{$product->name == 0 ? 'selected' : ''}}>Không</option>
                                        <option value="1" {{$product->name == 1 ? 'selected' : ''}}>Có</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                 <label>Trong kho</label>
                                 <input type="number" min="0" name="quantity" class="form-control" value="{{$product->quantity}}">
                             </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input id="img" type="file" name="avatar" class="form-control hidden"
                                onchange="changeImg(this)">
                                <img id="avatar" class="thumbnail" width="100%" height="350px" src="{{ ($product->avatar && $product->avatar !== "") ? $product->avatar : asset('manage/img/import-img.png') }}">
                            </div>
                        </div>
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thông tin</label>
                                    <textarea  name="info" style="width: 100%;height: 100px;"></textarea>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Miêu tả</label>
                                    <textarea id="editor"  name="describe" style="width: 100%;height: 100px;"></textarea>
                                </div>
                                <button class="btn btn-success" name="add-product" type="submit">Sửa sản phẩm</button>
                                <a class="btn btn-danger" type="reset">Huỷ bỏ</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--/.row-->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.js"></script>
<script>

    function changeImg(input){
    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
    if(input.files && input.files[0]){
        var reader = new FileReader();
        //Sự kiện file đã được load vào website
        reader.onload = function(e){
            //Thay đổi đường dẫn ảnh
            $('#avatar').attr('src',e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function() {
    $('#avatar').click(function(){
        $('#img').click();
    });
});
</script>
@endsection
