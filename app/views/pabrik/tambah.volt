{% extends 'template/master.volt' %}
{% block title %}
<title>Pabrik</title>
{%endblock%}
{% block content %}
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>TAMBAH DATA</strong>
        </div>
        <div class="card-header">
            <a href="{{url('/pabrik')}}" class="btn btn-secondary">Kembali</a>
   
        </div>
        <div class="card-header text-danger text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body">
            <form method="post" action="{{url('/pabrik/proses')}}">
                <div class="form-group">
                    <label>Nama Pabrik</label>
                    <input type="text" name="nama_pabrik" autocomplete="off" class="form-control" placeholder="Nama pabrik">

                </div>
                <div class="form-group">
                    <label>Kode Pabrik</label>
                    <input type="text" name="kode_pabrik" autocomplete="off" class="form-control" placeholder="Kode Pabrik">

                <div class="form-group">
                    <label>Harga pasir</label>
                    <input type="text" name="harga_pasir" class="form-control" placeholder="Harga Pasir" autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>
{%endblock%}