{% extends 'template/master.volt' %}
{% block title %}
<title>Alat Berat</title>
{%endblock%}
{% block content %}
    <div class="container">
        <div class="card">
            <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
                <strong>ALAT BERAT</strong>
            </div>
            {{ flashSession.output() }}
            <div class="card-header">
                <a href="{{ url('alatberat/tambah') }}" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus"
                        style="padding-right: 7px;"></span>Input</a>
            </div>
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-bordered table-hover table-striped table-head-fixed">
                    <thead>
                        <tr>
                            <th>Nama Alat Berat</th>
                            <th>Harga Alat Berat per Jam</th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for a in alat %}
                        <tr>
                            <td>{{ a.nama_alatBerat }}</td>
                            <td>{{ a.harga_alatBerat }}</td>
                            <td>
                                <a href="{{url('alatberat/edit/'~a.id_alatBerat) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{url('alatberat/hapus/'~a.id_alatBerat) }}" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
{%endblock%}