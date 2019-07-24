<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>


<div class="container">
  <h2>Brand Info:</h2>
  <br>
  
    <div class="row">
      <div class="col-md-6">
        <a class="btn btn-info" href="{{url('/brands')}}">Home</a>
        <a class="btn btn-success" href="{{url('/brands/create')}}">Add New</a>
        <a class="btn btn-warning" href="{{ URL::previous() }}">Back</a>
      </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <label for="">Brand Name:</label>
        </div>
        <div class="col-md-3">{{$brand->name}}</div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <label for="">Brand Logo:</label>
        </div>
        <div class="col-md-3">
            
            <img src="{{ URL::to('storage/images/'.$brand->logo) }}" alt="fgcvbcbc" style="height:50px; width:50px;">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <label for="">Brand Description:</label>
        </div>
        <div class="col-md-3">{{$brand->description}}</div>
    </div>
    
  </div>




    
</body>

<footer>

</footer>
</html>