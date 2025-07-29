 @extends('admin.layout.layout')
 @Section('content')
     <div class="container-file-manager" style="height: 90vh">
         <iframe src="/file-manager" style="width:100%; height:100%; border:none;"></iframe>
     </div>
     <style>
         .container-file-manager {
             background: red;
             z-index: 10000;
             position: relative;
             top: 0;
             left: 0px;
             width: 100%;
             height: 90vh;
             border: 1px solid #000;
             margin: 0 auto;
         }
     </style>
 @endsection
