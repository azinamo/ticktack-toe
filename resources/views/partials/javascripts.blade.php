<script src="{{ url('js') }}/jquery/jquery.js"></script>
<script src="{{ url('js') }}/bootstrap/bootstrap.min.js" ></script>
<script src="{{ url('js') }}/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ url('js') }}/jquery.form.min.js"></script>

<script>
    window._token = '{{ csrf_token() }}';
</script>

@yield('javascript')