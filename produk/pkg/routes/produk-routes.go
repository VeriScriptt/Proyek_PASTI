package routes

import (
	"github.com/gorilla/mux"
	"github.com/marihottambunan/produk/pkg/controllers"
)

var ProdukRoutes = func(router *mux.Router) {
	router.HandleFunc("/produk", controllers.CreateProduk).Methods("POST")
	router.HandleFunc("/produk", controllers.GetProduk).Methods("GET")
	router.HandleFunc("/produk/{id}", controllers.GetProdukById).Methods("GET")
	router.HandleFunc("/produk/{id}", controllers.UpdateProduk).Methods("PUT")
	router.HandleFunc("/produk/{id}", controllers.DeleteProduk).Methods("DELETE")
}
