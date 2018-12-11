@if(count($errors)>0)
   <div class="row">
       <div class="col-md-12 error">
               @foreach($errors->all() as $error)
                   <div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                      {{ $error }}
                   </div>
               @endforeach
       </div>
   </div>
@endif
