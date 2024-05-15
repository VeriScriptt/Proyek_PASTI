package routes

import (
	"github.com/gorilla/mux"
	"github.com/marihottambunan/toko/pkg/controllers"
)

var TokoRoutes = func(router *mux.Router) {
	router.HandleFunc("/toko", controllers.CreateToko).Methods("POST")
	router.HandleFunc("/toko", controllers.GetToko).Methods("GET")
	router.HandleFunc("/toko/{id}", controllers.GetTokoById).Methods("GET")
	router.HandleFunc("/toko/{id}", controllers.UpdateToko).Methods("PUT")
	router.HandleFunc("/toko/{id}", controllers.DeleteToko).Methods("DELETE")
}
