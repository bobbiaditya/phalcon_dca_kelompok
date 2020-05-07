{% extends 'template/master.volt' %}
{% block title %}
<title>Pemakaian Alat Berat</title>
{%endblock%}
{% block content %}
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>EDIT DATA</strong>
        </div>
        {{ flashSession.output() }}
        <div class="card-header">
            <a href="{{url('/pemakaianalatberat')}}" class="btn btn-secondary">Kembali</a>

        </div>
        <div class="card-body">
            <form autocomplete="off" method="post" action="{{ url('/pemakaianalatberat/update/' ~ pemakaian.id_pemakaian) }}">
                <div class="form-group">
                    <label>Nama Alat Berat</label>
                    <input list="kodes" name="nama_alatBerat" class="form-control " placeholder="Nama Alat Berat"
                        value="{{ pemakaian.alat.nama_alatBerat }}">
                    <datalist id="kodes">
                        {% for a in alat %}
                        <option value="{{a.nama_alatBerat}}">
                        {% endfor %}
                    </datalist>
                </div>
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai"
                        value="{{ pemakaian.tanggal_mulai }}">
                </div>
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai"
                        value="{{ pemakaian.tanggal_selesai }}">
                </div>
                <div class="form-group">
                    <label>Jam Pakai</label>
                    <input type="text" name="jam_pakai" class="form-control" placeholder="Jam Pakai" value="{{ pemakaian.jam_pakai }}">
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>
            

        </div>
    </div>
</div>
{%endblock%}