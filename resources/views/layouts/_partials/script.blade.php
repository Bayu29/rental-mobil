<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src=https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js></script>
<script src=https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.js" ></script>
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset("backend/assets/libs/swiper/swiper-bundle.min.js") }} "></script>
<script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src='{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}'></script>
<script src="{{ asset('backend/assets/js/app.js') }}"></script>

<script>
    $('#ubahPassword').click(function() {
        $('#ajaxModelEditPassword').modal('show');
    });
</script>
@stack('js')
@include('sweetalert::alert')

