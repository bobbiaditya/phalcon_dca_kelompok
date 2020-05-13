{% extends 'template/master.volt' %}
{% block title %}
<title>Transaksi</title>
{%endblock%}
{% block content %}

<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>EDIT DATA</strong>
        </div>
        <div class="card-header">
            <a href="{{url('/transaksi')}}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-header text-danger text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body">

            <form autocomplete="off" method="post" action="{{ url('transaksi/update/' ~ trans.id_transaksi) }}">
                <div class="form-group">
                    <label>Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" autocomplete="off" class="form-control" value="{{trans.tanggal_transaksi}}">
                </div>
                <div class="form-group">         
                    <label>Nama pabrik</label>
                    <input list="nama" name="nama_pabrik" autocomplete="off" class="form-control pabrik" placeholder="Nama Pabrik" value="{{trans.pabrik.nama_pabrik}}" >
                    <datalist id="nama">
                        {% for x in pabrik %}
                        <option value="{{x.nama_pabrik}}">{{x.nama_pabrik}}</option>
                        {% endfor%}
                    </datalist>
                </div>
                <div class="form-group">         
                    <label>Tempat Cucian</label>
                    <input list="cuci" name="nama_cucian" autocomplete="off" class="form-control cucian" placeholder="Tempat Cucian"  value="{{trans.cucian.nama_cucian}}">
                    <datalist id="cuci">
                        {% for x in cucian %}
                        <option value="{{x.nama_cucian}}">{{x.nama_cucian}}</option>
                        {% endfor%}
                    </datalist>
                </div>
                <div class="form-group">         
                    <label>Supir Truk</label>
                    <input list="supir" name="nama_supir" autocomplete="off" class="form-control supir" placeholder="Nama Supir"  value="{{trans.supir.nama_supir}}">
                    <datalist id="supir">
                        {% for x in supir %}
                        <option value="{{x.nama_supir}}">{{x.nama_supir}}</option>
                        {% endfor%}
                    </datalist>
                </div>
                <div class="form-group">
                    <label>Volume Pasir</label>
                    <input type="text" name="volume_pasir" class="form-control" placeholder="Volume Pasir" value="{{trans.volume_pasir}}">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{trans.keterangan}}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>


            </form>

        </div>
    </div>
</div>
{% endblock %}