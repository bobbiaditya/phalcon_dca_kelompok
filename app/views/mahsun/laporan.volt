{% extends 'template/master.volt' %}
{% block title %}
<title>Mahsun</title>
{%endblock%}
{% block content %}
{% set sumbon = 0%}
{% set sumpasir = 0%}
{% set sumalat = 0%}
<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>Mahsun</strong>
        </div>
        <div class="card-header">
            <form action="/mahsun/laporan" autocomplete="off" method="post">
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
        <div class="card-body table-responsive p-0" style="height: 500px;">
            Transaksi
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <thead>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <th>NoPol</th>
                        <th>Supir</th>
                        <th>Volume Mahsun</th>
                        <th>Harga Mahsun</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Bon Supir</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in trans %}
                    {% set sumbon = sumbon+p.bon_supir%}
                    {% set sumpasir = sumpasir+p.harga_mahsun%}
                    <tr>
                        <td>{{p.tanggal_transaksi}}</td>
                        <td>{{p.supir.nopol}}</td>
                        <td>{{p.supir.nama_supir}}</td>
                        <td>{{p.volume_mahsun|number_format(2,',','.')}}</td>
                        <td>{{p.harga_mahsun|number_format(0,'','.')}}</td>
                        <td>{{p.cucian.nama_cucian}}</td>
                        <td>{{p.harga_pemilikTruk|number_format(0,'','.')}}</td>
                        <td>{{p.bon_supir|number_format(0,'','.')}}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
        <div class="card-body table-responsive p-0" style="height: 500px;">
            Pemakaian Alat Berat
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <thead>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Nama Alat Berat</th>
                        <th>Jam Pakai</th>
                        <th>Harga Pakai</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in pemakaian %}
                    {% set sumalat = sumalat+p.harga_pakai%}
                    <tr>
                        <td>{{ p.tanggal_mulai }}</td>
                        <td>{{ p.tanggal_selesai }}</td>
                        <td>{{ p.alat.nama_alatBerat }}</td>
                        <td>{{ p.jam_pakai }}</td>
                        <td>{{ p.harga_pakai|number_format(0,'','.') }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
        <div class="card-body table-responsive p-0" style="height: 500px;">
            Rekapitulasi
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <tbody>
                    <tr>
                        <td>Pasir</td>
                        <td>{{sumpasir|number_format(0,'','.')}}</td>
                    </tr>
                    <tr>
                        <td>Bon Supir</td>
                        <td>{{sumbon|number_format(0,'','.')}}</td>
                    </tr>
                    <tr>
                        <td>Alat Berat</td>
                        <td>{{sumalat|number_format(0,'','.')}}</td>
                    </tr>
                    <tr>
                        <td>Kurang Bayar Mahsun</td>
                        <td>{{(sumalat - (sumpasir+sumbon))|number_format(0,'','.')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endblock %}
