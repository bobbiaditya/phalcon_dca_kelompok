{% extends 'template/master.volt' %}
{% block title %}
<title>Register</title>
{%endblock%}
{% block content %}
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>Tambah User Baru</strong>
        </div>
        <div class="card-header text-danger text-center">
            {{ flashSession.output() }}
        </div>
        <div class="card-body">
            <form method="post" action="{{url('/user/register')}}">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pwd" autocomplete="off" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Tipe User</label>
                    <select class="form-control" id="tipe" name="tipe">
                        <option value="master">Master</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>
{%endblock%}