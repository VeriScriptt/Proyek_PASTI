package models

import (
	"github.com/jinzhu/gorm"
	"github.com/marihottambunan/ulasan/pkg/config"
)

var db *gorm.DB

type Ulasan struct {
	gorm.Model
	NamaProduk   string `json:"nama_produk" gorm:"column:nama_produk"`
	NamaPengirim string `json:"nama_pengirim" gorm:"column:nama_pengirim"`
	Ulasan       string `json:"ulasan" gorm:"column:ulasan"`
	IsHidden     bool   `json:"is_hidden" gorm:"column:is_hidden"`
}

func init() {
	config.Connect()
	db = config.GetDB()
	db.AutoMigrate(&Ulasan{})
}

func (b *Ulasan) CreateUlasan() *Ulasan {
	db.NewRecord(b)
	db.Create(&b)
	return b
}

func GetAllUlasans() []Ulasan {
	var Ulasans []Ulasan
	db.Find(&Ulasans)
	return Ulasans
}

func GetUlasanById(id int64) (*Ulasan, *gorm.DB) {
	var getUlasan Ulasan
	db := db.Where("id = ?", id).Find(&getUlasan)
	return &getUlasan, db
}

func DeleteUlasanById(id int64) error {
	if err := db.Where("id = ?", id).Delete(&Ulasan{}).Error; err != nil {
		return err
	}
	return nil
}

func UpdateUlasan(ulasan *Ulasan) *gorm.DB {
	return db.Save(ulasan)
}
