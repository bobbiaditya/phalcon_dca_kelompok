{% extends 'template/master.volt' %}
{% block title %}
<title>User Master</title>
<div class="container">
<div class="d-flex justify-content-center align-items-center" style="margin-top: 100px; margin-left:150px;">
    <img src="{{ static_url('img/user.svg') }}" style="width:450px;height:350px;">
</div>
<div class="d-flex justify-content-center align-items-center" style="margin-left:150px;">
    <div class="inline-block align-middle">
        <h3>Anda telah masuk menggunakan akun <b>{{ session.get('auth')['username'] }}</b></h3>
    </div>
</div>
</div>
{%endblock%}