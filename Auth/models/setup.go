package models

import (
	"fmt"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var DB *gorm.DB

func ConnectDatabase() { 
	db, err := gorm.Open(mysql.Open("root:@tcp(localhost:3306)/microservice_user"))

	if err != nil {
		// panic(err)
		fmt.Println("Gagal Koneksi Database")
	}

	db.AutoMigrate(&User{})

	DB = db
}
