<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelToko;
class Toko extends BaseController
{
use ResponseTrait;
protected $model;
public function __construct()
{
$this->model = new ModelToko();
}
public function index()
{
$data = $this->model->orderBy('kode','asc')->findAll();
return $this->respond($data, 200);
}
public function show($kode = null)
{
$data = $this->model->where('kode', $kode)->findAll();
if ($data) {
return $this->respond($data, 200);
}else {
return $this->failNotFound("Data dengan kode $kode tidak 
ditemukan");
}
}
public function create()
{
// $data = [
// 'nama_barang' => $this->request->getVar('nama_barang'),
// 'jenis' => $this->request->getVar('jenis'),
// 'harga' => $this->request->getVar('harga'),
// 'stok' => $this->request->getVar('stok'),
// ];
// $this->model->save($data);
$data = $this->request->getPost();
if(!$this->model->save($data)) {
return $this->fail($this->model->errors());
}
$response = [
'status' => 201,
'error' => null,
'messages' => [
'success' => 'Berhasil Memasukan Data ke Tabel Database'
]
];
return $this->respondCreated($response);
}
public function update($kode = null)
{
$data = $this->request->getRawInput();
$data['kode'] = $kode;
$isExists = $this->model->where('kode', $kode)->findAll();
if (!$isExists) {
return $this->failNotFound("Data dengan kode seperti berikut $kode
tidak ditemukan");
}
if (!$this->model->save($data)) {
return $this->fail( $this->model->errors());
}
$response = [
'status' => 200,
'error' => null,
'messages' => [
'succes' => "Berhasil update data, kode $kode "
]
];
return $this->respond($response);
}
public function delete($kode = null)
{
$data = $this->model->where('kode', $kode)->findAll();
if ($data) {
$this->model->delete($kode);
$response = [
'status' => 200,
'error' => null,
'messages' => [
'succes' => "Berhasil delete data, kode $kode "
]
];
return $this->respondDeleted($response);
}else {
return $this->failNotFound("Data dengan kode seperti berikut $kode
tidak ditemukan");
}
}
}