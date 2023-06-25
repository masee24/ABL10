<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelToko extends Model
{
protected $table = "toko";
protected $primaryKey = "kode";
protected $allowedFields = ['nama_barang', 'jenis', 'harga', 'stok'];
protected $validationRules = [
'nama_barang'=>'required',
'jenis'=>'required',
'harga'=>'required',
'stok'=>'required',
];
protected $validationMessages = [
'nama_barang' => [
'required' => 'Masukan nama barang'
],
'jenis' => [
'required' => 'Masukan jenis barang',
],
'harga' => [
'required' => 'Masukan harga barang',
],
'stok' => [
'required' => 'Masukan stok barang',
],
];
}