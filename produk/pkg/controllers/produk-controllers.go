package controllers

import (
	"encoding/json"
	"fmt"
	"net/http"
	"strconv"

	"github.com/gorilla/mux"
	"github.com/marihottambunan/produk/pkg/models"
	"github.com/marihottambunan/produk/pkg/utils"
)

var NewProduk models.Produk

func GetProduk(w http.ResponseWriter, r *http.Request) {
	newProduks := models.GetAllProduks()
	res, err := json.Marshal(newProduks)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func GetProdukById(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	ProdukId := vars["id"]
	IDProduk, err := strconv.ParseInt(ProdukId, 0, 0)
	if err != nil {
		fmt.Println("error while parsing")
	}
	produkDetails, _ := models.GetProdukById(IDProduk)
	res, _ := json.Marshal(produkDetails)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func CreateProduk(w http.ResponseWriter, r *http.Request) {
	CreateProduk := &models.Produk{}
	utils.ParseBody(r, CreateProduk)
	b := CreateProduk.CreateProduk()
	res, _ := json.Marshal(b)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func DeleteProduk(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	ProdukId := vars["id"]
	IDProduk, err := strconv.ParseInt(ProdukId, 10, 64)
	if err != nil {
		fmt.Println("error while parsing")
	}
	Produk := models.DeleteProdukById(IDProduk)
	res, _ := json.Marshal(Produk)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}

func UpdateProduk(w http.ResponseWriter, r *http.Request) {
	var updateProduk = &models.Produk{}
	utils.ParseBody(r, updateProduk)
	vars := mux.Vars(r)
	ProdukId := vars["id"]
	IDProduk, err := strconv.ParseInt(ProdukId, 10, 64)
	if err != nil {
		fmt.Println("error while parsing")
	}
	produkDetails, db := models.GetProdukById(IDProduk)

	if updateProduk.Nama != "" {
		produkDetails.Nama = updateProduk.Nama
	}
	if updateProduk.Harga != "" {
		produkDetails.Harga = updateProduk.Harga
	}
	if updateProduk.Deskripsi != "" {
		produkDetails.Deskripsi = updateProduk.Deskripsi
	}
	if updateProduk.Stok != "" {
		produkDetails.Stok = updateProduk.Stok
	}
	if updateProduk.IdKategori != "" {
		produkDetails.IdKategori = updateProduk.IdKategori
	}
	// if updateProduk.Kategori != "" {
	// 	produkDetails.Kategori = updateProduk.Kategori
	// }

	db.Save(&produkDetails)
	res, _ := json.Marshal(produkDetails)
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(res)
}
