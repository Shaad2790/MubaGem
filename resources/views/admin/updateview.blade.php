<!DOCTYPE html>
<html lang="en">
  <head>
   
    <base href="/public">

        @include('admin.css')


        <style type="text/css">
            .title
            {
                color:white; 
                padding: 25px; 
                font-size: 25px;
            }

            label
            {
                display: inline-block;
                width: 200px;
            }

        </style>


  </head>
  <body>
    
        @include('admin.sidebar')
      
      <!-- partial -->
      
        @include('admin.navbar')

        <!-- partial -->
         
        <div class="container-fluid page-body-wrapper">
            <div class="container" align="center">
            <h1 class="title">Add Gem</h1>

            

            
            @if(session()->has('messege'))

            <div class="alert alert-success">


            <button type="button" class="close" data-dismiss="alert">x</button>

            {{session()->get('messege')}}

            </div>

            @endif



<form action="{{url('updateproduct',$data->id)}}" method="post" enctype="multipart/form-data">

@csrf

        <div style="padding:15px;">
            <label>Gem Title</label>
            <input style="color:black;" type="text" name="title" value="{{$data->title}}" required="">
        </div>

        <div style="padding:15px;">
            <label>Price</label>
            <input style="color:black;" type="number" name="price" value="{{$data->price}}" required="">
        </div>

        <div style="padding:15px;">
            <label>Type</label>
            <input style="color:black;" type="text" name="image" value="{{$data->type}}" required="">
        </div>

        <div style="padding:15px;">
            <label>Carat</label>
            <input style="color:black;" type="text" name="carat" value="{{$data->carat}}" required="">
        </div>

        <div style="padding:15px;">
            <label>Description</label>
            <input style="color:black;" type="text" name="des" value="{{$data->description}}" required="">
        </div>

        <div style="padding:15px;">
            <label>Old Image</label>
            <img height="100px" width="100px" src="/productimage/{{$data->image}}">
        </div>

        <div style="padding:15px;">
         <label>Change the Image</label>
            <input type="file" name="image"> 
        </div>

        <div style="padding:15px;">
            <input class="btn btn-success" type="Submit">
        </div>


</form>

        </div>

        </div>
        

          <!-- partial -->
       
        @include('admin.script')

  </body>
</html>