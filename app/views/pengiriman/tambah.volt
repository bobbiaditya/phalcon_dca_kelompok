{% extends 'template/master.volt' %}
{% block title %}
<title>Pengiriman</title>
{%endblock%}
{% block content %}
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>TAMBAH DATA</strong>
        </div>
        <div class="card-header">
            <a href="{{url('pengiriman')}}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-header text-danger text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body">
            <form method="post" action="{{url('pengiriman/proses')}}">
                <div class="form-group">
                    <label>Nama Pabrik</label>
                    <select class="form-control" id="id_pabrik" name="id_pabrik">
                        <option value="" disabled selected>Nama Pabrik</option>
                        {% for p in pabrik %}
                        <option value="{{p.id_pabrik}}">{{p.nama_pabrik}}</option>
                    {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Pemilik Truk</label>
                    <select class="form-control" id="id_pemilik" name="id_pemilik">
                        <option value="" disabled selected>Nama Pemilik</option>
                        {% for p in pemilik %}
                        <option value="{{p.id_pemilik}}">{{p.nama_pemilik}}</option>
                    {% endfor %}
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Harga Kirim</label>
                    <input type="text" name="harga_kirim" autocomplete="off" class="form-control" placeholder="Harga Kirim">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>
{% endblock %}