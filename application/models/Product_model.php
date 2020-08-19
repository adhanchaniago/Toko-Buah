<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
  private $_table = "products";

  public $product_id;
  public $name;
  public $price;
  public $image = "default.jpg";
  public $description;

  public function rules()
  {
    return [
      [
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'required'
      ],

      [
        'field' => 'price',
        'label'=> 'Price',
        'rules' => 'numeric'
      ],

      [
        'field' => 'description',
        'label' => 'description',
        'rules' => 'required'
      ]
    ];
  }

    public function getAll()
    {
      return $this->db->get($this->_table)->result();
      /*   ini sama artinya seperti : 
            SELECT * FROM products
            method ini akan mengembalikan sebuah array
            yang berisi objek dari row
      */
    }
    
    public function getId($id)
    {
      return $this->db->get_where($this->_table,["product_id" => $id])->row();
      /*   ini sama artinya seperti : 
            SELECT * FROM products WHERE product_id=$id
            method ini akan mengembalikan sebuah object
      */
    }
    
    public function save()
    {
      $post = $this->input->post(); //ambil data dari form
      $this->product_id = uniqid(); //membuat id unik
      $this->name = $post["name"]; // isi field name
      $this->price = $post["price"]; // isi filed price
      $this->description = $post["description"]; // isi field description
    
      return $this->db->insert($this->_table, $this /* $this ini untuk data yg akan disimpan*/); // simpan ke database .. 
    }
    
    public function update()
    {
      $post = $this->input->post();
      $this->product_id = ["id"];
      $this->name = $post = ["name"];
      $this->price = $post = ["price"];
      $this->description = $post ["description"];
    
      return $this->db->update($this->_table, $this, array('product_id' => $post['id']));
    }
    
    public function delete($id)
    {
      $this->db->delete($this->_table, array('product_id' => $id));
    }
}

?>