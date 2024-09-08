                <footer>
                    <p>{{date('Y')}} © {{ config('app.project.name') }} Admin.</p>
                </footer>

                <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
        </div>

                
            <!-- END Content -->
        </div>
        <!-- END Container -->

        <script src="{{ url('/') }}/public/admin/assets/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/jquery-validation/dist/additional-methods.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/jquery-cookie/jquery.cookie.js"></script>
        
        <!--page specific plugin scripts-->
        <script src="{{ url('/') }}/public/admin/assets/flot/jquery.flot.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/flot/jquery.flot.resize.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/flot/jquery.flot.pie.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/flot/jquery.flot.stack.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/flot/jquery.flot.crosshair.js"></script>
        {{--<script src="{{ url('/') }}/public/admin/assets/flot/jquery.flot.tooltip.min.js"></script>--}}
        <script src="{{ url('/') }}/public/admin/assets/sparkline/jquery.sparkline.min.js"></script>
        

        <script src="{{ url('/') }}/public/admin/assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
        <script src="{{ url('/') }}/public/admin/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/ckeditor/ckeditor.js"></script> 
        <script src="{{ url('/') }}/public/admin/assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>

        <!--DATA Tables-->
        <script src="{{ url('/') }}/public/admin/assets/data-tables/latest/jquery.dataTables.min.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>

        <script src="{{ url('/') }}/public/admin/assets/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/chosen-bootstrap/chosen.jquery.min.js"></script>

        <!--Datepicker-->
 
      <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" />
      <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap-timepicker/compiled/timepicker.css" rel="stylesheet" />
         <script src="{{ url('/') }}/public/admin/js/bootstrap-datepicker.js"></script>      
          <script src="{{ url('/') }}/public/admin/js/bootstrap-datepicker.min.js"></script>
          
      <script src="{{ url('/') }}/public/admin/js/bootstrap-timepicker.js"></script>
      <script src="{{url('/')}}/public/admin/assets/bootstrap-datetimepicker/moment.js"></script> 
      
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <!--flaty scripts-->
        <script src="{{ url('/') }}/public/admin/js/flaty.js"></script>
        <script src="{{ url('/') }}/public/admin/js/flaty-demo-codes.js"></script>
        <script src="{{ url('/') }}/public/admin/js/validation.js"></script>
        
</script>

    </body>
</html>
