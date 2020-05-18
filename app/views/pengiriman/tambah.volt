{% extends 'template/master.volt' %}
{% block title %}
<title>Pengiriman</title>
{%endblock%}
{% block content %}
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>TAMBAH DATA</strong>
        </div>
        <div class="card-header">
            <a href="{{url('pengiriman')}}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-header text-danger text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body">
            <form method="post" action="{{url('pengiriman/proses')}}">
                <div class="form-group">
                    <label>Nama Pemilik Truk</label>
                    <select class="form-control pemilik" id="id_pemilik" name="id_pemilik">
                        <option value="" disabled selected>Nama Pemilik</option>
                        {% for p in pemilik %}
                        <option value="{{p.id_pemilik}}">{{p.nama_pemilik}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group pabrik">
                    <label>Nama Pabrik</label>
                    <select class="form-control pabrik" id="id_pabrik" name="id_pabrik">
                        <option value="" disabled selected>Nama Pabrik</option>
                        {% for p in pabrik %}
                            <option value="{{p.id_pabrik}}">{{p.nama_pabrik}}</option>
                        {% endfor %}
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Harga Kirim</label>
                    <input type="text" name="harga_kirim" autocomplete="off" class="form-control" placeholder="Harga Kirim">
                </div>
                <div class="form-group">
                    <label>Bon Supir</label>
                    <input type="text" name="harga_supir" autocomplete="off" class="form-control" placeholder="Bon Supir">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '.pemilik', function () {
            var id_pem = $(this).val();
            // console.log(id_pem);

            var op = "";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'get',

                url: "{{url('pengiriman/ajax')}}",

                data: { '_token': $('input[name="_token"]').val(), 'id_pem': id_pem },
                success: function (data) {
                    var hai ='hai';
                    console.log(data.length);
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        // op += '<option value="' + data[i].id_pabrik + '">' + data[i].id_pabrik + '</option>';
                        // console.log(data[i]);
                    }
                    // console.log(data);
                    console.log(op);
                    // $("div.pabrik").find('select.pabrik').html(" ");
                    // $("div.pabrik").find('select.pabrik').append(op);
                    // console.log(data);

                },
                error: function () {
                }
            });

        });
    });
</script> -->
{% endblock %}