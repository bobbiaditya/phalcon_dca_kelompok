CREATE TABLE pabrik (
  id_pabrik int IDENTITY(1,1) NOT NULL,
  nama_pabrik varchar(100) NOT NULL,
  kode_pabrik varchar(5) NOT NULL,
  harga_pasir decimal(13,2) NOT NULL,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

ALTER TABLE pabrik
  ADD PRIMARY KEY (id_pabrik);

CREATE TABLE pemilik_truk (
  id_pemilik int IDENTITY(1,1) NOT NULL,
  nama_pemilik varchar(100) NOT NULL,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

ALTER TABLE pemilik_truk
  ADD PRIMARY KEY (id_pemilik);

CREATE TABLE supir_truk (
  id_supir int IDENTITY(1,1) NOT NULL PRIMARY KEY,
  id_pemilik int NOT NULL FOREIGN KEY REFERENCES pemilik_truk(id_pemilik),
  nama_supir varchar(100) NOT NULL,
  nopol varchar(10) NOT NULL,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

  CREATE TABLE users (
  id_user int IDENTITY(1,1) NOT NULL,
  username varchar(100) NOT NULL,
  pwd  varchar(100) NOT NULL,
  tipe varchar(10) not null,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

ALTER TABLE users
  ADD PRIMARY KEY (id_user);

  CREATE TABLE cucian (
  id_cucian int IDENTITY(1,1) NOT NULL PRIMARY KEY,
  nama_cucian varchar(100) NOT NULL,
  kode_cucian varchar(20) NOT NULL,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

CREATE TABLE alat_berat (
  id_alatBerat int IDENTITY(1,1) NOT NULL PRIMARY KEY,
  nama_alatBerat varchar(100) NOT NULL,
  harga_alatBerat decimal(13,2) NOT NULL,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

CREATE TABLE pemakaian_alatberat (
  id_pemakaian int IDENTITY(1,1) NOT NULL PRIMARY KEY,
  id_alatBerat int NOT NULL FOREIGN KEY REFERENCES alat_berat(id_alatBerat),
  tanggal_mulai DATE NOT NULL,
  tanggal_selesai DATE NOT NULL,
  jam_pakai int NOT NULL,
  harga_pakai decimal(13,2) NOT NULL,	
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

CREATE TABLE transaksi (
  id_transaksi int IDENTITY(1,1) NOT NULL PRIMARY KEY,
  id_cucian int NOT NULL FOREIGN KEY REFERENCES cucian(id_cucian),
  id_supir int NOT NULL FOREIGN KEY REFERENCES supir_truk(id_supir),
  id_pabrik int NOT NULL FOREIGN KEY REFERENCES pabrik(id_pabrik),
  tanggal_transaksi DATE not null,
  volume_pasir float,
  harga_pabrik decimal(13,2),
  volume_mahsun float,
  harga_mahsun decimal(13,2),
  volume_pemilikTruk float,
  harga_pemilikTruk decimal(13,2),
  bon_supir decimal(13,2),
  total_modal decimal(13,2),
  keterangan text,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

create TABLE konstan (
  id_konstan int IDENTITY(1,1) NOT NULL PRIMARY KEY,
  rate_mahsun float,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)

insert into konstan(rate_mahsun,created_at) values (135,GETDATE())

create TABLE pengiriman (
  id_pengiriman int IDENTITY(1,1) NOT NULL PRIMARY KEY,
  id_pabrik int NOT NULL FOREIGN KEY REFERENCES pabrik(id_pabrik),
  id_pemilik int NOT NULL FOREIGN KEY REFERENCES pemilik_truk(id_pemilik),
  harga_kirim decimal(13,2),
  harga_supir decimal(13,2),
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
)
