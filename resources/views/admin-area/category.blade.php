@extends('layouts.admin_layout')
@section('content')

<div class="container-fluid " style="padding-top: 40px">

  <div class="row mb-3 ml-1">
    <button type="button" class="btn cus-b" data-toggle="modal" data-target="#exampleModal" id="add_main_button">
     Add category
    </button>
  </div>
 
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger err" role="alert">
           
          </div>
          <form  enctype="multipart/form-data" id="category_form">
            <div class="form-group">
              <label for="formGroupExampleInput">Category Name</label>
              <input type="text" class="form-control" id="" placeholder="Category name" name="category_name" >
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" id="csrf">
            <div class="form-group">
              <label for="exampleFormControlFile1">Example file input</label>
              <input type="file" class="form-control-file" id="file" name="file">
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <input type="submit" class="btn cus-b ed" id="add_category" value="submit" data-sub = "submit"/>
        </div>
      </form>
      </div>
    </div>
  </div>




<div class="row">
  <div class="col-12">
    <div class="card "  >
      <div class="card-header ">
        <h2 class="card-title">Category</h2>

        
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0" >
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category Name</th>
              <th>Slug</th>
              <th>Icon</th>
     
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody id="category_table_list">
            @if(count($category)>0)
            @foreach ($category as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->category}}</td>
              <td>{{$item->slug}}</td>
              <td>@if($item->icon)<img src="{{asset('img/category/'.$item->icon.'')}}" style="width:100px"/>@else<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASkAAACqCAMAAADGFElyAAAAMFBMVEX09PTMzMz39/fOzs7w8PDQ0NDz8/PW1tbo6OjJycns7Ozl5eXh4eHZ2dnf39/T09MBTNBqAAAB5klEQVR4nO3b3W6iUBSAUX5FQJ33f9sRRQQ61IM3JLPXuqK2JPJlY07wNMsAAAAAAAAAAAAAAAAAAAAAACCaYr+j3/Ixuqbe69od/aYPUFzafL/2Em+sum9C3VOFm6qiuV92udOQqok2VMX9sssqO+1S3UvV4UoNI7X3ooe8SiWdFLxUkXVdlXZS8FK3Mm/z+pxQIHipP+24Uko4KXSpW5u+UgpdqnovKj+vlEKXOr+X6vVp/UfV6oM+dKn+Xapcl6rKcpkqdKlfZqoauixShS51KqdS12WD6vGbxVSFLvV++NIu77SqHidt9nLoUlnRjOupfpGgmmZtNlWxS2VFX7dt2XQboeZTFbxUNqwGTqvPqHr+9G5KpdTafKIexlRKrfwI9fqsUur5yutgeevNUyk1/HxrxqOfEzXdgEo9llXt9XH0r4l6TZVSz/VnOzxM2AqVt2elpoX6PdXGrafUeHx51Wi2Jkqpx2HS9+5KpW5QUCp1J0f4UslbXsKXOqdueQlfqlfqA6VSKZVKqVRKpZq+xapSnYKX2ndSyFKlUmmGi8675Fvvqcsjlhp2WeebT6O2XaOV+nrnftqO0P9Kn3/Tqj/6bR+hujV73QJO1MA/rQEAAAAAAAAAAAAAAAAAAAAAwGd/AdrYE2FI58bQAAAAAElFTkSuQmCC" style="width:100px "/>@endif</td>
             <td><a href = "#" class="btn cus-b "  id="edit_category" data-toggle="modal" data-target="#exampleModal" data-id="{{$item->id}}"><i class="fa fa-indent text-white" aria-hidden="true"></i></a></td>
              <td><a href="#" class="btn cus-b" data-id="{{$item->id}}" id="delete_category" ><i class="fa fa-trash text-white" aria-hidden="true" ></i></a></td>
            </tr>
            @endforeach
             
            @endif
            
            
          
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>





</div>
@endsection
@section('scripts')
<script src="{{asset('js/category_handling.js')}}"></script>
@endsection