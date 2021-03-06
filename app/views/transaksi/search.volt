{% extends 'template/master.volt' %}
{% block title %}
<title>Transaksi</title>
{%endblock%}
{% block content %}

<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>Transaksi</strong>
        </div>
        <div class="card-header">
            <a href="{{url('/transaksi/tambah')}}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus" style="padding-right: 7px;"></span>Input</a>
            <a href="{{url('transaksi')}}" class="btn btn-secondary btn-sm float-right">Kembali</a>
        </div>
        <div class="card-header">
            <form action="/transaksi/search" autocomplete="off" method="post">
                <div class="form-row">
                    <div class="col-auto">
                        Awal:
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" name="tanggal_awal" placeholder="Tanggal Awal">
                    </div>
                    <div class="col-auto">
                        Akhir:
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" name="tanggal_akhir" placeholder="Tanggal Akhir">
                    </div>
                    <div class="col-auto">
                        <input type="submit" class="btn btn-info" value="Cari">
                    </div>
                </div>
        </div>
        <div class="card-header text-success text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pabrik</th>
                        <th>Supir</th>
                        <th>Pasir(m3)</th>
                        <th>Harga Pasir</th>
                        <th>Mahsun(m3)</th>
                        <th>Harga Mahsun</th>
                        <th>Pemilik Truk(m3)</th>
                        <th>Harga Pemilik</th>
                        <th>Bon Supir</th>
                        <th>Asal</th>
                        <th>Total Modal</th>
                        <th>Keterangan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in trans %}
                    <tr>
                        <td>{{p.tanggal_transaksi|tgl}}</td>
                        <td>{{p.pabrik.nama_pabrik}}</td>
                        <td>{{p.supir.nama_supir}}</td>
                        <td>{{p.volume_pasir|number_format(2,',','.')}}</td>
                        <td>{{p.harga_pabrik|number_format(0,'','.')}}</td>
                        <td>{{p.volume_mahsun|number_format(2,',','.')}}</td>
                        <td>{{p.harga_mahsun|number_format(0,'','.')}}</td>
                        <td>{{p.volume_pemilikTruk|number_format(2,',','.')}}</td>
                        <td>{{p.harga_pemilikTruk|number_format(0,'','.')}}</td>
                        <td>{{p.bon_supir|number_format(0,'','.')}}</td>
                        <td>{{p.cucian.nama_cucian}}</td>
                        <td>{{p.total_modal|number_format(0,'','.')}}</td>
                        <td>{{p.keterangan}}</td>
                        <td>
                            <a href="{{url('transaksi/edit/'~p.id_transaksi) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{url('transaksi/hapus/'~p.id_transaksi) }}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endblock %}
