@if(Session::has('message'))
   <div class="row">
       <div class="col-md-12 success">
           <div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert">&times;</a>
              {{ Session::get('message') }}
           </div>   
       </div>
   </div>
@endif