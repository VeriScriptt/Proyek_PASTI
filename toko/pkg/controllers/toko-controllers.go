package controllers

import (
	"encoding/json"
	"fmt"
	"net/http"
	"strconv"

	"github.com/gorilla/mux"
	"github.com/marihottambunan/toko/pkg/models"
	"github.com/marihottambunan/toko/pkg/utils"
)

var NewToko models.Toko

func GetToko(w http.ResponseWriter, r *http.Request) {
	newTokos := models.GetAllTokos()
	res, err := json.Marshal(newTokos)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func GetTokoById(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	TokoId := vars["id"]
	IDToko, err := strconv.ParseInt(TokoId, 0, 0)
	if err != nil {
		fmt.Println("error while parsing")
	}
	tokoDetails, _ := models.GetTokoById(IDToko)
	res, _ := json.Marshal(tokoDetails)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func CreateToko(w http.ResponseWriter, r *http.Request) {
	CreateToko := &models.Toko{}
	utils.ParseBody(r, CreateToko)
	b := CreateToko.CreateToko()
	res, _ := json.Marshal(b)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func DeleteToko(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	TokoId := vars["id"]
	IDToko, err := strconv.ParseInt(TokoId, 10, 64)
	if err != nil {
		fmt.Println("error while parsing")
	}
	Toko := models.DeleteTokoById(IDToko)
	res, _ := json.Marshal(Toko)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func UpdateToko(w http.ResponseWriter, r *http.Request) {
	var updateToko = &models.Toko{}
	utils.ParseBody(r, updateToko)
	vars := mux.Vars(r)
	TokoId := vars["id"]
	IDToko, err := strconv.ParseInt(TokoId, 10, 64)
	if err != nil {
		fmt.Println("error while parsing")
	}
	tokoDetails, db := models.GetTokoById(IDToko)

	if updateToko.Nama_toko != "" {
		tokoDetails.Nama_toko = updateToko.Nama_toko
	}
	if updateToko.Nama_lengkap != "" {
		tokoDetails.Nama_lengkap = updateToko.Nama_lengkap
	}
	if updateToko.Nomor_kios != "" {
		tokoDetails.Nomor_kios = updateToko.Nomor_kios
	}
	if updateToko.Lantai != "" {
		tokoDetails.Lantai = updateToko.Lantai
	}
	if updateToko.Email != "" {
		tokoDetails.Email = updateToko.Email
	}
	if updateToko.Nomor_telepon != "" {
		tokoDetails.Nomor_telepon = updateToko.Nomor_telepon
	}

	db.Save(&tokoDetails)
	res, _ := json.Marshal(tokoDetails)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}
