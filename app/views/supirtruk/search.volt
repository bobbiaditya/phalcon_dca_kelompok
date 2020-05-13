{% extends 'template/master.volt' %}
{% block title %}
<title>Supir Truk</title>
{%endblock%}
{% block content %}

<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>Supir Truk ({{supir[0].pemilik.nama_pemilik}})</strong>
        </div>
        <div class="card-header">
            <a href="{{url('/supirtruk/tambah')}}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus"
                    style="padding-right: 7px;"></span>Input</a>
            <a href="{{url('supirtruk')}}" class="btn btn-secondary btn-sm float-right">Kembali</a>
        </div>
        <div class="card-header text-success text-center">
            <form action="/supirtruk/search" autocomplete="off" method="post">
                <div class="form-row">
                    <div class="col-3">
                        <input list="kodes" class="form-control" name="nama_pemilik" placeholder="Nama Pemilik Truk">
                        <datalist id="kodes">
                            {% for x in pemilik %}
                            <option value="{{x.nama_pemilik}}">
                                {% endfor %}
                        </datalist>
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
                        <th>Nama Supir</th>
                        <th>Pemilik Truk</th>
                        <th>Nopol</th>
                        <th>OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in supir %}
                    <tr>
                        <td>{{p.nama_supir}}</td>
                        <td>{{p.pemilik.nama_pemilik}}</td>
                        <td>{{p.nopol}}</td>
                        <td>
                            <a href="{{url('supirtruk/edit/'~p.id_supir) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{url('supirtruk/hapus/'~p.id_supir) }}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>

        </div>
    </div>
</div>
{% endblock %}