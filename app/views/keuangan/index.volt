
{% extends 'template/master.volt' %}
{% block title %}
<title>Keuangan</title>
{%endblock%}
{% block content %}
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-credit-card"></i></span>
              <div class="info-box-content">
                <span class="info-box-text" >Jumlah Piutang</span>
                <span class="info-box-number" >{{piutang|number_format(0,'','.')}}</span>
              </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-credit-card"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Jumlah Utang Pemillik Truk</span>
                <span class="info-box-number" >{{utangpemilik|number_format(0,'','.')}}</span>
              </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-credit-card"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Kurang Bayar MHN</span>
                <span class="info-box-number" >{{utangmashun|number_format(0,'','.')}}</span>
              </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>DETIL PIUTANG</strong>
        </div>
        <div class="card-header text-center">
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <thead>
                    <tr>
                        <th>Nama Pabrik</th>
                        <th>Kode Pabrik</th>
                        <th>Piutang Pabrik</th>
                    </tr>
                </thead>
                <tbody>
                    {% for p in pabrik %}
                    <tr>
                        <td>{{ p.nama_pabrik }}</td>
                        <td>{{ p.kode_pabrik }}</td>
                        {% set total = 0 %}
                        {% for x in p.transaksi %}
                        {% set total = total + x.harga_pabrik %}
                        {% endfor %}
                        <td>{{ total|number_format(0,'','.') }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{%endblock%}