{% extends 'template/master.volt' %}
{% block title %}
<title>User</title>
{%endblock%}
{% block content %}

<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>List User</strong>
        </div>
        <div class="card-header text-success text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-header">
            <a href="{{url('/user/tambah')}}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus" style="padding-right: 7px;"></span>Input</a>
        </div>
        <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <thead>
                    <tr>
                        <th>Nama User</th>
                        <th>Tipe User</th>
                        <th>OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in users %}
                    <tr>
                        <td>{{p.username}}</td>
                        <td>{{p.tipe}}</td>
                        <td>
                            <a href="{{url('user/hapus/'~p.id_user) }}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endblock %}
