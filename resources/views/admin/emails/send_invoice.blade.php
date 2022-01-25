@extends('admin.email')

@section('content')

<h3>
    Dear: {{ $order->first_name }} {{ $order->last_name }}
</h3>
<h4>Greetings</h4>
<p> .تجدون فى المرفقات الفاتورة الخاصة بكم</p>
@endsection
