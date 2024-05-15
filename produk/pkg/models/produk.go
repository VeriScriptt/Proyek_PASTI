package models

import (
	"github.com/jinzhu/gorm"
	"github.com/marihottambunan/produk/pkg/config"
)

var db *gorm.DB

type Produk struct {
	gorm.Model
	Nama      string `json:"nama" gorm:"column:nama"`
	Harga     string `json:"harga" gorm:"column:harga"`
	Stok      string `json:"Stok" gorm:"column:stok"`
	Deskripsi string `json:"deskripsi" gorm:"column:deskripsi"`
    IdKategori string   `json:"id_kategori" gorm:"column:id_kategori"`
}

func init() {
	config.Connect()
	db = config.GetDB()
	db.AutoMigrate(&Produk{})
}

func (b *Produk) CreateProduk() *Produk {
	db.NewRecord(b)
	db.Create(&b)
	return b
}

func GetAllProduks() []Produk {
	var Produks []Produk
	db.Find(&Produks)
	return Produks
}

func GetProdukById(id int64) (*Produk, *gorm.DB) {
	var getProduk Produk
	db := db.Where("id = ?", id).Find(&getProduk)
	return &getProduk, db
}

func DeleteProdukById(id int64) error {
	if err := db.Where("id = ?", id).Delete(&Produk{}).Error; err != nil {
		return err
	}
	return nil
}
