{% extends 'template/master.volt' %}
{% block title %}
<title>Supir Truk</title>
{%endblock%}
{% block content %}

<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>Pengiriman</strong>
        </div>
        <div class="card-header">
            <a href="{{url('/pengiriman/tambah')}}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus" style="padding-right: 7px;"></span>Input</a>
        </div>
        <div class="card-header">
            <form action="/pengiriman/search" autocomplete="off" method="post">
                <div class="form-row">
                    <div class="form-group col-auto">
                        <select class="form-control" id="id_pabrik" name="id_pabrik">
                            <option value="" disabled selected>Nama Pabrik</option>
                            {% for p in pabrik %}
                            <option value="{{p.id_pabrik}}">{{p.nama_pabrik}}</option>
                        {% endfor %}
                        </select>
                    </div>
                    <div class="form-group col-auto">
                        <select class="form-control" id="id_pemilik" name="id_pemilik">
                            <option value="" disabled selected>Nama Pemilik</option>
                            {% for p in pemilik %}
                            <option value="{{p.id_pemilik}}">{{p.nama_pemilik}}</option>
                        {% endfor %}
                        </select>
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
                        <th>Nama Pabrik</th>
                        <th>Nama Pemilik</th>
                        <th>Harga Kirim</th>
                        <th>Bon Supir</th>
                        <th>OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in peng %}
                    <tr>
                        <td>{{p.pabrik.nama_pabrik}}</td>
                        <td>{{p.pemilik.nama_pemilik}}</td>
                        <td>{{p.harga_kirim|number_format(0,'','.')}}</td>
                        <td>{{p.harga_supir|number_format(0,'','.')}}</td>
                        <td>
                            <a href="{{url('pengiriman/edit/'~p.id_pengiriman) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{url('pengiriman/hapus/'~p.id_pengiriman) }}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endblock %}
