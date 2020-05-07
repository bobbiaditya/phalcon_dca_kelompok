{% extends 'template/master.volt' %}
{% block title %}
<title>Pemilik Truk</title>
{%endblock%}
{% block content %}

<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>Pemilik Truk</strong>
        </div>
        <div class="card-header">
            <a href="{{url('/pemiliktruk/tambah')}}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus"
                    style="padding-right: 7px;"></span>Input</a>
        </div>
        <div class="card-header text-success text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <thead>
                    <tr>
                        <th>Nama Pemilik Truk</th>
                        <th>OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in pemilik %}
                    <tr>
                        <td>{{ p.nama_pemilik }}</td>
                        <td>
                            <a href="{{url('pemiliktruk/edit/'~p.id_pemilik) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{url('pemiliktruk/hapus/'~p.id_pemilik) }}"
                                class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{%endblock%}