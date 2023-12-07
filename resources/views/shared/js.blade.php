<!-- BEGIN: Pusher JS-->
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<!-- END: Pusher JS-->
<!-- BEGIN: Vendor JS-->
<script src="{{asset('backend/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>

<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('backend/app-assets/vendors/js/tables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/tables/datatable/dataTables.rowReorder.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('backend/app-assets/vendors/js/charts/chartist.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')}}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('backend/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
@if(Request::is('admin/dashboard'))
<script src="{{asset('backend/app-assets/js/scripts/pages/dashboard-analytics.js')}}" type="text/javascript"></script>
@endif
<!-- END: Page JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('backend/app-assets/js/scripts/pages/chat-application.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->
<!-- BEGIN: Page JS-->
<script src="{{asset('backend/app-assets/js/scripts/pages/users-contacts.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('backend/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{asset('backend/app-assets/js/scripts/forms/checkbox-radio.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->
<!-- BEGIN: Page JS-->
{{-- <script src="{{asset('backend/app-assets/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script> --}}
<!-- END: Page JS-->

<!-- BEGIN: Page Vendor JS-->
@if (Request::is('class/lecture/*') || Request::is('profile'))
<script src="{{asset('backend/app-assets/vendors/js/extensions/dropzone.min.js')}}" type="text/javascript"></script>
@endif

@if (Request::is('class/lecture/*'))
<script src="{{asset('backend/custom/js/dropzone.js')}}"></script>
@endif

@if (Request::is('profile'))
<script src="{{asset('backend/custom/js/dropzone-single.js')}}"></script>
@endif

<script src="{{asset('backend/app-assets/vendors/js/ui/prism.min.js')}}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
{{-- <script src="{{asset('backend/app-assets/vendors/js/pickers/pickadate/picker.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/pickers/pickadate/legacy.js')}}" type="text/javascript"></script> --}}
<script src="{{asset('backend/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}" type="text/javascript"></script>
{{-- <script src="{{asset('backend/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}" type="text/javascript"></script> --}}
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
{{-- <script src="{{asset('backend/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}" type="text/javascript"></script> --}}
<!-- END: Page JS-->
<script src="{{asset('backend/js/datepicker.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="{{asset('backend/datetimepicker/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>


<!-- BEGIN: Page JS-->
<script src="{{asset('backend/app-assets/js/scripts/navs/navs.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('backend/app-assets/vendors/js/extensions/jquery.steps.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->


<!-- BEGIN: Page JS-->
<script src="{{asset('backend/app-assets/js/scripts/forms/wizard-steps.js')}}" type="text/javascript"></script>
<script>
    $('.confirm').click(function() {
        if (confirm('Are you sure?')) {
            return true;
        } else {
            return false;
        }
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $('.datetime').datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    $('.date').datetimepicker({
        format: "yyyy-mm-dd",

    });

    $('.time').datetimepicker({
        format: "hh:ii",
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>

<script src="{{ asset('backend/custom/js/moment.js') }}"></script>
<script src="{{ asset('backend/custom/js/moment-timezone.js') }}"></script>
<!-- <script src="{{ asset('backend/quiz-assets/js/teckquiz.js') }}"></script> -->