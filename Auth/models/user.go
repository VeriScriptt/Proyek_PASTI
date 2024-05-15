package models

type User struct {
	Id 			int64 	`gorm:"primaryKey" json:"id"`
	NamaLengkap	string 	`gorm:"varcha(255)" json:"nama_lengkap"`
	Username	string 	`gorm:"varcha(255)" json:"username"`
	Password	string 	`gorm:"varcha(255)" json:"password"`
}