@extends('admin.layout.main')
@section('title', 'Quản trị danh mục sản phẩm')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#"><svg class="glyph stroked home">
					<use xlink:href="#stroked-home"></use>
				</svg></a></li>
		<li class="active">Danh mục</li>
	</ol>
</div>
<!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Quản lý danh mục</h1>
	</div>
</div>
<!--/.row-->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
{{-- 				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Danh mục cha:</label>
							<select class="form-control" name="" id="">
								<option>----ROOT----</option>
								<option>Nam</option>
								<option>---|Áo khoác nam</option>
								<option>---|---|Áo khoác nam</option>
								<option>Nữ</option>
								<option>---|Áo khoác nữ</option>
							</select>
						</div> --}}
{{-- 						<div class="form-group">
							<label for="">Tên Danh mục</label>
							<input type="text" class="form-control" name="name" id="" placeholder="Tên danh mục mới">

							<div class="alert bg-danger" role="alert">
								<svg class="glyph stroked cancel">
									<use xlink:href="#stroked-cancel"></use>
								</svg>Tên danh mục đã tồn tại!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
							</div>
						</div> --}}
						<a href="{{ route('create.category') }}" class="btn btn-primary">Thêm danh mục</a>
{{-- 					</div> --}}
					<div class="col-md-12">
						{{-- <div class="alert bg-success" role="alert">
							<svg class="glyph stroked checkmark">
								<use xlink:href="#stroked-checkmark"></use>
							</svg> Đã thêm danh mục thành công! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
						</div> --}}
						<h3 style="margin: 0;"><strong>Phân cấp Menu</strong></h3>
						<div class="vertical-menu">
							<div class="item-menu active">Danh mục </div>
							{{-- start categories --}}
							@if ($categories->count() > 0)
							@foreach ($categories as $category)
								<div class="item-menu"><span>{{$category->name}}</span>
									<div class="category-fix">
										<a class="btn-category btn-primary" href="/admin/categories/{{$category->id}}/edit"><i class="fa fa-edit"></i></a>
										<a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
									</div>
								</div>
								@php
										if (!is_null($category->sub)) {
											printSubCategories($category->sub,1);
										}
	
								@endphp
							
							@endforeach
								
							@endif
							{{-- <div class="item-menu"><span>Nam</span>
								<div class="category-fix">
									<a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
									<a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
								</div>
							</div>
							<div class="item-menu"><span>---|Áo khoác Nam</span>
								<div class="category-fix">
									<a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
									<a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

								</div>
							</div>
							<div class="item-menu"><span>---|---|Áo khoác Nam (Dành cho việc mở rộng)</span>
								<div class="category-fix">
									<a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
									<a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

								</div>
							</div>
							<div class="item-menu"><span>Nữ</span>
								<div class="category-fix">
									<a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
									<a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

								</div>
							</div>
							<div class="item-menu"><span>---|Áo khoác Nữ</span>
								<div class="category-fix">
									<a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
									<a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
								</div>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/.col-->


</div>
<!--/.row-->
</div>
<!--/.main-->
@stop

@php
	function printSubCategories($categories,$nth) {
		foreach ($categories as $category) {
			echo '
				<div class="item-menu"><span>'.printMark($nth).$category->name.'</span>
					<div class="category-fix">
						<a class="btn-category btn-primary" href="/admin/categories/'.$category->id.'/edit"><i class="fa fa-edit"></i></a>
						<a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
					</div>
				</div>
			';
			if(!is_null($category->sub))
			{
				printSubCategories($category->sub, $nth + 1);
			}
		}
	}

	function printMark($time)
	{  $mark = "";
		for($i = 0; $i< $time; $i++)
		{
			$mark .= '---|';
		}
		return $mark;
	}
@endphp