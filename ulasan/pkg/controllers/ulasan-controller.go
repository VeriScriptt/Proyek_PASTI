package controllers

import (
	"encoding/json"
	"fmt"
	"net/http"
	"strconv"

	"github.com/gorilla/mux"
	"github.com/marihottambunan/ulasan/pkg/models"
	"github.com/marihottambunan/ulasan/pkg/utils"
)

var NewUlasan models.Ulasan

func GetUlasan(w http.ResponseWriter, r *http.Request) {
	newUlasans := models.GetAllUlasans()
	res, err := json.Marshal(newUlasans)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func GetUlasanById(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	UlasanId := vars["id"]
	IDUlasan, err := strconv.ParseInt(UlasanId, 0, 0)
	if err != nil {
		fmt.Println("error while parsing")
	}
	ulasanDetails, _ := models.GetUlasanById(IDUlasan)
	res, _ := json.Marshal(ulasanDetails)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func CreateUlasan(w http.ResponseWriter, r *http.Request) {
	CreateUlasan := &models.Ulasan{}
	utils.ParseBody(r, CreateUlasan)
	b := CreateUlasan.CreateUlasan()
	res, _ := json.Marshal(b)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func DeleteUlasan(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	UlasanId := vars["id"]
	IDUlasan, err := strconv.ParseInt(UlasanId, 10, 64)
	if err != nil {
		fmt.Println("error while parsing")
	}
	err = models.DeleteUlasanById(IDUlasan)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	json.NewEncoder(w).Encode(map[string]bool{"success": true})
}

func UpdateUlasan(w http.ResponseWriter, r *http.Request) {
	var updateUlasan = &models.Ulasan{}
	utils.ParseBody(r, updateUlasan)
	vars := mux.Vars(r)
	UlasanId := vars["id"]
	IDUlasan, err := strconv.ParseInt(UlasanId, 10, 64)
	if err != nil {
		fmt.Println("error while parsing")
	}
	ulasanDetails, db := models.GetUlasanById(IDUlasan)

	if updateUlasan.NamaProduk != "" {
		ulasanDetails.NamaProduk = updateUlasan.NamaProduk
	}
	if updateUlasan.NamaPengirim != "" {
		ulasanDetails.NamaPengirim = updateUlasan.NamaPengirim
	}
	if updateUlasan.Ulasan != "" {
		ulasanDetails.Ulasan = updateUlasan.Ulasan
	}
	ulasanDetails.IsHidden = updateUlasan.IsHidden // Update the IsHidden field directly

	db.Save(&ulasanDetails)
	res, _ := json.Marshal(ulasanDetails)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}
