{% extends 'template/master.volt' %}
{% block title %}
<title>Pabrik</title>
{%endblock%}
{% block content %}

</head>
<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>PABRIK</strong>
        </div>
        <div class="card-header">
            <a href="{{ url('pabrik/tambah') }}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus"
                    style="padding-right: 7px;"></span>Input</a>
        </div>
        <div class="card-header text-success text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <thead>
                    <tr>
                        <th>Nama Pabrik</th>
                        <th>Kode Pabrik</th>
                        <th>Harga Pasir</th>
                        <th>OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in pabriks %}
                    <tr>
                        <td>{{ p.nama_pabrik }}</td>
                        <td>{{ p.kode_pabrik }}</td>
                        <td>{{ p.harga_pasir }}</td>
                        <td>
                            <a href="{{url('pabrik/edit/'~p.id_pabrik) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{url('pabrik/hapus/'~p.id_pabrik) }}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{%endblock%}