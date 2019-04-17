<?php
echo "Form Submitted! <br>";
?>
{{csrf_field()}}

<a href="{{ url('/home') }}">Return</a>
