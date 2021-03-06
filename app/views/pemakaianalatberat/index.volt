{% extends 'template/master.volt' %}
{% block title %}
<title>Pemakaian Alat Berat</title>
{%endblock%}
{% block content %}
    <div class="container">
        <div class="card">
            <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
                <strong>PEMAKAIAN ALAT BERAT</strong>
            </div>
            <div class="card-header">
                <a href="{{ url('pemakaianalatberat/tambah') }}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus"
                        style="padding-right: 7px;"></span>Input</a>
            </div>
            <div class="card-header">
                <form action="/pemakaianalatberat/search" autocomplete="off" method="post">
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
                    </form>
                </div>
            <div class="card-header text-success text-center">
                {{ flashSession.output() }}
            </div>
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-bordered table-hover table-striped table-head-fixed">
                    <thead>
                        <tr>
                            <th>Alat Berat</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Jam Pakai</th>
                            <th>Harga Pakai</th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for p in pemakaian %}
                        <tr>
                            <td>{{ p.alat.nama_alatBerat }}</td>
                            <td>{{ p.tanggal_mulai|tgl }}</td>
                            <td>{{ p.tanggal_selesai|tgl }}</td>
                            <td>{{ p.jam_pakai }}</td>
                            <td>{{ p.harga_pakai|number_format(0,'','.') }}</td>
                            <td>
                                <a href="{{url('pemakaianalatberat/edit/'~p.id_pemakaian) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{url('pemakaianalatberat/hapus/'~p.id_pemakaian) }}" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{%endblock%}