{% extends 'template/master.volt' %}
{% block title %}
<title>Supir Truk</title>
{%endblock%}
{% block content %}
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>TAMBAH DATA</strong>
        </div>
        <div class="card-header">
            <a href="{{url('supirtruk')}}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-header text-danger text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body">
            <form method="post" action="{{url('supirtruk/proses')}}">
                <div class="form-group">
                    <label>Nama Pemilik</label>
                    <select class="form-control" id="id_pemilik" name="id_pemilik">
                        <option value="" disabled selected>Nama Pemilik</option>
                        {% for p in pemilik %}
                        <option value="{{p.id_pemilik}}">{{p.nama_pemilik}}</option>
                    {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Supir</label>
                    <input type="text" name="nama_supir" autocomplete="off" class="form-control" placeholder="Nama Supir">
                </div>

                <div class="form-group">
                    <label>Nopol</label>
                    <input type="text" name="nopol" autocomplete="off" class="form-control" placeholder="Nopol">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>
{% endblock %}