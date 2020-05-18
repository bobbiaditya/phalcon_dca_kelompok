{% extends 'template/master.volt' %}
{% block title %}
<title>Pemilik Truk</title>
{%endblock%}
{% block content %}
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>TAMBAH DATA</strong>
        </div>
        <div class="card-header">
            <a href="{{url('/pemiliktruk')}}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-header text-danger text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body">
            <form method="post" action="{{url('/pemiliktruk/proses')}}">
                <div class="form-group">
                    <label>Nama Pemilik Truk</label>
                    <input type="text" name="nama_pemilik" autocomplete="off" class="form-control" placeholder="Nama Pemilik Truk">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>
{%endblock%}