package models

import (
	"github.com/jinzhu/gorm"
	"github.com/marihottambunan/toko/pkg/config"
)

var db *gorm.DB

type Toko struct {
	gorm.Model
	Nama_toko     string `json:"nama_toko" gorm:"column:nama_toko"`
	Nama_lengkap  string `json:"nama_lengkap" gorm:"column:nama_lengkap"`
	Nomor_kios    string `json:"nomor_kios" gorm:"column:nomor_kios"`
	Lantai        string `json:"lantai" gorm:"column:lantai"`
	Email         string `json:"email" gorm:"column:email"`
	Nomor_telepon string `json:"nomor_telepon" gorm:"column:nomor_telepon"`
}

func init() {
	config.Connect()
	db = config.GetDB()
	db.AutoMigrate(&Toko{})
}

func (b *Toko) CreateToko() *Toko {
	db.NewRecord(b)
	db.Create(&b)
	return b
}

func GetAllTokos() []Toko {
	var Tokos []Toko
	db.Find(&Tokos)
	return Tokos
}

func GetTokoById(id int64) (*Toko, *gorm.DB) {
	var getToko Toko
	db := db.Where("id = ?", id).Find(&getToko)
	return &getToko, db
}

func DeleteTokoById(id int64) error {
	if err := db.Where("id = ?", id).Delete(&Toko{}).Error; err != nil {
		return err
	}
	return nil
}
