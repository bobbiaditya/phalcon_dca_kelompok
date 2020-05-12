{% extends 'template/master.volt' %}
{% block title %}
<title>Transaksi </title>
{%endblock%}
{% block content %}
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>TAMBAH DATA</strong>
        </div>
        <div class="card-header">
            <a href="{{url('transaksi')}}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-header text-danger text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body">
            <form method="post" action="{{url('transaksi/proses')}}">
                <div class="form-group">
                    <label>Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" autocomplete="off" class="form-control" value="">
                </div>
                <div class="form-group">         
                    <label>Nama pabrik</label>
                    <input list="nama" name="id_pabrik" autocomplete="off" class="form-control pabrik" placeholder="Nama Pabrik" >
                    <datalist id="nama">
                        {% for x in pabrik %}
                        <option value="{{x.id_pabrik}}">{{x.nama_pabrik}}</option>
                        {% endfor%}
                    </datalist>
                </div>
                <div class="form-group">         
                    <label>Tempat Cucian</label>
                    <input list="cuci" name="id_cucian" autocomplete="off" class="form-control cucian" placeholder="Tempat Cucian" >
                    <datalist id="cuci">
                        {% for x in cucian %}
                        <option value="{{x.id_cucian}}">{{x.nama_cucian}}</option>
                        {% endfor%}
                    </datalist>
                </div>
                <div class="form-group">         
                    <label>Supir Truk</label>
                    <input list="supir" name="id_supir" autocomplete="off" class="form-control supir" placeholder="Nama Supir" >
                    <datalist id="supir">
                        {% for x in supir %}
                        <option value="{{x.id_supir}}">{{x.nama_supir}}</option>
                        {% endfor%}
                    </datalist>
                </div>
                <div class="form-group">
                    <label>Volume Pasir</label>
                    <input type="text" name="volume_pasir" class="form-control" placeholder="Volume Pasir">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>
{% endblock %}