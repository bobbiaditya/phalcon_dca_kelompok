{% extends 'template/master.volt' %}
{% block title %}
<title>Cucian</title>
{%endblock%}
{% block content %}
    <div class="container">
        <div class="card">
            <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
                <strong>CUCIAN</strong>
            </div>
                {{ flashSession.output() }}
                
            <!-- This is an alert box. -->
            <div class="card-header">
                <a href="{{ url('cucian/tambah') }}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus"
                        style="padding-right: 7px;"></span>Input</a>
               
            </div>
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-bordered table-hover table-striped table-head-fixed">
                    <thead>
                        <tr>
                            <th>Nama Cucian</th>
                            <th>Kode Cucian</th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for c in cucian %}
                        <tr>
                            <td>{{ c.nama_cucian }}</td>
                            <td>{{ c.kode_cucian }}</td>
                            <td>
                                <a href="{{url('cucian/edit/'~c.id_cucian) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{url('cucian/hapus/'~c.id_cucian) }}" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{%endblock%}